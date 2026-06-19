---
id: 004-reschedule-appointment
unit: 004-appointments
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 004-reschedule-appointment

## User Story

**As a** patient (or staff on their behalf)
**I want** reschedule to a different open slot
**So that** I can change my visit time safely

## Acceptance Criteria

- [ ] **Given** a new open slot, **When** I reschedule, **Then** the old slot is released and the new slot is booked atomically
- [ ] **Given** the new slot is taken mid-operation, **When** rescheduling, **Then** the original booking is preserved and I'm told to pick again
- [ ] **Given** a reschedule, **When** complete, **Then** a notification is emitted

## Technical Notes

- Single transaction: release old + acquire new; no orphaned slot.

## Dependencies

### Requires
- 003-cancel-appointment

### Enables
- 008-appointment-status-lifecycle

## Out of Scope

- Concerns owned by other units (see unit-brief).
