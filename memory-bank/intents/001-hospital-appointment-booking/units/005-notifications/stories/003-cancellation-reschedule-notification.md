---
id: 003-cancellation-reschedule-notification
unit: 005-notifications
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 003-cancellation-reschedule-notification

## User Story

**As a** patient
**I want** be notified when my appointment is cancelled or rescheduled
**So that** I'm aware of changes

## Acceptance Criteria

- [ ] **Given** a cancellation, **When** it is processed, **Then** a notice is sent to the patient (and provider/staff if configured)
- [ ] **Given** a reschedule, **When** it completes, **Then** a notice with the new time is sent
- [ ] **Given** a staff-initiated change, **When** it occurs, **Then** the patient is notified

## Technical Notes

- Reacts to appointment events.

## Dependencies

### Requires
- 002-appointment-reminder

### Enables
- None

## Out of Scope

- Concerns owned by other units (see unit-brief).
