---
unit: 005-notifications
intent: 001-hospital-appointment-booking
phase: inception
status: draft
created: 2026-06-04T12:40:00Z
updated: 2026-06-04T12:40:00Z
---

# Unit Brief: 005-notifications

## Purpose

Email/SMS notifications — booking confirmations, reminders, and cancellation/reschedule notices — reacting to appointment events with minimum-necessary PHI.

## Scope

### In Scope
- Confirmation on booking
- Scheduled reminders
- Cancellation/reschedule notices
- Channel preferences and retry/logging

### Out of Scope
- Creating appointments (004-appointments)
- Payment receipts (006-payments)

## Assigned Requirements

| FR | Requirement | Priority |
|----|-------------|----------|
| FR-11 | Notifications | Must |

## Domain Concepts

### Key Entities
| Entity | Description | Attributes |
|--------|-------------|------------|
| Notification | A queued/sent message | id, appointment_id, channel, status |
| NotificationPreference | Patient channel opt-in/out | patient_id, channel, enabled |

### Key Operations
| Operation | Description | Inputs | Outputs |
|-----------|-------------|--------|---------|
| sendConfirmation | On booking | appointment | message |
| scheduleReminder | Before appointment | appointment, lead time | message |
| notifyChange | On cancel/reschedule | event | message |

## Story Summary

| Metric | Count |
|--------|-------|
| Total Stories | 3 |
| Must Have | 3 |
| Should Have | 0 |
| Could Have | 0 |

### Stories
- [ ] **001-booking-confirmation-notification** - Must - Planned
- [ ] **002-appointment-reminder** - Must - Planned
- [ ] **003-cancellation-reschedule-notification** - Must - Planned

## Dependencies

### Depends On
| Unit | Reason |
|------|--------|
| 004-appointments | Source of events |

### Depended By
| Unit | Reason |
|------|--------|
| None | Terminal consumer |

### External Dependencies
| System | Purpose | Risk |
|--------|---------|------|
| SMS/Email provider | Message delivery (BAA) | Medium |

## Technical Context

- Laravel 13 / Sail, MySQL 8.4 (see `memory-bank/standards/`). Bolt type: `ddd-construction-bolt`.

## Success Criteria

### Functional
- [ ] Confirmations, reminders, and change notices delivered
### Non-Functional
- [ ] Async with retries; minimum-necessary PHI in payloads

### Quality
- [ ] Code coverage > 80%
- [ ] All acceptance criteria met
- [ ] Code reviewed and approved

## Bolt Suggestions

| Bolt | Type | Stories | Objective |
|------|------|---------|-----------|
| 008-notifications | DDD | 001-003 | Event-driven confirmations, reminders, change notices |

## Notes

Vendor must operate under a BAA.
