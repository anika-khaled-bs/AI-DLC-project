---
id: 005-deactivate-provider-preserve-history
unit: 002-facility-directory
intent: 001-hospital-appointment-booking
status: draft
priority: should
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 005-deactivate-provider-preserve-history

## User Story

**As a** hospital admin
**I want** deactivate a provider while preserving their history
**So that** departed providers stop taking bookings without data loss

## Acceptance Criteria

- [ ] **Given** an active provider, **When** I deactivate them, **Then** their future open slots are hidden from patient search
- [ ] **Given** a deactivated provider, **When** querying past appointments, **Then** their historical records remain intact
- [ ] **Given** existing future appointments, **When** a provider is deactivated, **Then** those appointments are flagged for staff follow-up (not silently dropped)

## Technical Notes

- Deactivation is reversible; preserves referential history.

## Dependencies

### Requires
- 004-assign-staff-to-facility

### Enables
- None

## Out of Scope

- Concerns owned by other units (see unit-brief).
