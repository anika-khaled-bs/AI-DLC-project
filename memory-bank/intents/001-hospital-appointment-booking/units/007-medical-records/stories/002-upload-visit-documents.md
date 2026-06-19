---
id: 002-upload-visit-documents
unit: 007-medical-records
intent: 001-hospital-appointment-booking
status: draft
priority: should
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 002-upload-visit-documents

## User Story

**As a** provider
**I want** upload documents to an appointment
**So that** supporting records are attached

## Acceptance Criteria

- [ ] **Given** an appointment, **When** the provider uploads a document, **Then** it is stored encrypted and linked
- [ ] **Given** an upload, **When** validated, **Then** disallowed types/oversized files are rejected
- [ ] **Given** a document, **When** accessed, **Then** access is authorized and audited

## Technical Notes

- Encrypted object storage; virus/size checks.

## Dependencies

### Requires
- 001-provider-add-visit-notes

### Enables
- 003-patient-view-own-records

## Out of Scope

- Concerns owned by other units (see unit-brief).
