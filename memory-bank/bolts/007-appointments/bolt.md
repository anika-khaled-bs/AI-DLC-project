---
id: 007-appointments
unit: 004-appointments
intent: 001-hospital-appointment-booking
type: ddd-construction-bolt
status: planned
stories: [005-staff-book-on-behalf, 006-staff-view-schedule, 007-walk-in-registration-and-booking, 008-appointment-status-lifecycle]
created: 2026-06-04T12:40:00Z
started: null
completed: null
current_stage: null
stages_completed: []

requires_bolts: [006-appointments]
enables_bolts: [008-notifications, 009-payments, 010-medical-records]
requires_units: []
blocks: false

complexity:
  avg_complexity: 2
  avg_uncertainty: 2
  max_dependencies: 2
  testing_scope: 2
---

# Bolt: 007-appointments

## Overview

Staff-assisted scheduling, walk-ins, schedule views, and the appointment lifecycle/status model.

## Objective

Staff-assisted scheduling, walk-ins, schedule views, and the appointment lifecycle/status model.

## Stories Included

- **005-staff-book-on-behalf**: Staff booking (Must)
- **006-staff-view-schedule**: Schedule view (Must)
- **007-walk-in-registration-and-booking**: Walk-ins (Should)
- **008-appointment-status-lifecycle**: Lifecycle/status (Must)

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
- 006-appointments

### Enables
- 008-notifications, 009-payments, 010-medical-records

## Success Criteria

- [ ] All stories implemented
- [ ] All acceptance criteria met
- [ ] Tests passing
- [ ] Code reviewed
