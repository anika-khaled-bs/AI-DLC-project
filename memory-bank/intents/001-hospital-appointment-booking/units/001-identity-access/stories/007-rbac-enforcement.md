---
id: 007-rbac-enforcement
unit: 001-identity-access
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 007-rbac-enforcement

## User Story

**As a** platform
**I want** enforce role-based, facility-scoped access
**So that** users only access what HIPAA minimum-necessary allows

## Acceptance Criteria

- [ ] **Given** a user in one role, **When** they request an action outside their role, **Then** it is denied (403)
- [ ] **Given** staff/admin, **When** they access PHI outside their assigned facility/department, **Then** it is denied
- [ ] **Given** any PHI access, **When** it occurs, **Then** it is written to the immutable audit log

## Technical Notes

- Laravel policies/gates; facility scoping on queries.

## Dependencies

### Requires
- 003-user-login

### Enables
- All PHI-touching units

## Out of Scope

- Concerns owned by other units (see unit-brief).
