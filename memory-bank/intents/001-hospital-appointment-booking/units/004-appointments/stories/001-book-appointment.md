---
id: 001-book-appointment
unit: 004-appointments
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 001-book-appointment

## User Story

**As a** patient
**I want** book an open fixed time-slot with a provider
**So that** I secure a visit

## Acceptance Criteria

- [ ] **Given** an open slot, **When** I book it with a visit reason, **Then** an appointment is created and I get a confirmation reference
- [ ] **Given** required intake fields, **When** booking, **Then** the booking is rejected if any required field is missing
- [ ] **Given** a successful booking, **When** complete, **Then** the slot immediately becomes unavailable to others

## Technical Notes

- Wrap booking in a DB transaction.

## Dependencies

### Requires
- 003-scheduling:004-generate-bookable-slots

### Enables
- 002-prevent-double-booking

## Out of Scope

- Concerns owned by other units (see unit-brief).
