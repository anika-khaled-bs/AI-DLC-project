---
id: 003-refund-on-cancellation
unit: 006-payments
intent: 001-hospital-appointment-booking
status: draft
priority: should
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 003-refund-on-cancellation

## User Story

**As a** patient
**I want** be refunded when I cancel within the refund window
**So that** I'm not charged for visits I cancel in time

## Acceptance Criteria

- [ ] **Given** a paid appointment cancelled within the refund window, **When** cancelled, **Then** a refund is issued via the provider
- [ ] **Given** a cancellation outside the window, **When** processed, **Then** the facility refund policy is applied
- [ ] **Given** a refund, **When** issued, **Then** the payment record reflects the refund and it is audited

## Technical Notes

- Reacts to cancellation events.

## Dependencies

### Requires
- 002-gate-booking-on-payment

### Enables
- None

## Out of Scope

- Concerns owned by other units (see unit-brief).
