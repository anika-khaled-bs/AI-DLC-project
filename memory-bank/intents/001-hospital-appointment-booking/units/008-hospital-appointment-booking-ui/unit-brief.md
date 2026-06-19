---
unit: 008-hospital-appointment-booking-ui
intent: 001-hospital-appointment-booking
phase: inception
status: draft
created: 2026-06-04T12:40:00Z
updated: 2026-06-04T12:40:00Z
unit_type: frontend
default_bolt_type: simple-construction-bolt
---

# Unit Brief: 008-hospital-appointment-booking-ui

## Purpose

Web UI for all four roles: patient booking flow, provider availability management, staff scheduling dashboard, admin console, and patient records/history. Consumes all backend units' APIs; meets WCAG 2.1 AA on patient-facing flows.

## Scope

### In Scope
- Patient booking/reschedule/cancel + copay UI
- Provider availability UI
- Staff scheduling dashboard
- Admin console
- Patient records/history UI

### Out of Scope
- Backend business logic (owned by backend units)
- Payment processing internals (006-payments)

## Assigned Requirements

| FR | Requirement | Priority |
|----|-------------|----------|
| All user-facing FRs | UI for FR-1..FR-13 | Must/Should |

## Domain Concepts

### Key Entities
| Entity | Description | Attributes |
|--------|-------------|------------|
| (UI consumes backend resources via API) | Pages/components/state | - |

### Key Operations
| Operation | Description | Inputs | Outputs |
|-----------|-------------|--------|---------|
| renderFlows | Role-specific UIs | API data | rendered pages |

## Story Summary

| Metric | Count |
|--------|-------|
| Total Stories | 5 |
| Must Have | 3 |
| Should Have | 2 |
| Could Have | 0 |

### Stories
- [ ] **001-patient-booking-flow-ui** - Must - Planned
- [ ] **002-provider-availability-ui** - Must - Planned
- [ ] **003-staff-scheduling-dashboard-ui** - Must - Planned
- [ ] **004-admin-console-ui** - Should - Planned
- [ ] **005-patient-records-and-history-ui** - Should - Planned

## Dependencies

### Depends On
| Unit | Reason |
|------|--------|
| All backend units | Consumes their APIs |

### Depended By
| Unit | Reason |
|------|--------|
| None | Top of stack |

### External Dependencies
| System | Purpose | Risk |
|--------|---------|------|
| Backend APIs | Data + actions | Medium |

## Technical Context

- Laravel 13 / Sail, MySQL 8.4 (see `memory-bank/standards/`). Bolt type: `simple-construction-bolt`.

## Success Criteria

### Functional
- [ ] All four roles have working UI flows
### Non-Functional
- [ ] Patient-facing flows meet WCAG 2.1 AA

### Quality
- [ ] Code coverage > 80%
- [ ] All acceptance criteria met
- [ ] Code reviewed and approved

## Bolt Suggestions

| Bolt | Type | Stories | Objective |
|------|------|---------|-----------|
| 011-hospital-appointment-booking-ui | simple | 001-003 | Patient, provider, staff UIs |
| 012-hospital-appointment-booking-ui | simple | 004-005 | Admin console + patient records UI |

## Notes

Frontend unit uses simple-construction-bolt; can build per-role UI as backends land.
