---
unit: 006-payments
intent: 001-hospital-appointment-booking
phase: inception
status: draft
created: 2026-06-04T12:40:00Z
updated: 2026-06-04T12:40:00Z
---

# Unit Brief: 006-payments

## Purpose

Copay collection at booking via a tokenized payment provider, payment-gated confirmation, and refunds — no raw card data stored locally.

## Scope

### In Scope
- Copay charge at booking
- Payment-gated (or deferred) confirmation
- Refunds on cancellation

### Out of Scope
- Booking lifecycle (004-appointments)
- Insurance eligibility/claims (out of scope)

## Assigned Requirements

| FR | Requirement | Priority |
|----|-------------|----------|
| FR-12 | Payments / copay collection | Should |

## Domain Concepts

### Key Entities
| Entity | Description | Attributes |
|--------|-------------|------------|
| Payment | A copay charge | id, appointment_id, amount, token, status |
| Refund | A reversal | payment_id, amount, status |

### Key Operations
| Operation | Description | Inputs | Outputs |
|-----------|-------------|--------|---------|
| charge | Collect copay | appointment, amount | payment |
| gate | Confirm on payment | payment status | booking decision |
| refund | Reverse on cancel | payment | refund |

## Story Summary

| Metric | Count |
|--------|-------|
| Total Stories | 3 |
| Must Have | 0 |
| Should Have | 3 |
| Could Have | 0 |

### Stories
- [ ] **001-collect-copay-at-booking** - Should - Planned
- [ ] **002-gate-booking-on-payment** - Should - Planned
- [ ] **003-refund-on-cancellation** - Should - Planned

## Dependencies

### Depends On
| Unit | Reason |
|------|--------|
| 004-appointments | Booking triggers payment |

### Depended By
| Unit | Reason |
|------|--------|
| None | Terminal consumer |

### External Dependencies
| System | Purpose | Risk |
|--------|---------|------|
| Payment provider | Tokenized charges/refunds (BAA, PCI) | High |

## Technical Context

- Laravel 13 / Sail, MySQL 8.4 (see `memory-bank/standards/`). Bolt type: `ddd-construction-bolt`.

## Success Criteria

### Functional
- [ ] Copay collected; booking gated on payment; refunds issued
### Non-Functional
- [ ] No PAN stored; tokens only; payment events audited

### Quality
- [ ] Code coverage > 80%
- [ ] All acceptance criteria met
- [ ] Code reviewed and approved

## Bolt Suggestions

| Bolt | Type | Stories | Objective |
|------|------|---------|-----------|
| 009-payments | DDD | 001-003 | Copay charge, payment gating, refunds |

## Notes

Provider selection is an open question (BAA/PCI required).
