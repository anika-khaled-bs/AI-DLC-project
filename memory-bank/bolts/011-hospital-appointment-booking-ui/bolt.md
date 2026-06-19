---
id: 011-hospital-appointment-booking-ui
unit: 008-hospital-appointment-booking-ui
intent: 001-hospital-appointment-booking
type: simple-construction-bolt
status: planned
stories: [001-patient-booking-flow-ui, 002-provider-availability-ui, 003-staff-scheduling-dashboard-ui]
created: 2026-06-04T12:40:00Z
started: null
completed: null
current_stage: null
stages_completed: []

requires_bolts: [006-appointments, 007-appointments]
enables_bolts: [012-hospital-appointment-booking-ui]
requires_units: [004-appointments, 003-scheduling]
blocks: false

complexity:
  avg_complexity: 2
  avg_uncertainty: 2
  max_dependencies: 2
  testing_scope: 2
---

# Bolt: 011-hospital-appointment-booking-ui

## Overview

Patient booking flow, provider availability, and staff scheduling dashboard UIs.

## Objective

Patient booking flow, provider availability, and staff scheduling dashboard UIs.

## Stories Included

- **001-patient-booking-flow-ui**: Patient booking UI (Must)
- **002-provider-availability-ui**: Provider availability UI (Must)
- **003-staff-scheduling-dashboard-ui**: Staff dashboard UI (Must)

## Bolt Type

**Type**: simple-construction-bolt
**Definition**: `.specsmd/aidlc/templates/construction/bolt-types/simple-construction-bolt.md`

## Stages

- [ ] **1. plan**: Pending → implementation-plan.md
- [ ] **2. implement**: Pending → src/
- [ ] **3. verify**: Pending → verification-report.md

## Dependencies

### Requires
- 006-appointments, 007-appointments

### Enables
- 012-hospital-appointment-booking-ui

## Success Criteria

- [ ] All stories implemented
- [ ] All acceptance criteria met
- [ ] Tests passing
- [ ] Code reviewed
