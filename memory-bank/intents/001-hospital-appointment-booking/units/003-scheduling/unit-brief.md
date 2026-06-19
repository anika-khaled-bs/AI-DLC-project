---
unit: 003-scheduling
intent: 001-hospital-appointment-booking
phase: inception
status: draft
created: 2026-06-04T12:40:00Z
updated: 2026-06-04T12:40:00Z
---

# Unit Brief: 003-scheduling

## Purpose

Provider availability (working hours, slot duration, time-off), generation of fixed bookable slots, and patient-facing provider search/discovery.

## Scope

### In Scope
- Recurring working hours and slot duration
- Time-off/breaks
- Bookable-slot generation
- Provider search and next-available-slot views

### Out of Scope
- Creating appointments (004-appointments)
- Provider provisioning (002-facility-directory)

## Assigned Requirements

| FR | Requirement | Priority |
|----|-------------|----------|
| FR-4 | Provider availability & slot management | Must |
| FR-5 | Provider search & discovery | Must |

## Domain Concepts

### Key Entities
| Entity | Description | Attributes |
|--------|-------------|------------|
| AvailabilityRule | Recurring working hours | provider_id, weekday, start, end |
| TimeOff | Blocked range | provider_id, start, end |
| Slot | A bookable fixed time-slot | provider_id, start, duration, status |

### Key Operations
| Operation | Description | Inputs | Outputs |
|-----------|-------------|--------|---------|
| generateSlots | Materialize open slots | rules, time-off, range | slots |
| searchProviders | Filter providers | specialty, facility, date | providers + next slot |

## Story Summary

| Metric | Count |
|--------|-------|
| Total Stories | 6 |
| Must Have | 6 |
| Should Have | 0 |
| Could Have | 0 |

### Stories
- [ ] **001-define-provider-working-hours** - Must - Planned
- [ ] **002-configure-slot-duration** - Must - Planned
- [ ] **003-block-time-off** - Must - Planned
- [ ] **004-generate-bookable-slots** - Must - Planned
- [ ] **005-search-providers** - Must - Planned
- [ ] **006-view-next-available-slots** - Must - Planned

## Dependencies

### Depends On
| Unit | Reason |
|------|--------|
| 002-facility-directory | Providers/departments to schedule |

### Depended By
| Unit | Reason |
|------|--------|
| 004-appointments | Books against generated slots |

### External Dependencies
| System | Purpose | Risk |
|--------|---------|------|
| None | - | Low |

## Technical Context

- Laravel 13 / Sail, MySQL 8.4 (see `memory-bank/standards/`). Bolt type: `ddd-construction-bolt`.

## Success Criteria

### Functional
- [ ] Providers define hours/duration/time-off; slots generated correctly
- [ ] Patients search and see next available slots
### Non-Functional
- [ ] Search p95 < 500ms; slot listing p95 < 400ms

### Quality
- [ ] Code coverage > 80%
- [ ] All acceptance criteria met
- [ ] Code reviewed and approved

## Bolt Suggestions

| Bolt | Type | Stories | Objective |
|------|------|---------|-----------|
| 004-scheduling | DDD | 001-004 | Availability rules, time-off, slot generation |
| 005-scheduling | DDD | 005-006 | Provider search & availability views |

## Notes

Slot integrity is enforced at booking time in 004-appointments.
