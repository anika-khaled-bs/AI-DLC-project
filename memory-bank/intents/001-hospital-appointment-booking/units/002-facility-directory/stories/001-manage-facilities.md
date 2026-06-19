---
id: 001-manage-facilities
unit: 002-facility-directory
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 001-manage-facilities

## User Story

**As a** hospital admin
**I want** create, edit, and deactivate facilities
**So that** the network's hospitals are accurately represented

## Acceptance Criteria

- [ ] **Given** I am an admin, **When** I create a facility with name/address, **Then** it becomes available for departments and providers
- [ ] **Given** an existing facility, **When** I edit it, **Then** changes persist and are audited
- [ ] **Given** a facility, **When** I deactivate it, **Then** its providers stop appearing in new searches but history is preserved

## Technical Notes

- Soft-deactivate, never hard-delete (history).

## Dependencies

### Requires
- 001-identity-access:007-rbac-enforcement

### Enables
- 002-manage-departments

## Out of Scope

- Concerns owned by other units (see unit-brief).
