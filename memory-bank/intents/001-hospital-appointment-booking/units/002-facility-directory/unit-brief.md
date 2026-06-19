---
unit: 002-facility-directory
intent: 001-hospital-appointment-booking
phase: inception
status: draft
created: 2026-06-04T12:40:00Z
updated: 2026-06-04T12:40:00Z
---

# Unit Brief: 002-facility-directory

## Purpose

Administration of the network's facilities, departments, providers, and staff assignments — the organizational backbone that scheduling and access control depend on.

## Scope

### In Scope
- Facility CRUD and (de)activation
- Department/specialty management
- Provider provisioning/assignment
- Staff-to-facility assignment
- Provider deactivation preserving history

### Out of Scope
- Authentication (001-identity-access)
- Availability/slots (003-scheduling)

## Assigned Requirements

| FR | Requirement | Priority |
|----|-------------|----------|
| FR-3 | Facility, department & provider administration | Must |

## Domain Concepts

### Key Entities
| Entity | Description | Attributes |
|--------|-------------|------------|
| Facility | A hospital/clinic in the network | id, name, address, status |
| Department | Specialty area within a facility | id, facility_id, name, status |
| ProviderAssignment | Provider ↔ facility/department | provider_id, facility_id, dept_id |
| StaffAssignment | Staff ↔ facility | staff_id, facility_id |

### Key Operations
| Operation | Description | Inputs | Outputs |
|-----------|-------------|--------|---------|
| manageFacility | Create/edit/deactivate facility | facility data | facility |
| assignProvider | Bind provider to dept | ids | assignment |
| deactivateProvider | Hide future slots, keep history | provider_id | status |

## Story Summary

| Metric | Count |
|--------|-------|
| Total Stories | 5 |
| Must Have | 4 |
| Should Have | 1 |
| Could Have | 0 |

### Stories
- [ ] **001-manage-facilities** - Must - Planned
- [ ] **002-manage-departments** - Must - Planned
- [ ] **003-invite-and-assign-providers** - Must - Planned
- [ ] **004-assign-staff-to-facility** - Must - Planned
- [ ] **005-deactivate-provider-preserve-history** - Should - Planned

## Dependencies

### Depends On
| Unit | Reason |
|------|--------|
| 001-identity-access | Roles/permissions for admin actions |

### Depended By
| Unit | Reason |
|------|--------|
| 003-scheduling | Needs providers/departments |
| 004-appointments | Facility scoping |

### External Dependencies
| System | Purpose | Risk |
|--------|---------|------|
| None | - | Low |

## Technical Context

- Laravel 13 / Sail, MySQL 8.4 (see `memory-bank/standards/`). Bolt type: `ddd-construction-bolt`.

## Success Criteria

### Functional
- [ ] Admins manage facilities/departments/providers/staff
- [ ] Deactivation hides future slots, preserves history
### Non-Functional
- [ ] All administrative changes audited

### Quality
- [ ] Code coverage > 80%
- [ ] All acceptance criteria met
- [ ] Code reviewed and approved

## Bolt Suggestions

| Bolt | Type | Stories | Objective |
|------|------|---------|-----------|
| 003-facility-directory | DDD | 001-005 | Facilities, departments, provider/staff assignment |

## Notes

Depends on identity-access roles; precedes scheduling.
