---
id: 007-walk-in-registration-and-booking
unit: 004-appointments
intent: 001-hospital-appointment-booking
status: draft
priority: should
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 007-walk-in-registration-and-booking

## User Story

**As a** front-desk staff
**I want** register a walk-in patient and book immediately
**So that** unregistered patients can still be served

## Acceptance Criteria

- [ ] **Given** a walk-in, **When** staff create a minimal patient record, **Then** the patient can be booked into an open slot
- [ ] **Given** a duplicate patient, **When** staff search first, **Then** the existing record is reused
- [ ] **Given** a walk-in booking, **When** complete, **Then** it follows the same slot-integrity rules as patient self-booking

## Technical Notes

- Reuse booking + patient lookup.

## Dependencies

### Requires
- 006-staff-view-schedule

### Enables
- 008-appointment-status-lifecycle

## Out of Scope

- Concerns owned by other units (see unit-brief).
