---
id: 004-generate-bookable-slots
unit: 003-scheduling
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 004-generate-bookable-slots

## User Story

**As a** platform
**I want** generate fixed bookable slots from hours, duration, and time-off
**So that** patients can pick open slots

## Acceptance Criteria

- [ ] **Given** working hours, duration, and time-off, **When** slots are generated for a date range, **Then** only valid open slots appear
- [ ] **Given** a blocked or past time, **When** slots are generated, **Then** no slot is produced there
- [ ] **Given** a booked slot, **When** availability is queried, **Then** it is excluded from open slots

## Technical Notes

- Slot listing p95 < 400ms; index by provider+date.

## Dependencies

### Requires
- 003-block-time-off

### Enables
- 005-appointments:001-book-appointment

## Out of Scope

- Concerns owned by other units (see unit-brief).
