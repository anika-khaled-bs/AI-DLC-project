---
id: 003-staff-scheduling-dashboard-ui
unit: 008-hospital-appointment-booking-ui
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 003-staff-scheduling-dashboard-ui

## User Story

**As a** front-desk staff
**I want** a dashboard to view schedules and book on behalf / handle walk-ins
**So that** I can manage the front desk

## Acceptance Criteria

- [ ] **Given** the dashboard, **When** I open it, **Then** I see facility day/week schedules
- [ ] **Given** a patient (or walk-in), **When** I book/reschedule/cancel, **Then** it applies with staff attribution
- [ ] **Given** check-in/no-show actions, **When** taken, **Then** appointment status updates

## Technical Notes

- Consumes appointments APIs; facility-scoped.

## Dependencies

### Requires
- 002-provider-availability-ui

### Enables
- 004-admin-console-ui

## Out of Scope

- Concerns owned by other units (see unit-brief).
