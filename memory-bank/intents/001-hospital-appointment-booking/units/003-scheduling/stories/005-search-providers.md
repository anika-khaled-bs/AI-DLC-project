---
id: 005-search-providers
unit: 003-scheduling
intent: 001-hospital-appointment-booking
status: draft
priority: must
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 005-search-providers

## User Story

**As a** patient
**I want** search and filter providers by specialty, facility, and date
**So that** I can find a suitable provider

## Acceptance Criteria

- [ ] **Given** filters (specialty/department, facility, date range), **When** I search, **Then** matching active providers are returned
- [ ] **Given** results, **When** displayed, **Then** each shows the provider's next available slot
- [ ] **Given** a provider with no open slots in range, **When** searching, **Then** they are shown as not bookable

## Technical Notes

- Search response p95 < 500ms.

## Dependencies

### Requires
- 004-generate-bookable-slots

### Enables
- 006-view-next-available-slots

## Out of Scope

- Concerns owned by other units (see unit-brief).
