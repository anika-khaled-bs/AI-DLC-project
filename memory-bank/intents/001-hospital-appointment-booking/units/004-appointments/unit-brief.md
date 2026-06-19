---
unit: 004-appointments
intent: 001-hospital-appointment-booking
phase: inception
status: draft
created: 2026-06-04T12:40:00Z
updated: 2026-06-04T12:40:00Z
---

# Unit Brief: 004-appointments

## Purpose

The core booking domain: book/reschedule/cancel with concurrency-safe slot integrity, staff-assisted scheduling and walk-ins, and the appointment lifecycle/status model. Emits events consumed by notifications, payments, and records.

## Scope

### In Scope
- Booking, reschedule, cancel
- Double-booking prevention
- Staff-assisted booking and walk-ins
- Appointment lifecycle/status transitions and auditing

### Out of Scope
- Notification delivery (005-notifications)
- Payment capture (006-payments)
- Visit documentation (007-medical-records)

## Assigned Requirements

| FR | Requirement | Priority |
|----|-------------|----------|
| FR-6 | Appointment booking | Must |
| FR-7 | Reschedule & cancel | Must |
| FR-8 | Slot integrity / double-booking prevention | Must |
| FR-9 | Staff-assisted scheduling | Must |
| FR-10 | Appointment lifecycle & status | Must |

## Domain Concepts

### Key Entities
| Entity | Description | Attributes |
|--------|-------------|------------|
| Appointment | A booked visit | id, patient_id, provider_id, slot_id, status, reason |
| Patient | Person being seen | id, name, contact |
| StatusTransition | Lifecycle change | appointment_id, from, to, actor, ts |

### Key Operations
| Operation | Description | Inputs | Outputs |
|-----------|-------------|--------|---------|
| book | Reserve a slot atomically | patient, slot, reason | appointment + ref |
| reschedule | Swap slots atomically | appointment, new slot | appointment |
| cancel | Release slot per policy | appointment | status + events |
| transition | Move lifecycle state | appointment, target | status |

## Story Summary

| Metric | Count |
|--------|-------|
| Total Stories | 8 |
| Must Have | 7 |
| Should Have | 1 |
| Could Have | 0 |

### Stories
- [ ] **001-book-appointment** - Must - Planned
- [ ] **002-prevent-double-booking** - Must - Planned
- [ ] **003-cancel-appointment** - Must - Planned
- [ ] **004-reschedule-appointment** - Must - Planned
- [ ] **005-staff-book-on-behalf** - Must - Planned
- [ ] **006-staff-view-schedule** - Must - Planned
- [ ] **007-walk-in-registration-and-booking** - Should - Planned
- [ ] **008-appointment-status-lifecycle** - Must - Planned

## Dependencies

### Depends On
| Unit | Reason |
|------|--------|
| 003-scheduling | Provides bookable slots |
| 002-facility-directory | Facility scoping |
| 001-identity-access | Patient/staff identity & RBAC |

### Depended By
| Unit | Reason |
|------|--------|
| 005-notifications | Reacts to appointment events |
| 006-payments | Booking triggers copay |
| 007-medical-records | Docs attach to appointments |

### External Dependencies
| System | Purpose | Risk |
|--------|---------|------|
| None directly | Events consumed internally | Low |

## Technical Context

- Laravel 13 / Sail, MySQL 8.4 (see `memory-bank/standards/`). Bolt type: `ddd-construction-bolt`.

## Success Criteria

### Functional
- [ ] Concurrency-safe booking; exactly one winner per slot
- [ ] Reschedule/cancel respect policy windows
- [ ] Staff book on behalf and handle walk-ins; lifecycle enforced
### Non-Functional
- [ ] Booking confirmation p95 < 1s; all changes audited

### Quality
- [ ] Code coverage > 80%
- [ ] All acceptance criteria met
- [ ] Code reviewed and approved

## Bolt Suggestions

| Bolt | Type | Stories | Objective |
|------|------|---------|-----------|
| 006-appointments | DDD | 001-004 | Booking core: book, double-booking, cancel, reschedule |
| 007-appointments | DDD | 005-008 | Staff-assisted, walk-ins, lifecycle/status |

## Notes

Highest-risk unit (concurrency). Consider a spike if locking strategy is uncertain.
