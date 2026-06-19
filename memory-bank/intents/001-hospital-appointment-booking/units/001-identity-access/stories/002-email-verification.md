---
id: 002-email-verification
unit: 001-identity-access
intent: 001-hospital-appointment-booking
status: complete
priority: must
created: 2026-06-04T12:40:00.000Z
assigned_bolt: null
implemented: true
---

# Story: 002-email-verification

## User Story

**As a** registered patient
**I want** verify my email address
**So that** my account is activated and trusted for booking

## Acceptance Criteria

- [ ] **Given** I received a verification link, **When** I open a valid unexpired link, **Then** my account is marked verified
- [ ] **Given** a verification link is expired, **When** I open it, **Then** I am told it expired and can request a new one
- [ ] **Given** my email is unverified, **When** I try to book, **Then** booking is blocked with a prompt to verify

## Technical Notes

- Signed, expiring URLs (Laravel signed routes).

## Dependencies

### Requires
- 001-patient-self-registration

### Enables
- 004-session-timeout-and-lockout

## Out of Scope

- Concerns owned by other units (see unit-brief).
