---
id: 001-patient-self-registration
unit: 001-identity-access
intent: 001-hospital-appointment-booking
status: complete
priority: must
created: 2026-06-04T12:40:00.000Z
assigned_bolt: null
implemented: true
---

# Story: 001-patient-self-registration

## User Story

**As a** prospective patient
**I want** register with my email and a password
**So that** I can access the platform and book appointments

## Acceptance Criteria

- [ ] **Given** I am on the registration page, **When** I submit a valid unique email and a password ≥ 8 chars, **Then** an unverified account is created and a verification email is sent
- [ ] **Given** I submit an email that already exists, **When** I register, **Then** I see "Email already registered"
- [ ] **Given** I submit a weak/short password, **When** I register, **Then** I see a validation error and no account is created

## Technical Notes

- Hash passwords with bcrypt/argon2 (Laravel default). Rate-limit registration per IP.

## Dependencies

### Requires
- None

### Enables
- 002-email-verification, 003-user-login

## Out of Scope

- Concerns owned by other units (see unit-brief).
