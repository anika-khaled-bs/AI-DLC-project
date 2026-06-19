---
unit: 007-medical-records
intent: 001-hospital-appointment-booking
phase: inception
status: draft
created: 2026-06-04T12:40:00Z
updated: 2026-06-04T12:40:00Z
---

# Unit Brief: 007-medical-records

## Purpose

Visit notes and document attachments linked to appointments, with patient access to their own records (HIPAA right of access). All PHI access audited.

## Scope

### In Scope
- Provider visit notes (add/edit)
- Encrypted document uploads
- Patient self-view and export of own records

### Out of Scope
- Appointment lifecycle (004-appointments)
- Full EHR/clinical charting (out of scope)

## Assigned Requirements

| FR | Requirement | Priority |
|----|-------------|----------|
| FR-13 | Medical records / visit documentation | Should |

## Domain Concepts

### Key Entities
| Entity | Description | Attributes |
|--------|-------------|------------|
| VisitNote | Provider note on a visit | id, appointment_id, body, version |
| Document | Uploaded file (PHI) | id, appointment_id, storage_ref, type |

### Key Operations
| Operation | Description | Inputs | Outputs |
|-----------|-------------|--------|---------|
| addNote | Document a visit | appointment, note | note |
| uploadDocument | Attach a file | appointment, file | document |
| viewOwnRecords | Patient access | patient | records |

## Story Summary

| Metric | Count |
|--------|-------|
| Total Stories | 3 |
| Must Have | 0 |
| Should Have | 3 |
| Could Have | 0 |

### Stories
- [ ] **001-provider-add-visit-notes** - Should - Planned
- [ ] **002-upload-visit-documents** - Should - Planned
- [ ] **003-patient-view-own-records** - Should - Planned

## Dependencies

### Depends On
| Unit | Reason |
|------|--------|
| 004-appointments | Records attach to appointments |

### Depended By
| Unit | Reason |
|------|--------|
| None | Terminal consumer |

### External Dependencies
| System | Purpose | Risk |
|--------|---------|------|
| Encrypted object storage | Document storage (PHI) | Medium |

## Technical Context

- Laravel 13 / Sail, MySQL 8.4 (see `memory-bank/standards/`). Bolt type: `ddd-construction-bolt`.

## Success Criteria

### Functional
- [ ] Providers document visits; patients view/export own records
### Non-Functional
- [ ] PHI encrypted at rest; all reads/writes audited

### Quality
- [ ] Code coverage > 80%
- [ ] All acceptance criteria met
- [ ] Code reviewed and approved

## Bolt Suggestions

| Bolt | Type | Stories | Objective |
|------|------|---------|-----------|
| 010-medical-records | DDD | 001-003 | Notes, encrypted uploads, patient access |

## Notes

Right-of-access export supports HIPAA patient rights.
