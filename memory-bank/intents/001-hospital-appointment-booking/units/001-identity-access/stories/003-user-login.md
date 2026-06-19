---
id: 003-user-login
unit: 001-identity-access
intent: 001-hospital-appointment-booking
status: complete
priority: must
created: 2026-06-04T12:40:00.000Z
assigned_bolt: null
implemented: true
---

# Story: 003-user-login

## User Story

**As a** registered user
**I want** log in with my credentials
**So that** I can access role-appropriate features

## Acceptance Criteria

- [ ] **Given** valid credentials, **When** I log in, **Then** a secure session is established and I land on my role dashboard
- [ ] **Given** invalid credentials, **When** I log in, **Then** I see a generic failure message (no account enumeration)
- [ ] **Given** a deactivated account, **When** I log in, **Then** access is denied

## Technical Notes

- HTTP-only, secure session cookies.

## Dependencies

### Requires
- 001-patient-self-registration

### Enables
- 007-rbac-enforcement

## Out of Scope

- Concerns owned by other units (see unit-brief).
