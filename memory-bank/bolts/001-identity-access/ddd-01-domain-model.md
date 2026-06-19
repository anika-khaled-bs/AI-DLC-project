---
stage: model
bolt: 001-identity-access
created: 2026-06-04T13:05:00Z
---

## Static Model: identity-access (auth core)

Scope: stories 001-patient-self-registration, 002-email-verification, 003-user-login,
004-session-timeout-and-lockout. MFA, RBAC, provisioning, and role-change audit are out of
scope here (bolt 002-identity-access).

> Note: Laravel **Fortify** (headless) provides the registration/verification/login/2FA
> backend actions; this model captures the *domain* concepts that Fortify and our code
> operate on, plus the platform-specific rules (verified-before-booking, lockout policy).

### Entities

- **User**: The authenticated principal.
  - Properties: `id`, `name`, `email` (EmailAddress), `passwordHash` (HashedPassword), `status` (AccountStatus), `emailVerifiedAt` (nullable timestamp), `role` (RoleType — defaults to `patient` for self-registration), `createdAt`, `updatedAt`.
  - Business rules:
    - Email is unique across all users (case-insensitive).
    - A self-registered user starts `status = active`, `role = patient`, `emailVerifiedAt = null`.
    - A user with `emailVerifiedAt = null` is **unverified** and MUST NOT be allowed to book appointments (enforced downstream, surfaced here as the `isVerified()` invariant).
    - A `status = locked` user cannot authenticate until the lockout elapses.
    - A `status = deactivated` user cannot authenticate at all.

- **LoginAttempt**: A record of an authentication attempt used for throttling/lockout.
  - Properties: `id`, `email` (EmailAddress, as entered), `ipAddress`, `successful` (bool), `attemptedAt`.
  - Business rules:
    - Used to compute the rolling count of failures within the lockout window.
    - Retained for security review; not PHI.

### Value Objects

- **EmailAddress**: Validated, normalized (lowercased, trimmed) RFC-5322 email. Equality by value. Invalid format is rejected at construction.
- **HashedPassword**: An opaque bcrypt/argon2 hash. Never stores or exposes plaintext. Provides `matches(plaintext): bool`. Construction enforces the password *policy* on the plaintext input (min length ≥ 8) before hashing.
- **AccountStatus**: Enum — `active | locked | deactivated`.
- **RoleType**: Enum — `patient | provider | staff | admin`. (Only `patient` is created in this bolt; others provisioned in bolt 002.)
- **VerificationToken**: A signed, expiring token reference for email verification (Fortify/Laravel signed URL). Carries `userId`, `expiresAt`; validity is `now < expiresAt` and signature intact.
- **LockoutPolicy**: Value object capturing `maxFailures` (5), `window` (15 min), `lockoutDuration`. Pure policy, no identity.
- **SessionPolicy**: Value object capturing `idleTimeout` per role group (`privileged = 15 min` for provider/staff/admin; patient uses the default web session lifetime).

### Aggregates

- **User** (Aggregate Root):
  - Members: `User`, its `EmailAddress`, `HashedPassword`, `AccountStatus`, `emailVerifiedAt`.
  - Invariants:
    - Unique email.
    - `emailVerifiedAt` transitions null → timestamp exactly once (idempotent verify).
    - Status transitions allowed: `active → locked` (on lockout), `locked → active` (on lockout elapse / manual unlock), `active → deactivated`.
    - Cannot authenticate unless `status = active`.
- **LoginAttempt** is a small standalone aggregate (append-only audit-ish trail), referenced by email/IP rather than owned by the User aggregate (attempts may target non-existent emails).

### Domain Events

- **UserRegistered**: Trigger — successful self-registration. Payload: `userId`, `email`, `role=patient`, `registeredAt`. (Drives the verification email send.)
- **EmailVerificationRequested**: Trigger — registration or explicit resend. Payload: `userId`, `email`, `tokenRef`, `expiresAt`.
- **EmailVerified**: Trigger — valid verification link opened. Payload: `userId`, `verifiedAt`. (Unblocks booking.)
- **UserLoggedIn**: Trigger — successful authentication. Payload: `userId`, `ipAddress`, `at`. (Logged at `info`.)
- **LoginFailed**: Trigger — failed authentication. Payload: `emailEntered`, `ipAddress`, `at`.
- **AccountLocked**: Trigger — failure count exceeds policy in window. Payload: `email`, `lockedUntil`, `at`.
- **SessionExpired**: Trigger — request arrives on an idle-expired privileged session. Payload: `userId`, `at`. (Forces re-auth.)

### Domain Services

- **RegistrationService**: Creates a patient User from `EmailAddress` + plaintext password. Enforces unique-email and password policy; emits `UserRegistered` + `EmailVerificationRequested`. (Backed by Fortify's `CreateNewUser` action.)
- **EmailVerificationService**: Validates a `VerificationToken`, sets `emailVerifiedAt` idempotently, emits `EmailVerified`. Issues/re-issues tokens (handles expired-link resend).
- **AuthenticationService**: Verifies credentials against `HashedPassword`, checks `AccountStatus`, records a `LoginAttempt`, emits `UserLoggedIn` / `LoginFailed`. Returns a generic failure (no account enumeration).
- **LoginThrottleService**: Applies `LockoutPolicy` over recent `LoginAttempt`s; locks the account/email and emits `AccountLocked`; determines when a lockout has elapsed. (Complements Laravel's rate-limiter.)
- **SessionGuard** (policy enforcement): Applies `SessionPolicy` idle timeout for privileged roles; emits `SessionExpired` and invalidates the session. (Implemented as middleware in design stage.)

### Repository Interfaces

- **UserRepository**:
  - `findByEmail(EmailAddress): ?User`
  - `findById(id): ?User`
  - `save(User): void`
  - `existsByEmail(EmailAddress): bool`
- **LoginAttemptRepository**:
  - `record(LoginAttempt): void`
  - `countRecentFailures(EmailAddress|ip, window): int`
  - `clearFailures(EmailAddress): void` (on successful login / unlock)

### Ubiquitous Language

- **Patient**: A self-registering end user with `role = patient`. (In this platform, "provider" = doctor.)
- **Verified**: A user whose email ownership is confirmed (`emailVerifiedAt` set); prerequisite for booking.
- **Privileged role**: provider, staff, or admin — subject to the 15-minute idle timeout (and MFA in bolt 002).
- **Lockout**: Temporary block of authentication after repeated failures within the policy window.
- **Idle timeout**: Automatic session invalidation after a period of inactivity.
- **Account enumeration**: Leaking whether an email exists via differing error messages — explicitly avoided.

---

## Story Coverage

- **001-patient-self-registration** → User aggregate, RegistrationService, `UserRegistered`, unique-email + password-policy invariants.
- **002-email-verification** → VerificationToken, EmailVerificationService, `EmailVerified`, verified-before-booking invariant, expired-link resend.
- **003-user-login** → AuthenticationService, `UserLoggedIn`/`LoginFailed`, status checks, generic failure (no enumeration).
- **004-session-timeout-and-lockout** → SessionPolicy + SessionGuard (`SessionExpired`), LockoutPolicy + LoginThrottleService (`AccountLocked`), LoginAttempt aggregate.

## Completion Criteria

- [x] All domain entities identified and documented
- [x] Business rules captured for each entity
- [x] Aggregate boundaries defined
- [x] Domain events specified
- [x] Repository interfaces defined
- [x] All stories covered by domain model
