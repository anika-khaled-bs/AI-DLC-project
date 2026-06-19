---
id: 005-scheduling
unit: 003-scheduling
intent: 001-hospital-appointment-booking
type: ddd-construction-bolt
status: planned
stories: [005-search-providers, 006-view-next-available-slots]
created: 2026-06-04T12:40:00Z
started: null
completed: null
current_stage: null
stages_completed: []

requires_bolts: [004-scheduling]
enables_bolts: [006-appointments]
requires_units: []
blocks: false

complexity:
  avg_complexity: 2
  avg_uncertainty: 1
  max_dependencies: 2
  testing_scope: 2
---

# Bolt: 005-scheduling

## Overview

Patient-facing provider search and next-available-slot views.

## Objective

Patient-facing provider search and next-available-slot views.

## Stories Included

- **005-search-providers**: Provider search (Must)
- **006-view-next-available-slots**: Next available slots (Must)

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
- 004-scheduling

### Enables
- 006-appointments

## Success Criteria

- [ ] All stories implemented
- [ ] All acceptance criteria met
- [ ] Tests passing
- [ ] Code reviewed
