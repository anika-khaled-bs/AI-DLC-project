---
id: 004-assign-staff-to-facility
unit: 002-facility-directory
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 004-assign-staff-to-facility

## User Story

**As a** hospital admin
**I want** assign front-desk staff to facilities
**So that** staff can manage schedules within their facility only

## Acceptance Criteria

- [ ] **Given** an admin, **When** I assign staff to a facility, **Then** the staff member's actions are scoped to that facility
- [ ] **Given** staff assigned to facility A, **When** they access facility B data, **Then** it is denied
- [ ] **Given** a staff reassignment, **When** saved, **Then** it is audited and takes effect immediately

## Technical Notes

- Facility scope enforced via policies.

## Dependencies

### Requires
- 003-invite-and-assign-providers

### Enables
- 005-deactivate-provider-preserve-history

## Out of Scope

- Concerns owned by other units (see unit-brief).
