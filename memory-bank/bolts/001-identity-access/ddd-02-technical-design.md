---
unit: 001-identity-access
bolt: 001-identity-access
stage: design
status: complete
updated: 2026-06-04T13:20:00Z
---

# Technical Design - identity-access (auth core)

Covers stories 001–004. Backend: Laravel 13 (PHP 8.5), Laravel **Fortify** (headless auth).
Frontend: React 19 via **Inertia v3**. DB: MySQL 8.4 + Eloquent. Tests: Pest.

## Architecture Pattern

**Laravel layered architecture with Fortify + thin domain services**, not full hexagonal —
the auth core is largely framework-provided, so we lean on Fortify's actions and Laravel's
auth/session/rate-limiter rather than re-inventing them. We add a thin domain layer
(`app/Domain/Identity`) only where platform-specific rules live (lockout policy, idle-timeout
guard, verified-before-booking). This keeps cohesion with `coding-standards.md` (Form Requests
for validation, Actions/Services for logic) while avoiding over-engineering a CRUD-ish surface.

Rationale: Fortify already implements register/verify/login/2FA as swappable actions; wrapping
those in custom hexagonal ports would add ceremony without value. Domain rules that Fortify does
*not* own (account lockout, role-based idle timeout) are encapsulated as services + middleware.

## Layer Structure

```text
┌─────────────────────────────┐
│  Presentation               │  Inertia React pages (Auth/Register, Auth/Login,
│                             │  Auth/VerifyEmail) + Fortify routes/controllers
├─────────────────────────────┤
│  Application                │  Fortify Actions (CreateNewUser), Form Requests,
│                             │  middleware (EnforceIdleTimeout)
├─────────────────────────────┤
│  Domain                     │  app/Domain/Identity: LockoutPolicy, SessionPolicy,
│                             │  LoginThrottleService, RoleType/AccountStatus enums, events
├─────────────────────────────┤
│  Infrastructure             │  Eloquent User model, migrations, Fortify config,
│                             │  mail (verification), Laravel RateLimiter (cache)
└─────────────────────────────┘
```

## Routes / "API" Design

Inertia app (server-rendered React), so most "endpoints" are Fortify routes returning
redirects/Inertia responses rather than JSON. Validation errors flow back via Inertia's shared
`errors` prop.

| Route | Method | Provided by | Request | Response |
|-------|--------|-------------|---------|----------|
| `/register` | GET | app | – | Inertia `Auth/Register` page |
| `/register` | POST | Fortify (`CreateNewUser`) | name, email, password, password_confirmation | redirect → verification notice; emits `Registered` |
| `/email/verify` | GET | app/Fortify | – | Inertia `Auth/VerifyEmail` notice |
| `/email/verify/{id}/{hash}` | GET | Fortify (signed) | signed URL | marks verified → redirect dashboard |
| `/email/verification-notification` | POST | Fortify | (auth) | resend verification (throttled) |
| `/login` | GET | app | – | Inertia `Auth/Login` page |
| `/login` | POST | Fortify | email, password, remember | redirect → role dashboard, or back with generic error |
| `/logout` | POST | Fortify | (auth) | redirect → `/` |

Notes:
- Login uses a **generic** failure message (no account enumeration) — configured via Fortify
  `failedLoginResponse` / a single "These credentials do not match our records." message.
- Booking-guarded routes (other units) use Laravel's `verified` middleware; this bolt only
  guarantees `email_verified_at` is set correctly.

## Data Persistence

Extends Laravel's default `users` table. Fortify 2FA columns are added now (nullable) but exercised in bolt 002.

| Table | Columns | Relationships / Notes |
|-------|---------|------------------------|
| `users` | `id`, `name`, `email` (unique, index), `email_verified_at` (nullable), `password`, `role` (enum: patient/provider/staff/admin, default `patient`), `status` (enum: active/locked/deactivated, default `active`), `locked_until` (nullable ts), `remember_token`, `timestamps` | Eloquent `User` (`MustVerifyEmail`) |
| `users` (2FA, added, used in bolt 002) | `two_factor_secret` (text, null), `two_factor_recovery_codes` (text, null), `two_factor_confirmed_at` (ts, null) | Fortify 2FA — dormant this bolt |
| `login_attempts` | `id`, `email` (index), `ip_address`, `successful` (bool), `attempted_at` (index) | Append-only; feeds lockout + security review |
| `sessions` | Laravel default sessions table | `SESSION_DRIVER=database`; supports idle-timeout invalidation |
| `password_reset_tokens` | Laravel default | present for completeness (reset flow not in this bolt's stories) |

Migrations (Laravel timestamped, snake_case): `add_role_status_lockout_to_users`,
`add_two_factor_columns_to_users` (Fortify publishable), `create_login_attempts_table`.

## Security Design

| Concern | Approach |
|---------|----------|
| Password hashing | bcrypt (Laravel `Hash`), `HashedPassword` policy ≥ 8 chars in Form Request; never log plaintext |
| Account enumeration | Single generic login error; identical timing/response for unknown email vs bad password |
| Brute force / lockout | Fortify login rate-limiter **plus** `LoginThrottleService`: 5 failures / 15 min → `status=locked`, `locked_until` set; emits `AccountLocked` |
| Idle timeout | `EnforceIdleTimeout` middleware on privileged-role routes: invalidate session after 15 min inactivity (`last_activity` in session), emit `SessionExpired` |
| Email verification | Laravel signed, expiring URLs; `MustVerifyEmail`; verified-before-booking enforced via `verified` middleware downstream |
| Session security | HTTP-only, `secure`, `SameSite=Lax` cookies; `database` session driver; session regenerated on login |
| Sensitive logging | Log auth events (`info`) and failures (`warning`) with email+IP context; never log passwords/tokens (per coding-standards) |
| Transport | TLS enforced at deployment (NFR); app sets secure cookies |

## NFR Implementation

| Requirement | Design Approach |
|-------------|-----------------|
| Performance (login p95 fast) | Indexed `users.email`; lockout count via indexed `login_attempts(email, attempted_at)` or RateLimiter cache to avoid heavy queries |
| Scalability (5k concurrent) | Stateless app nodes; `database`/redis session + cache driver shared across nodes; no in-memory auth state |
| Reliability | DB-backed sessions survive node restarts; idempotent verification; throttle state in shared cache |
| Auditability (HIPAA) | `login_attempts` trail + structured logs for auth events; role-change audit deferred to bolt 002 |

## Error Handling

| Error Type | Code | Response |
|------------|------|----------|
| Validation (register/login) | 422 | Inertia `errors` prop (field messages); password policy + unique email |
| Invalid credentials | 422 | Generic "These credentials do not match our records." (no enumeration) |
| Account locked | 423 / 422 | "Your account is temporarily locked. Try again later." |
| Deactivated account | 403 | "This account is not active." |
| Expired/invalid verification link | 403 / 410 | Notice page with "resend verification" action |
| Idle timeout | 419/redirect | Session invalidated → redirect to login with "Your session expired." |

## External Dependencies

| Service | Purpose | Integration |
|---------|---------|-------------|
| Mail (SMTP/provider) | Send verification emails | Laravel Mailer; provider under BAA (vendor TBD — open question) |
| `laravel/fortify` | Headless auth backend | Composer package; `FortifyServiceProvider`, actions, config |

## Implementation Plan (preview for Stage 4)

1. `composer require laravel/fortify`; publish config + 2FA migration; register provider.
2. Migrations: role/status/lockout columns, login_attempts, ensure sessions table.
3. `User` model: `MustVerifyEmail`, casts for `role`/`status` enums, fillable/hidden.
4. `app/Domain/Identity`: `RoleType`, `AccountStatus` enums; `LockoutPolicy`, `SessionPolicy`; `LoginThrottleService`; domain events.
5. Fortify wiring: `CreateNewUser` (patient role, password policy), generic failed-login response, login rate limiter + lockout hook.
6. `EnforceIdleTimeout` middleware; register for privileged routes.
7. Inertia React pages: `Auth/Register`, `Auth/Login`, `Auth/VerifyEmail`.
8. Seeders/factories for users (Faker).

## Completion Criteria

- [x] Architecture pattern selected and documented
- [x] All layers designed with responsibilities
- [x] Route/API contracts defined
- [x] Database schema designed
- [x] NFRs addressed in design
- [x] Security patterns applied
