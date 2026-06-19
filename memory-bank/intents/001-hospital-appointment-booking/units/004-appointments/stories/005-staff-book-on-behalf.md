---
id: 005-staff-book-on-behalf
unit: 004-appointments
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 005-staff-book-on-behalf

## User Story

**As a** front-desk staff
**I want** book/reschedule/cancel on behalf of a patient
**So that** I can serve patients who call or visit

## Acceptance Criteria

- [ ] **Given** staff scoped to a facility, **When** they select an existing patient and book a slot, **Then** the appointment is created and attributed to the staff actor in the audit log
- [ ] **Given** a patient who isn't registered, **When** staff books, **Then** staff can register the patient first (see walk-in)
- [ ] **Given** staff outside the facility, **When** they attempt to book there, **Then** it is denied

## Technical Notes

- All staff actions audited with staff identity.

## Dependencies

### Requires
- 004-reschedule-appointment

### Enables
- 006-staff-view-schedule

## Out of Scope

- Concerns owned by other units (see unit-brief).
