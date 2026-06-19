---
id: 006-appointments
unit: 004-appointments
intent: 001-hospital-appointment-booking
type: ddd-construction-bolt
status: planned
stories: [001-book-appointment, 002-prevent-double-booking, 003-cancel-appointment, 004-reschedule-appointment]
created: 2026-06-04T12:40:00Z
started: null
completed: null
current_stage: null
stages_completed: []

requires_bolts: [005-scheduling]
enables_bolts: [007-appointments, 008-notifications, 009-payments]
requires_units: [003-scheduling]
blocks: false

complexity:
  avg_complexity: 3
  avg_uncertainty: 2
  max_dependencies: 2
  testing_scope: 2
---

# Bolt: 006-appointments

## Overview

Booking core: concurrency-safe booking, double-booking prevention, cancel, and atomic reschedule.

## Objective

Booking core: concurrency-safe booking, double-booking prevention, cancel, and atomic reschedule.

## Stories Included

- **001-book-appointment**: Book appointment (Must)
- **002-prevent-double-booking**: Prevent double-booking (Must)
- **003-cancel-appointment**: Cancel (Must)
- **004-reschedule-appointment**: Reschedule (Must)

## Bolt Type

**Type**: ddd-construction-bolt
**Definition**: `.specsmd/aidlc/templates/construction/bolt-types/ddd-construction-bolt.md`

## Stages

- [ ] **1. model**: Pending → ddd-01-domain-model.md
- [ ] **2. design**: Pending → ddd-02-technical-design.md
- [ ] **3. implement**: Pending → src/
- [ ] **4. test**: Pending → ddd-03-test-report.md

## Dependencies

### Requires
- 005-scheduling

### Enables
- 007-appointments, 008-notifications, 009-payments

## Success Criteria

- [ ] All stories implemented
- [ ] All acceptance criteria met
- [ ] Tests passing
- [ ] Code reviewed
