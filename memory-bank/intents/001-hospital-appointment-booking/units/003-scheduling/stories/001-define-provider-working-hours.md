---
id: 001-define-provider-working-hours
unit: 003-scheduling
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 001-define-provider-working-hours

## User Story

**As a** provider (or authorized staff)
**I want** define recurring weekly working hours
**So that** bookable slots can be generated

## Acceptance Criteria

- [ ] **Given** a provider, **When** I set weekly working hours per facility, **Then** they are saved and used for slot generation
- [ ] **Given** overlapping hour entries, **When** I save, **Then** I get a validation error
- [ ] **Given** updated working hours, **When** saved, **Then** future slot generation reflects the change without altering booked appointments

## Technical Notes

- Store as recurring rules; resolve per date.

## Dependencies

### Requires
- 002-facility-directory:003-invite-and-assign-providers

### Enables
- 002-configure-slot-duration

## Out of Scope

- Concerns owned by other units (see unit-brief).
