---
stage: test
bolt: 001-identity-access
created: 2026-06-05T09:40:00Z
---

## Test Report: identity-access (auth core)

Stories: 001-patient-self-registration, 002-email-verification, 003-user-login,
004-session-timeout-and-lockout. Framework: PHPUnit 12 (Laravel test harness) on Sail.

### Summary

- **Auth feature tests**: 14/14 passed (42 assertions)
- **Full suite**: 16/16 passed (44 assertions) — no regressions
- **Coverage (statement, identity code)**: 100% on all new files (driver: pcov)
- **Lint**: `pint --dirty` clean

| Suite | Tests | Result |
|-------|-------|--------|
| `tests/Feature/Auth` | 14 | ✅ pass |
| Full suite (`artisan test`) | 16 | ✅ pass |

### Coverage (identity scope, from Clover)

| File | Statements | Covered |
|------|-----------|---------|
| `Domain/Identity/AuthenticationService.php` | 42 | 100% |
| `Domain/Identity/Enums/RoleType.php` | 1 | 100% |
| `Domain/Identity/Enums/AccountStatus.php` | — | n/a (enum cases) |
| `Domain/Identity/LoginThrottlePolicy.php` | — | n/a (constants) |
| `Domain/Identity/SessionPolicy.php` | — | n/a (constants) |
| `Http/Middleware/EnforceIdleTimeout.php` | 13 | 100% |
| `Actions/Fortify/CreateNewUser.php` | 18 | 100% |
| `Models/User.php` | 10 | 100% |
| `Models/LoginAttempt.php` | 4 | 100% |

### Acceptance Criteria Validation

**001 — Patient self-registration**
- ✅ Valid registration creates a Patient, `active`, `email_verified_at = null` — `RegistrationTest::test_patient_can_self_register_as_active_but_unverified`
- ✅ Password below minimum rejected, no account created — `test_password_below_minimum_length_is_rejected`
- ✅ Duplicate email rejected — `test_duplicate_email_is_rejected`

**002 — Email verification**
- ✅ Valid signed link sets `email_verified_at` — `EmailVerificationTest::test_valid_signed_link_marks_email_verified`
- ✅ Invalid hash does not verify — `test_invalid_hash_does_not_verify`
- ✅ Verified-before-booking: registration leaves user unverified (booking gate enforced downstream via `verified` middleware) — covered by registration assertion

**003 — User login**
- ✅ Valid credentials authenticate — `LoginTest::test_user_can_login_with_valid_credentials`
- ✅ Wrong password fails — `test_wrong_password_fails`
- ✅ No account enumeration: wrong password and unknown email return the **same** generic error — `test_login_does_not_leak_whether_an_account_exists`
- ✅ Deactivated account cannot log in — `test_deactivated_user_cannot_login`

**004 — Session timeout & lockout**
- ✅ 5 failures → account locked; correct password blocked while locked; auto-unlock after window → login succeeds — `AccountLockoutTest::test_account_locks_after_max_failures_and_auto_unlocks_after_window`
- ✅ Lockout reachable via the login endpoint — `test_five_failed_logins_via_endpoint_lock_the_account`
- ✅ Privileged (provider) idle session expires after timeout — `IdleTimeoutTest::test_privileged_session_expires_after_idle_period`
- ✅ Active privileged session allowed — `test_active_privileged_session_is_allowed`
- ✅ Patient not subject to idle timeout — `test_patient_is_not_subject_to_idle_timeout`

### Issues Found

None blocking. Notes:
- Account lockout returns a generic failure (returns `null`) rather than a distinct "locked"
  message — intentional, to avoid account enumeration. Revisit if product wants an explicit
  locked notice.

### Recommendations / Follow-ups (not in this bolt)

- **Frontend (unit 008)**: Fortify GET view routes (`/login`, `/register`, verify notice) need
  React/Inertia pages; only the POST/domain layer is implemented here.
- **Email vendor**: verification mail uses Laravel's mailer; production needs a BAA-capable
  provider (open question from inception).
- **bolt 002-identity-access**: MFA for privileged roles, admin provisioning, facility-scoped
  RBAC, and role-change audit (2FA columns already migrated, dormant).

### Completion Criteria

- [x] All unit/feature tests passing
- [x] Integration (HTTP endpoint) tests passing
- [x] Security behavior validated (no enumeration, lockout, idle timeout, verification)
- [x] Coverage targets met (100% statements on identity code)
- [x] All acceptance criteria met
