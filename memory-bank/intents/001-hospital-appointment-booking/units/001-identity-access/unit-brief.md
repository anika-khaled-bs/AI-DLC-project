---
unit: 001-identity-access
intent: 001-hospital-appointment-booking
phase: inception
status: draft
created: 2026-06-04T12:40:00Z
updated: 2026-06-04T12:40:00Z
---

# Unit Brief: 001-identity-access

## Purpose

Registration, authentication (incl. MFA), session management, and role-based access control scoped by facility/department. The trust foundation for the whole platform.

## Scope

### In Scope
- Patient self-registration and email verification
- Login, sessions, idle timeout, lockout
- MFA for privileged roles
- Admin provisioning of provider/staff accounts
- RBAC enforcement (facility/department scoped) and role-change auditing

### Out of Scope
- Facility/department CRUD (002-facility-directory)
- Appointment data (004-appointments)

## Assigned Requirements

| FR | Requirement | Priority |
|----|-------------|----------|
| FR-1 | User registration & authentication | Must |
| FR-2 | Role-based access control | Must |

## Domain Concepts

### Key Entities
| Entity | Description | Attributes |
|--------|-------------|------------|
| User | An authenticated principal | id, email, password_hash, status, mfa_enabled |
| Role | Patient/Provider/Staff/Admin | name, permissions |
| FacilityScope | Binds user/role to a facility/department | user_id, facility_id, dept_id |
| AuditEntry | Immutable PHI/access record | actor, action, target, before/after, ts |

### Key Operations
| Operation | Description | Inputs | Outputs |
|-----------|-------------|--------|---------|
| register | Create patient account | email, password | unverified user |
| authenticate | Verify credentials + MFA | credentials, factor | session |
| authorize | Check role/facility scope | user, action, resource | allow/deny |

## Story Summary

| Metric | Count |
|--------|-------|
| Total Stories | 8 |
| Must Have | 7 |
| Should Have | 1 |
| Could Have | 0 |

### Stories
- [ ] **001-patient-self-registration** - Must - Planned
- [ ] **002-email-verification** - Must - Planned
- [ ] **003-user-login** - Must - Planned
- [ ] **004-session-timeout-and-lockout** - Must - Planned
- [ ] **005-mfa-for-privileged-roles** - Must - Planned
- [ ] **006-admin-provision-accounts** - Must - Planned
- [ ] **007-rbac-enforcement** - Must - Planned
- [ ] **008-role-change-audit** - Should - Planned

## Dependencies

### Depends On
| Unit | Reason |
|------|--------|
| None | Foundation unit |

### Depended By
| Unit | Reason |
|------|--------|
| All units | Require auth + RBAC |

### External Dependencies
| System | Purpose | Risk |
|--------|---------|------|
| MFA/SMS factor | Second factor for privileged roles | Medium |

## Technical Context

- Laravel 13 / Sail, MySQL 8.4 (see `memory-bank/standards/`). Bolt type: `ddd-construction-bolt`.

## Success Criteria

### Functional
- [ ] Patients can register, verify, and log in
- [ ] Privileged roles require MFA
- [ ] RBAC denies cross-role/cross-facility access
### Non-Functional
- [ ] 15-min idle timeout for staff/admin; lockout after 5 failures
- [ ] All access/role changes audited (immutable)

### Quality
- [ ] Code coverage > 80%
- [ ] All acceptance criteria met
- [ ] Code reviewed and approved

## Bolt Suggestions

| Bolt | Type | Stories | Objective |
|------|------|---------|-----------|
| 001-identity-access | DDD | 001-004 | Auth core (register, verify, login, timeout/lockout) |
| 002-identity-access | DDD | 005-008 | MFA, provisioning, RBAC, audit |

## Notes

Foundation for every other unit; build first.
