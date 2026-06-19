---
id: 003-block-time-off
unit: 003-scheduling
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 003-block-time-off

## User Story

**As a** provider (or authorized staff)
**I want** block time-off and breaks
**So that** no appointments are bookable when I'm unavailable

## Acceptance Criteria

- [ ] **Given** a provider, **When** I block a date/time range, **Then** no bookable slots exist in that range
- [ ] **Given** existing bookings in a range I try to block, **When** I save, **Then** I am warned and the conflict is surfaced (not silently dropped)
- [ ] **Given** a removed time-off block, **When** saved, **Then** slots in that range become available again

## Technical Notes

- Time-off overrides working hours.

## Dependencies

### Requires
- 002-configure-slot-duration

### Enables
- 004-generate-bookable-slots

## Out of Scope

- Concerns owned by other units (see unit-brief).
