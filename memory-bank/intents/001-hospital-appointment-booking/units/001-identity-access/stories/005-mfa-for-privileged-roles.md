---
id: 005-mfa-for-privileged-roles
unit: 001-identity-access
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 005-mfa-for-privileged-roles

## User Story

**As a** provider, staff, or admin
**I want** use multi-factor authentication
**So that** PHI access requires a second factor per HIPAA practice

## Acceptance Criteria

- [ ] **Given** a privileged-role user, **When** they log in, **Then** a second factor (TOTP/SMS) is required before access
- [ ] **Given** an incorrect second factor, **When** submitted, **Then** access is denied and the attempt is audited
- [ ] **Given** MFA is not yet enrolled, **When** a privileged user first logs in, **Then** they are forced through MFA enrollment

## Technical Notes

- TOTP preferred; SMS factor via messaging vendor under BAA.

## Dependencies

### Requires
- 003-user-login

### Enables
- 007-rbac-enforcement

## Out of Scope

- Concerns owned by other units (see unit-brief).
