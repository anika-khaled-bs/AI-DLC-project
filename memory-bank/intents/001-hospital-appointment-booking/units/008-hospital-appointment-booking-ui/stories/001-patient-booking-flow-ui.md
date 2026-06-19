---
id: 001-patient-booking-flow-ui
unit: 008-hospital-appointment-booking-ui
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 001-patient-booking-flow-ui

## User Story

**As a** patient
**I want** a guided UI to search providers and book/reschedule/cancel
**So that** I can self-serve appointments easily

## Acceptance Criteria

- [ ] **Given** the booking UI, **When** I search and pick a slot, **Then** I can complete a booking incl. copay where required
- [ ] **Given** the flow, **When** rendered, **Then** it meets WCAG 2.1 AA
- [ ] **Given** a slot taken during checkout, **When** I submit, **Then** I get a clear retry prompt

## Technical Notes

- Consumes scheduling, appointments, payments APIs.

## Dependencies

### Requires
- 004-appointments, 006-payments

### Enables
- 002-provider-availability-ui

## Out of Scope

- Concerns owned by other units (see unit-brief).
