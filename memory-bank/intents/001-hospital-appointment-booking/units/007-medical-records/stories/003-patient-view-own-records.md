---
id: 003-patient-view-own-records
unit: 007-medical-records
intent: 001-hospital-appointment-booking
status: draft
priority: should
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 003-patient-view-own-records

## User Story

**As a** patient
**I want** view my appointment history, shared notes, and documents
**So that** I can exercise my HIPAA right of access

## Acceptance Criteria

- [ ] **Given** a patient, **When** they open their records, **Then** they see their own appointment history and shared notes/documents only
- [ ] **Given** another patient's records, **When** access is attempted, **Then** it is denied
- [ ] **Given** a record view/export, **When** it occurs, **Then** it is audited

## Technical Notes

- Right-of-access export.

## Dependencies

### Requires
- 002-upload-visit-documents

### Enables
- None

## Out of Scope

- Concerns owned by other units (see unit-brief).
