---
id: 012-hospital-appointment-booking-ui
unit: 008-hospital-appointment-booking-ui
intent: 001-hospital-appointment-booking
type: simple-construction-bolt
status: planned
stories: [004-admin-console-ui, 005-patient-records-and-history-ui]
created: 2026-06-04T12:40:00Z
started: null
completed: null
current_stage: null
stages_completed: []

requires_bolts: [011-hospital-appointment-booking-ui]
enables_bolts: []
requires_units: [002-facility-directory, 007-medical-records]
blocks: false

complexity:
  avg_complexity: 2
  avg_uncertainty: 2
  max_dependencies: 2
  testing_scope: 2
---

# Bolt: 012-hospital-appointment-booking-ui

## Overview

Admin console and patient records/history UIs.

## Objective

Admin console and patient records/history UIs.

## Stories Included

- **004-admin-console-ui**: Admin console UI (Should)
- **005-patient-records-and-history-ui**: Patient records UI (Should)

## Bolt Type

**Type**: simple-construction-bolt
**Definition**: `.specsmd/aidlc/templates/construction/bolt-types/simple-construction-bolt.md`

## Stages

- [ ] **1. plan**: Pending → implementation-plan.md
- [ ] **2. implement**: Pending → src/
- [ ] **3. verify**: Pending → verification-report.md

## Dependencies

### Requires
- 011-hospital-appointment-booking-ui

### Enables
- Deployment / dependent bolts

## Success Criteria

- [ ] All stories implemented
- [ ] All acceptance criteria met
- [ ] Tests passing
- [ ] Code reviewed
