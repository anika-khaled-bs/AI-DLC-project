---
id: 003-facility-directory
unit: 002-facility-directory
intent: 001-hospital-appointment-booking
type: ddd-construction-bolt
status: planned
stories: [001-manage-facilities, 002-manage-departments, 003-invite-and-assign-providers, 004-assign-staff-to-facility, 005-deactivate-provider-preserve-history]
created: 2026-06-04T12:40:00Z
started: null
completed: null
current_stage: null
stages_completed: []

requires_bolts: [002-identity-access]
enables_bolts: [004-scheduling]
requires_units: [001-identity-access]
blocks: false

complexity:
  avg_complexity: 2
  avg_uncertainty: 1
  max_dependencies: 2
  testing_scope: 2
---

# Bolt: 003-facility-directory

## Overview

Facility/department administration and provider/staff assignment, with history-preserving deactivation.

## Objective

Facility/department administration and provider/staff assignment, with history-preserving deactivation.

## Stories Included

- **001-manage-facilities**: Manage facilities (Must)
- **002-manage-departments**: Manage departments (Must)
- **003-invite-and-assign-providers**: Assign providers (Must)
- **004-assign-staff-to-facility**: Assign staff (Must)
- **005-deactivate-provider-preserve-history**: Deactivate provider (Should)

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
- 002-identity-access

### Enables
- 004-scheduling

## Success Criteria

- [ ] All stories implemented
- [ ] All acceptance criteria met
- [ ] Tests passing
- [ ] Code reviewed
