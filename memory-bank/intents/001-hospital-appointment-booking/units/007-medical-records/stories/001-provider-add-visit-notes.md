---
id: 001-provider-add-visit-notes
unit: 007-medical-records
intent: 001-hospital-appointment-booking
status: draft
priority: should
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 001-provider-add-visit-notes

## User Story

**As a** provider
**I want** add and edit visit notes on a completed appointment
**So that** the visit is documented

## Acceptance Criteria

- [ ] **Given** a completed appointment, **When** the provider adds notes, **Then** they are saved and linked to that appointment
- [ ] **Given** existing notes, **When** edited, **Then** prior versions/edits are auditable
- [ ] **Given** any note read/write, **When** it occurs, **Then** it is recorded in the PHI audit log

## Technical Notes

- Notes are PHI; encrypt at rest.

## Dependencies

### Requires
- 004-appointments:008-appointment-status-lifecycle

### Enables
- 002-upload-visit-documents

## Out of Scope

- Concerns owned by other units (see unit-brief).
