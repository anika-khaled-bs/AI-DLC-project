---
id: 002-prevent-double-booking
unit: 004-appointments
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 002-prevent-double-booking

## User Story

**As a** platform
**I want** serialize concurrent booking attempts on a slot
**So that** a slot is held by at most one appointment

## Acceptance Criteria

- [ ] **Given** two simultaneous bookings for the same slot, **When** processed, **Then** exactly one succeeds and the other gets a clear "no longer available" error
- [ ] **Given** an already-booked slot, **When** a booking is attempted, **Then** it is rejected
- [ ] **Given** a non-existent slot id, **When** a booking is attempted, **Then** it is rejected

## Technical Notes

- Unique constraint on (slot) + pessimistic/optimistic locking.

## Dependencies

### Requires
- 001-book-appointment

### Enables
- 003-cancel-appointment

## Out of Scope

- Concerns owned by other units (see unit-brief).
