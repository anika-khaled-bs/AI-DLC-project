---
id: 008-appointment-status-lifecycle
unit: 004-appointments
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 008-appointment-status-lifecycle

## User Story

**As a** provider or staff
**I want** move appointments through their lifecycle
**So that** the visit state is tracked accurately

## Acceptance Criteria

- [ ] **Given** a booked appointment, **When** the patient arrives, **Then** staff can mark check-in; later complete; or mark no-show
- [ ] **Given** a cancelled appointment, **When** completion is attempted, **Then** the invalid transition is rejected
- [ ] **Given** any status change, **When** saved, **Then** it is timestamped and audited

## Technical Notes

- Enforce allowed transition graph.

## Dependencies

### Requires
- 007-walk-in-registration-and-booking

### Enables
- 005-notifications, 006-payments, 007-medical-records

## Out of Scope

- Concerns owned by other units (see unit-brief).
