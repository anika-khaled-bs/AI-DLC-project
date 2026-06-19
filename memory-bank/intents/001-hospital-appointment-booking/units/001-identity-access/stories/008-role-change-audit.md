---
id: 008-role-change-audit
unit: 001-identity-access
intent: 001-hospital-appointment-booking
status: draft
priority: should
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 008-role-change-audit

## User Story

**As a** compliance officer
**I want** every role grant/revocation recorded
**So that** we can prove minimum-necessary access

## Acceptance Criteria

- [ ] **Given** an admin grants/revokes a role, **When** the change is saved, **Then** an audit entry with actor, target, before/after, and timestamp is written
- [ ] **Given** the audit log, **When** reviewed, **Then** entries are append-only/immutable
- [ ] **Given** a role change, **When** it takes effect, **Then** the affected user's active permissions update on next request

## Technical Notes

- Append-only audit table; no hard deletes.

## Dependencies

### Requires
- 006-admin-provision-accounts

### Enables
- None

## Out of Scope

- Concerns owned by other units (see unit-brief).
