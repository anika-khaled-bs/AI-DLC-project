---
intent: 001-hospital-appointment-booking
phase: inception
status: units-decomposed
updated: 2026-06-04T12:30:00Z
---

# Hospital Appointment Booking Platform - Unit Decomposition

This intent decomposes into **8 units** (7 backend DDD units + 1 frontend unit), per the
`full-stack-web` project type.

## Requirement-to-Unit Mapping

- **FR-1** (registration & auth) → `001-identity-access`
- **FR-2** (RBAC) → `001-identity-access`
- **FR-3** (facility/department/provider admin) → `002-facility-directory`
- **FR-4** (availability & slot management) → `003-scheduling`
- **FR-5** (provider search & discovery) → `003-scheduling`
- **FR-6** (booking) → `004-appointments`
- **FR-7** (reschedule & cancel) → `004-appointments`
- **FR-8** (slot integrity / double-booking) → `004-appointments`
- **FR-9** (staff-assisted scheduling) → `004-appointments`
- **FR-10** (appointment lifecycle & status) → `004-appointments`
- **FR-11** (notifications) → `005-notifications`
- **FR-12** (payments / copay) → `006-payments`
- **FR-13** (medical records) → `007-medical-records`
- All user-facing FRs → `008-hospital-appointment-booking-ui`

## Units Overview

### Unit 1: 001-identity-access (backend)
**Description**: Registration, authentication (incl. MFA), sessions, and role-based access control scoped by facility/department.
**Assigned FRs**: FR-1, FR-2 · **Depends on**: none · **Complexity**: M

### Unit 2: 002-facility-directory (backend)
**Description**: Administration of facilities, departments, providers, and staff assignments.
**Assigned FRs**: FR-3 · **Depends on**: 001-identity-access · **Complexity**: M

### Unit 3: 003-scheduling (backend)
**Description**: Provider availability (working hours, slot duration, time-off), bookable-slot generation, and provider search/discovery.
**Assigned FRs**: FR-4, FR-5 · **Depends on**: 002-facility-directory · **Complexity**: L

### Unit 4: 004-appointments (backend)
**Description**: Core booking domain — book/reschedule/cancel, concurrency-safe slot integrity, staff-assisted scheduling and walk-ins, appointment lifecycle/status.
**Assigned FRs**: FR-6, FR-7, FR-8, FR-9, FR-10 · **Depends on**: 003-scheduling, 002-facility-directory · **Complexity**: XL

### Unit 5: 005-notifications (backend)
**Description**: Email/SMS confirmations, reminders, and cancellation/reschedule notices reacting to appointment events.
**Assigned FRs**: FR-11 · **Depends on**: 004-appointments · **Complexity**: M

### Unit 6: 006-payments (backend)
**Description**: Copay collection at booking via tokenized payment provider, payment-gated confirmation, and refunds.
**Assigned FRs**: FR-12 · **Depends on**: 004-appointments · **Complexity**: M

### Unit 7: 007-medical-records (backend)
**Description**: Visit notes and document attachments on appointments, with patient access to their own records.
**Assigned FRs**: FR-13 · **Depends on**: 004-appointments · **Complexity**: M

### Unit 8: 008-hospital-appointment-booking-ui (frontend)
**Description**: Web UI for all four roles — patient booking flow, provider availability, staff scheduling dashboard, admin console, patient records/history.
**Assigned FRs**: all user-facing FRs · **Depends on**: all backend units · **Complexity**: L

## Unit Dependency Graph

```text
001-identity-access
   ├──► 002-facility-directory
   │        └──► 003-scheduling
   │                 └──► 004-appointments ──┬──► 005-notifications
   │                                         ├──► 006-payments
   │                                         └──► 007-medical-records
   └──────────────────────────────────────────────────────────────► 008-...-ui
                                  (UI depends on all backend units)
```

## Execution Order

1. `001-identity-access` (foundation)
2. `002-facility-directory`
3. `003-scheduling`
4. `004-appointments`
5. `005-notifications`, `006-payments`, `007-medical-records` (parallel after appointments)
6. `008-hospital-appointment-booking-ui` (integrates all backend units; can build per-role UI incrementally as each backend unit lands)
