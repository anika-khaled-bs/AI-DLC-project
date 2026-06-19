---
id: 006-view-next-available-slots
unit: 003-scheduling
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 006-view-next-available-slots

## User Story

**As a** patient
**I want** view a provider's open slots for a chosen date
**So that** I can choose a time to book

## Acceptance Criteria

- [ ] **Given** a provider and date, **When** I view availability, **Then** open fixed slots are listed in chronological order
- [ ] **Given** a fully booked day, **When** I view it, **Then** I see no open slots and a suggestion of the next available day
- [ ] **Given** a slot just booked by someone else, **When** I refresh, **Then** it no longer appears

## Technical Notes

- Read-optimized availability query.

## Dependencies

### Requires
- 005-search-providers

### Enables
- None

## Out of Scope

- Concerns owned by other units (see unit-brief).
