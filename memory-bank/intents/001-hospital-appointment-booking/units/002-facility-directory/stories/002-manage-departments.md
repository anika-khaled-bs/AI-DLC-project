---
id: 002-manage-departments
unit: 002-facility-directory
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 002-manage-departments

## User Story

**As a** hospital admin
**I want** manage departments within a facility
**So that** providers and specialties are organized

## Acceptance Criteria

- [ ] **Given** a facility, **When** I add a department/specialty, **Then** providers can be assigned to it
- [ ] **Given** a department, **When** I edit/deactivate it, **Then** changes persist and are audited
- [ ] **Given** a deactivated department, **When** patients search, **Then** it no longer appears

## Technical Notes

- Department belongs to a facility.

## Dependencies

### Requires
- 001-manage-facilities

### Enables
- 003-invite-and-assign-providers

## Out of Scope

- Concerns owned by other units (see unit-brief).
