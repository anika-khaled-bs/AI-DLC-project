---
id: 006-staff-view-schedule
unit: 004-appointments
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 006-staff-view-schedule

## User Story

**As a** front-desk staff
**I want** view day/week schedules for providers in my facility
**So that** I can manage the day's appointments

## Acceptance Criteria

- [ ] **Given** staff in a facility, **When** they open the schedule, **Then** providers' day/week appointments are shown
- [ ] **Given** the schedule, **When** filtered by provider/date, **Then** only matching appointments appear
- [ ] **Given** a schedule entry, **When** selected, **Then** staff can act on it (check-in, cancel, reschedule) per policy

## Technical Notes

- Facility-scoped read.

## Dependencies

### Requires
- 005-staff-book-on-behalf

### Enables
- 007-walk-in-registration-and-booking

## Out of Scope

- Concerns owned by other units (see unit-brief).
