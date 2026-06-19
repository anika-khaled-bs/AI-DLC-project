---
id: 002-identity-access
unit: 001-identity-access
intent: 001-hospital-appointment-booking
type: ddd-construction-bolt
status: planned
stories: [005-mfa-for-privileged-roles, 006-admin-provision-accounts, 007-rbac-enforcement, 008-role-change-audit]
created: 2026-06-04T12:40:00Z
started: null
completed: null
current_stage: null
stages_completed: []

requires_bolts: [001-identity-access]
enables_bolts: [003-facility-directory, 011-hospital-appointment-booking-ui]
requires_units: []
blocks: false

complexity:
  avg_complexity: 2
  avg_uncertainty: 2
  max_dependencies: 2
  testing_scope: 2
---

# Bolt: 002-identity-access

## Overview

Access control: MFA for privileged roles, admin provisioning, facility-scoped RBAC, and role-change auditing.

## Objective

Access control: MFA for privileged roles, admin provisioning, facility-scoped RBAC, and role-change auditing.

## Stories Included

- **005-mfa-for-privileged-roles**: MFA for privileged roles (Must)
- **006-admin-provision-accounts**: Admin provisioning (Must)
- **007-rbac-enforcement**: RBAC enforcement (Must)
- **008-role-change-audit**: Role-change audit (Should)

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
- 001-identity-access

### Enables
- 003-facility-directory, 011-hospital-appointment-booking-ui

## Success Criteria

- [ ] All stories implemented
- [ ] All acceptance criteria met
- [ ] Tests passing
- [ ] Code reviewed
