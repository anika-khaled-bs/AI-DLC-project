---
id: 002-appointment-reminder
unit: 005-notifications
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 002-appointment-reminder

## User Story

**As a** patient
**I want** receive a reminder before my appointment
**So that** I'm less likely to miss it

## Acceptance Criteria

- [ ] **Given** an upcoming appointment, **When** the facility-configured lead time is reached (e.g., 24h), **Then** a reminder is sent
- [ ] **Given** a cancelled appointment, **When** the reminder window arrives, **Then** no reminder is sent
- [ ] **Given** reminder preferences, **When** a patient opts out of SMS, **Then** the channel preference is respected

## Technical Notes

- Scheduled job scans upcoming appointments.

## Dependencies

### Requires
- 001-booking-confirmation-notification

### Enables
- 003-cancellation-reschedule-notification

## Out of Scope

- Concerns owned by other units (see unit-brief).
