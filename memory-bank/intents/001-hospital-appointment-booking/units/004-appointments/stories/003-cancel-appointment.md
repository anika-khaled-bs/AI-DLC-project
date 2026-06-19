---
id: 003-cancel-appointment
unit: 004-appointments
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 003-cancel-appointment

## User Story

**As a** patient (or staff on their behalf)
**I want** cancel an appointment within policy
**So that** the slot is freed and I'm not charged unfairly

## Acceptance Criteria

- [ ] **Given** an appointment before the cancellation cutoff, **When** I cancel, **Then** it is marked cancelled and the slot returns to the open pool
- [ ] **Given** an appointment past the cutoff, **When** I cancel, **Then** it is blocked or flagged per facility policy
- [ ] **Given** a cancellation, **When** complete, **Then** downstream events (refund/notification) are emitted

## Technical Notes

- Configurable per-facility cutoff (e.g., 24h).

## Dependencies

### Requires
- 002-prevent-double-booking

### Enables
- 004-reschedule-appointment

## Out of Scope

- Concerns owned by other units (see unit-brief).
