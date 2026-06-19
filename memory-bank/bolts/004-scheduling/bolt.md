---
id: 004-scheduling
unit: 003-scheduling
intent: 001-hospital-appointment-booking
type: ddd-construction-bolt
status: planned
stories: [001-define-provider-working-hours, 002-configure-slot-duration, 003-block-time-off, 004-generate-bookable-slots]
created: 2026-06-04T12:40:00Z
started: null
completed: null
current_stage: null
stages_completed: []

requires_bolts: [003-facility-directory]
enables_bolts: [005-scheduling]
requires_units: [002-facility-directory]
blocks: false

complexity:
  avg_complexity: 2
  avg_uncertainty: 2
  max_dependencies: 2
  testing_scope: 2
---

# Bolt: 004-scheduling

## Overview

Availability rules, slot duration, time-off, and bookable-slot generation.

## Objective

Availability rules, slot duration, time-off, and bookable-slot generation.

## Stories Included

- **001-define-provider-working-hours**: Working hours (Must)
- **002-configure-slot-duration**: Slot duration (Must)
- **003-block-time-off**: Time-off (Must)
- **004-generate-bookable-slots**: Slot generation (Must)

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
- 003-facility-directory

### Enables
- 005-scheduling

## Success Criteria

- [ ] All stories implemented
- [ ] All acceptance criteria met
- [ ] Tests passing
- [ ] Code reviewed
