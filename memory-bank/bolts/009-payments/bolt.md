---
id: 009-payments
unit: 006-payments
intent: 001-hospital-appointment-booking
type: ddd-construction-bolt
status: planned
stories: [001-collect-copay-at-booking, 002-gate-booking-on-payment, 003-refund-on-cancellation]
created: 2026-06-04T12:40:00Z
started: null
completed: null
current_stage: null
stages_completed: []

requires_bolts: [006-appointments, 007-appointments]
enables_bolts: []
requires_units: [004-appointments]
blocks: false

complexity:
  avg_complexity: 3
  avg_uncertainty: 3
  max_dependencies: 2
  testing_scope: 2
---

# Bolt: 009-payments

## Overview

Copay collection at booking, payment-gated confirmation, and refunds via tokenized provider.

## Objective

Copay collection at booking, payment-gated confirmation, and refunds via tokenized provider.

## Stories Included

- **001-collect-copay-at-booking**: Collect copay (Should)
- **002-gate-booking-on-payment**: Payment gating (Should)
- **003-refund-on-cancellation**: Refunds (Should)

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
- 006-appointments, 007-appointments

### Enables
- Deployment / dependent bolts

## Success Criteria

- [ ] All stories implemented
- [ ] All acceptance criteria met
- [ ] Tests passing
- [ ] Code reviewed
