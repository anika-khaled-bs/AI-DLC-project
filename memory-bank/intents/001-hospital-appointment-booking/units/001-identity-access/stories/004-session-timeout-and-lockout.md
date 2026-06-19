---
id: 004-session-timeout-and-lockout
unit: 001-identity-access
intent: 001-hospital-appointment-booking
status: complete
priority: must
created: 2026-06-04T12:40:00.000Z
assigned_bolt: null
implemented: true
---

# Story: 004-session-timeout-and-lockout

## User Story

**As a** security stakeholder
**I want** idle sessions to expire and brute-force logins to be locked out
**So that** PHI access is protected

## Acceptance Criteria

- [ ] **Given** a staff/admin session idle for 15 minutes, **When** the next request is made, **Then** the session is invalidated and re-auth required
- [ ] **Given** 5 failed logins within 15 minutes, **When** another attempt is made, **Then** the account is temporarily locked
- [ ] **Given** a lockout has elapsed, **When** the user retries with valid credentials, **Then** login succeeds

## Technical Notes

- Configurable idle timeout per role; throttle middleware for lockout.

## Dependencies

### Requires
- 003-user-login

### Enables
- None

## Out of Scope

- Concerns owned by other units (see unit-brief).
