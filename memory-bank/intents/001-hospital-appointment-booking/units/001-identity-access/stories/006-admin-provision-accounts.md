---
id: 006-admin-provision-accounts
unit: 001-identity-access
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 006-admin-provision-accounts

## User Story

**As a** hospital admin
**I want** invite/provision provider and staff accounts
**So that** only authorized personnel get access

## Acceptance Criteria

- [ ] **Given** I am an admin, **When** I invite a user with a role and facility, **Then** they receive an invite to set their password
- [ ] **Given** a non-admin, **When** they attempt to provision an account, **Then** the action is denied
- [ ] **Given** an invited user accepts, **When** they set a password, **Then** their account activates with the assigned role/facility

## Technical Notes

- Invite tokens are signed and expiring.

## Dependencies

### Requires
- 003-user-login

### Enables
- 007-rbac-enforcement

## Out of Scope

- Concerns owned by other units (see unit-brief).
