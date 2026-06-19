---
id: 003-invite-and-assign-providers
unit: 002-facility-directory
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 003-invite-and-assign-providers

## User Story

**As a** hospital admin
**I want** provision providers and assign them to facilities/departments
**So that** they can publish availability

## Acceptance Criteria

- [ ] **Given** an admin, **When** I assign a provider to a facility/department, **Then** the provider can manage availability there
- [ ] **Given** a provider, **When** assigned to multiple departments, **Then** each assignment is independently manageable
- [ ] **Given** an assignment change, **When** saved, **Then** it is audited

## Technical Notes

- Reuses account provisioning from identity-access.

## Dependencies

### Requires
- 002-manage-departments

### Enables
- 004-assign-staff-to-facility

## Out of Scope

- Concerns owned by other units (see unit-brief).
