---
id: 001-booking-confirmation-notification
unit: 005-notifications
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 001-booking-confirmation-notification

## User Story

**As a** patient
**I want** receive a confirmation when I book
**So that** I have proof and details of my appointment

## Acceptance Criteria

- [ ] **Given** a successful booking, **When** it is created, **Then** an email/SMS confirmation with reference and time is sent
- [ ] **Given** a notification, **When** composed, **Then** it discloses only minimum-necessary PHI
- [ ] **Given** a transient send failure, **When** it occurs, **Then** the send is retried and failures are logged

## Technical Notes

- Async queue; vendor under BAA.

## Dependencies

### Requires
- 004-appointments:001-book-appointment

### Enables
- 002-appointment-reminder

## Out of Scope

- Concerns owned by other units (see unit-brief).
