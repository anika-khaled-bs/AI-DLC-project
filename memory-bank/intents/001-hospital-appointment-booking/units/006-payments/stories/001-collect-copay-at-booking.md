---
id: 001-collect-copay-at-booking
unit: 006-payments
intent: 001-hospital-appointment-booking
status: draft
priority: should
created: 2026-06-04T12:40:00Z
assigned_bolt: null
implemented: false
---

# Story: 001-collect-copay-at-booking

## User Story

**As a** patient
**I want** pay my copay online at booking
**So that** my visit is paid for up front

## Acceptance Criteria

- [ ] **Given** a copay-eligible visit, **When** I book, **Then** I am prompted to pay the configured copay via the payment provider
- [ ] **Given** a payment, **When** processed, **Then** no raw card data (PAN) is stored — only a provider token/reference
- [ ] **Given** a successful charge, **When** complete, **Then** a payment record is linked to the appointment

## Technical Notes

- Tokenized provider under BAA; PCI-aware.

## Dependencies

### Requires
- 004-appointments:001-book-appointment

### Enables
- 002-gate-booking-on-payment

## Out of Scope

- Concerns owned by other units (see unit-brief).
