---
id: 002-provider-availability-ui
unit: 008-hospital-appointment-booking-ui
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 002-provider-availability-ui

## User Story

**As a** provider
**I want** a UI to manage working hours, slot duration, and time-off
**So that** I control my bookable availability

## Acceptance Criteria

- [ ] **Given** the availability UI, **When** I edit hours/duration/time-off, **Then** changes save and reflect in generated slots
- [ ] **Given** a conflict with existing bookings, **When** I save time-off, **Then** I'm warned
- [ ] **Given** the UI, **When** rendered, **Then** it is accessible

## Technical Notes

- Consumes scheduling APIs.

## Dependencies

### Requires
- 001-patient-booking-flow-ui

### Enables
- 003-staff-scheduling-dashboard-ui

## Out of Scope

- Concerns owned by other units (see unit-brief).
