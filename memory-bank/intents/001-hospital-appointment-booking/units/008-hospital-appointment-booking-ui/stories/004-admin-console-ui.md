---
id: 004-admin-console-ui
unit: 008-hospital-appointment-booking-ui
intent: 001-hospital-appointment-booking
status: draft
priority: should
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 004-admin-console-ui

## User Story

**As a** hospital admin
**I want** a console to manage facilities, departments, providers, and staff
**So that** I can administer the network

## Acceptance Criteria

- [ ] **Given** the admin console, **When** I manage facilities/departments/providers/staff, **Then** changes persist and are audited
- [ ] **Given** provisioning, **When** I invite a user, **Then** invites are sent
- [ ] **Given** the console, **When** rendered, **Then** it is accessible

## Technical Notes

- Consumes identity-access and facility-directory APIs.

## Dependencies

### Requires
- 003-staff-scheduling-dashboard-ui

### Enables
- 005-patient-records-and-history-ui

## Out of Scope

- Concerns owned by other units (see unit-brief).
