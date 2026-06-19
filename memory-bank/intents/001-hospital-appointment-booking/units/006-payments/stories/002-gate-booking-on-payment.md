---
id: 002-gate-booking-on-payment
unit: 006-payments
intent: 001-hospital-appointment-booking
status: draft
priority: should
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 002-gate-booking-on-payment

## User Story

**As a** platform
**I want** confirm bookings only after payment (unless deferred)
**So that** copays are reliably collected

## Acceptance Criteria

- [ ] **Given** payment is required, **When** the charge fails, **Then** the booking is not confirmed and the slot is released
- [ ] **Given** a policy that allows deferred payment, **When** configured, **Then** the booking confirms and payment is marked pending
- [ ] **Given** a successful payment, **When** received, **Then** the booking is confirmed and slot held

## Technical Notes

- Coordinate with appointments transaction; handle provider webhook.

## Dependencies

### Requires
- 001-collect-copay-at-booking

### Enables
- 003-refund-on-cancellation

## Out of Scope

- Concerns owned by other units (see unit-brief).
