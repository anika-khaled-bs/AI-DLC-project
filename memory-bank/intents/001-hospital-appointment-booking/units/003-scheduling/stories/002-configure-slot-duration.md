---
id: 002-configure-slot-duration
unit: 003-scheduling
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 002-configure-slot-duration

## User Story

**As a** provider
**I want** configure slot length
**So that** appointments are the right granularity

## Acceptance Criteria

- [ ] **Given** a provider, **When** I set slot duration (e.g., 15/30 min), **Then** generated slots use that length
- [ ] **Given** an invalid duration, **When** I save, **Then** I see a validation error
- [ ] **Given** a duration change, **When** saved, **Then** only future (unbooked) slots are regenerated

## Technical Notes

- Duration per provider/department.

## Dependencies

### Requires
- 001-define-provider-working-hours

### Enables
- 004-generate-bookable-slots

## Out of Scope

- Concerns owned by other units (see unit-brief).
