# Coding Standards

## Overview

Conventions for consistent, high-quality code across the Laravel/PHP backend and the
React/Inertia frontend. Backend style follows Laravel/PSR norms enforced by Pint; the
frontend follows standard React + TypeScript conventions. Tests are written with PHPUnit.

## Code Formatting

**PHP — Tool**: Laravel **Pint** (`laravel/pint`, PHP-CS-Fixer wrapper).
**Key Settings**:
- Preset: `laravel` (PSR-12 based, Laravel flavor)
- Indentation: 4 spaces (PHP)

**Frontend — Tool**: Prettier (recommended) for `.ts/.tsx/.jsx/.css`.
**Key Settings**:
- Indentation: 2 spaces (JS/TS)
- Tailwind class sorting via `prettier-plugin-tailwindcss` (recommended)

**Enforcement**: Run `./vendor/bin/sail bin pint` (PHP) before commit; wire Pint + Prettier
into CI. Format on save locally where supported.

## Linting

**PHP — Tool**: Pint (also serves as the style linter).
**Base Config**: `laravel` preset.
**Strictness**: balanced — Laravel preset defaults.

**Frontend — Tool**: ESLint with the React + TypeScript recommended configs (to be added
with the React/Inertia setup).
**Strictness**: balanced; `strict: true` in `tsconfig` recommended.

**Key Rules**:
- No leftover `dd()`/`dump()`/`var_dump()` or `console.log` in committed code.
- Prefer typed signatures (PHP return/param types; explicit TS types on Inertia props).
- No commented-out code; `TODO`s reference a tracking item.

## Naming Conventions

| Element | Convention | Example |
|---------|------------|---------|
| PHP classes | PascalCase | `UserService`, `OrderController` |
| PHP methods / variables | camelCase | `getUserById`, `$isActive` |
| PHP constants / enum cases | UPPER_SNAKE / PascalCase | `MAX_RETRIES`, `Status::Pending` |
| DB tables / columns | snake_case (plural tables) | `users`, `created_at` |
| Eloquent models | Singular PascalCase | `User`, `OrderItem` |
| React components | PascalCase | `UserProfile`, `Dashboard` |
| React hooks | camelCase with `use` | `useAuth`, `usePage` |
| JS/TS variables & functions | camelCase | `userName`, `calculateTotal` |
| Booleans | `is/has/can` prefix | `isActive`, `hasPermission` |

**File Naming**:
- PHP classes: PascalCase, one class per file (`app/...`).
- Inertia React pages: PascalCase under `resources/js/Pages/` (e.g. `Auth/Login.tsx`).
- React components: PascalCase (`resources/js/Components/`).
- Migrations: Laravel timestamped snake_case (`2026_06_04_000000_create_users_table.php`).
- Tests: `*Test.php` (Pest) under `tests/Feature` and `tests/Unit`.

## File Organization

**Pattern**: Laravel's framework conventions (type-based backend) + Inertia page structure
on the frontend. Domain logic is grouped by feature/domain as the app grows (aligns with the
DDD unit decomposition used in Construction).

**Structure**:
```text
app/
  Http/Controllers/      # return Inertia responses
  Http/Requests/         # form-request validation
  Models/                # Eloquent models
  Actions/ | Services/   # domain/application logic (added as needed)
database/
  migrations/  factories/  seeders/
resources/
  js/
    Pages/               # Inertia page components (React)
    Components/           # shared React components
    Layouts/
  css/                   # Tailwind entrypoint
routes/                  # web.php (+ auth routes from Fortify)
tests/
  Feature/  Unit/
```

**Conventions**:
- Tests: separate `tests/` tree (`Feature`, `Unit`), not co-located.
- Validation lives in Form Request classes, not controllers.
- Inertia shared props/middleware in `app/Http/Middleware/HandleInertiaRequests.php`.

## Testing Strategy

**Framework**: **PHPUnit 12** (Laravel's default test harness), with `mockery/mockery` and
`fakerphp/faker` factories. Run via `./vendor/bin/sail artisan test`.

**Coverage Target**: Critical paths and all public/domain behavior covered; ~80% as a
guideline, not a hard gate.

**Test Types**:

| Type | Tool | When to Use |
|------|------|-------------|
| Feature | PHPUnit + Laravel test harness | HTTP/Inertia endpoints, auth flows, DB interactions |
| Unit | PHPUnit | Pure domain logic, services, actions |
| Frontend | TBD | React component/E2E testing deferred until UI matures |

**Conventions**:
- Test classes extend `Tests\TestCase`; descriptive `test_*` method names (or the `#[Test]` attribute).
- Use the `RefreshDatabase` trait for tests that touch the database.
- Structure: Arrange–Act–Assert.
- Mock strategy: mock at external boundaries; prefer real DB (refresh) for feature tests.
- Test data: model factories with Faker; avoid hand-built fixtures.

## Error Handling

**Pattern**: Throw exceptions; let Laravel's central handler (`bootstrap/app.php` /
`App\Exceptions`) map them to responses. Use Form Requests for validation errors.

**Custom Errors**: Introduce domain-specific exception classes for meaningful failures;
keep messages user-safe and put technical detail in logs.

**API/Inertia Errors**: Validation errors surface to React via Inertia's shared `errors`
prop; use appropriate HTTP status codes. Stack traces only in `local`/`debug`.

## Logging

**Tool**: Laravel `Log` facade (Monolog). **Format**: text locally, structured (JSON)
recommended for production.

**Levels**:

| Level | Usage |
|-------|-------|
| error | A failure needing attention |
| warning | Unexpected but handled |
| info | Significant business events (registration, key actions) |
| debug | Detailed technical info (local only) |

**Local tailing**: `laravel/pail` — `./vendor/bin/sail artisan pail`.

**Rules**:
- Always log: auth events, errors with context, significant domain events.
- Never log: passwords, tokens, API keys, or PII without justification.
