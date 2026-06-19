---
intent: 001-hospital-appointment-booking
phase: inception
status: inception-complete
created: 2026-06-04T11:35:00Z
updated: 2026-06-04T12:50:00Z
---

# Requirements: Hospital Appointment Booking Platform

## Intent Overview

A full-stack web platform for a **multi-hospital network** that lets **patients** discover
providers and book/manage appointments via fixed time-slots, **doctors/providers** publish
and control their availability, **clinic / front-desk staff** manage schedules and book on
patients' behalf, and **hospital admins** administer facilities, departments, providers, and
platform settings. The platform collects copays at booking, sends notifications, and attaches
visit documentation to appointments. It must operate under **HIPAA**.

Scoped as a single platform-wide intent; it will be decomposed into multiple units during the
units stage.

## Business Goals

| Goal | Success Metric | Priority |
|------|----------------|----------|
| Enable patients to self-book appointments online | ≥ 60% of bookings made via self-service within 6 months of launch | Must |
| Reduce no-shows | No-show rate reduced by ≥ 20% vs. baseline (via reminders) | Should |
| Reduce front-desk scheduling load | ≥ 40% fewer phone-booked appointments | Should |
| Collect copays up front | ≥ 80% of copay-eligible visits paid at booking | Should |
| Maintain HIPAA compliance | Zero reportable PHI breaches; 100% PHI access audit coverage | Must |

---

## Functional Requirements

### FR-1: User registration & authentication
- **Description**: Users can register and authenticate. Patients can self-register; providers, front-desk staff, and admins are provisioned/invited by an admin.
- **Acceptance Criteria**:
  - Patient can create an account with email + password and verify email before booking.
  - Authenticated sessions expire after 15 minutes of inactivity (staff/admin) and require re-auth.
  - Failed-login lockout after 5 consecutive failures within 15 minutes.
- **Priority**: Must
- **Related Stories**: _TBD_

### FR-2: Role-based access control
- **Description**: The system enforces four roles — patient, provider, front-desk staff, hospital admin — each scoped to a facility/department where applicable, following HIPAA minimum-necessary access.
- **Acceptance Criteria**:
  - A user in one role cannot access actions/data outside their role and assigned facility.
  - Staff/admin actions on PHI are restricted to their assigned facility/department.
  - Every role grant/revocation is recorded in the audit log.
- **Priority**: Must
- **Related Stories**: _TBD_

### FR-3: Facility, department & provider administration
- **Description**: Hospital admins manage facilities (hospitals in the network), departments, providers, and platform settings.
- **Acceptance Criteria**:
  - Admin can create/edit/deactivate facilities and departments.
  - Admin can invite/provision providers and staff and assign them to facilities/departments.
  - Deactivating a provider hides their future open slots from patient search but preserves history.
- **Priority**: Must
- **Related Stories**: _TBD_

### FR-4: Provider availability & slot management
- **Description**: Providers (and authorized staff) define working hours, slot length, and time-off, which generate bookable fixed time-slots.
- **Acceptance Criteria**:
  - Provider can define recurring weekly working hours and slot duration (e.g., 15/30 min).
  - Provider can block time-off / breaks; blocked time produces no bookable slots.
  - Changes to availability do not delete or move already-booked appointments (conflicts are flagged, not silently dropped).
- **Priority**: Must
- **Related Stories**: _TBD_

### FR-5: Provider search & discovery
- **Description**: Patients search and filter providers by specialty/department, facility, and availability.
- **Acceptance Criteria**:
  - Patient can filter by specialty/department, facility, and date range.
  - Search results show next available slots per provider.
  - Only active providers with bookable slots appear as bookable.
- **Priority**: Must
- **Related Stories**: _TBD_

### FR-6: Appointment booking
- **Description**: Patients book an open fixed time-slot with a chosen provider, capturing visit reason and required intake info.
- **Acceptance Criteria**:
  - Patient can select an open slot and confirm a booking, receiving a confirmation reference.
  - A slot, once booked, immediately becomes unavailable to other users.
  - Booking captures visit reason and any required pre-visit fields.
- **Priority**: Must
- **Related Stories**: _TBD_

### FR-7: Reschedule & cancel
- **Description**: Patients (and staff on their behalf) can reschedule or cancel appointments subject to policy windows.
- **Acceptance Criteria**:
  - Patient can cancel up to the facility-configured cutoff (e.g., 24h before); cancelled slot returns to the open pool.
  - Reschedule atomically releases the old slot and books the new one (no double-hold, no orphaned slot).
  - Cancellation/reschedule outside the policy window is blocked or flagged per facility settings.
- **Priority**: Must
- **Related Stories**: _TBD_

### FR-8: Slot integrity / double-booking prevention
- **Description**: Concurrent booking attempts on the same slot are safely serialized so a slot can be held by at most one appointment.
- **Acceptance Criteria**:
  - Two simultaneous booking attempts on the same slot result in exactly one success and one clear "no longer available" error.
  - No appointment can be persisted against an already-booked or non-existent slot.
- **Priority**: Must
- **Related Stories**: _TBD_

### FR-9: Staff-assisted scheduling
- **Description**: Front-desk staff view facility/provider schedules and create, reschedule, or cancel appointments on behalf of patients, including walk-ins.
- **Acceptance Criteria**:
  - Staff can search/select an existing patient (or register a new one) and book on their behalf.
  - Staff can view a day/week schedule for providers in their facility.
  - All staff-initiated actions are attributed to the staff user in the audit log.
- **Priority**: Must
- **Related Stories**: _TBD_

### FR-10: Appointment lifecycle & status
- **Description**: Appointments move through a defined lifecycle: booked → checked-in → completed, with cancelled and no-show terminal states.
- **Acceptance Criteria**:
  - Staff/provider can mark check-in, completion, and no-show.
  - Status transitions follow allowed paths only (e.g., cannot complete a cancelled appointment).
  - Status changes are timestamped and audited.
- **Priority**: Must
- **Related Stories**: _TBD_

### FR-11: Notifications
- **Description**: The platform sends email/SMS for booking confirmations, reminders, and cancellation/reschedule notices.
- **Acceptance Criteria**:
  - A confirmation is sent on booking and a reminder before the appointment (facility-configurable lead time, e.g., 24h).
  - Cancellation/reschedule triggers a notice to the patient (and provider/staff as configured).
  - Notification content avoids disclosing sensitive PHI beyond the minimum necessary.
- **Priority**: Must
- **Related Stories**: _TBD_

### FR-12: Payments / copay collection
- **Description**: When a visit carries a copay, the patient pays online at booking via an integrated payment provider.
- **Acceptance Criteria**:
  - Patient can pay a configured copay at booking; a booking requiring payment is not confirmed until payment succeeds (or is explicitly deferred per policy).
  - Cancellation within the refund window triggers a refund per facility policy.
  - No raw card data (PAN) is stored on the platform; only provider tokens/references are kept.
- **Priority**: Should
- **Related Stories**: _TBD_

### FR-13: Medical records / visit documentation
- **Description**: Providers attach visit notes and documents to appointments; patients can view their own records.
- **Acceptance Criteria**:
  - Provider can add/edit visit notes and upload documents to a completed appointment.
  - Patient can view their own appointment history, notes shared with them, and documents.
  - All PHI reads/writes are recorded in the audit log.
- **Priority**: Should
- **Related Stories**: _TBD_

---

## Non-Functional Requirements

### Performance
| Requirement | Metric | Target |
|-------------|--------|--------|
| Provider search response | p95 latency | < 500 ms |
| Slot listing / availability load | p95 latency | < 400 ms |
| Booking confirmation | p95 latency | < 1 s |

### Scalability
| Requirement | Metric | Target |
|-------------|--------|--------|
| Network size | Facilities | Up to ~50 hospitals/clinics |
| Registered users | Accounts | 50,000+ |
| Concurrent users (peak) | Active sessions | 5,000 |
| Appointment volume | Bookings/day | 20,000+ |

### Security (HIPAA)
| Requirement | Standard | Notes |
|-------------|----------|-------|
| Encryption in transit | TLS 1.2+ | All client/server and service-to-service traffic |
| Encryption at rest | AES-256 | Database + uploaded documents (PHI) |
| Authentication | Password + MFA | MFA required for provider/staff/admin roles |
| Authorization | RBAC + minimum-necessary | Scoped by facility/department |
| Audit logging | Immutable PHI access log | Who/what/when for every PHI read/write |
| Session management | Idle timeout | 15 min for staff/admin; secure, HTTP-only session cookies |
| Payment data | PCI-aware | No PAN stored; tokenized via payment provider |

### Reliability
| Requirement | Metric | Target |
|-------------|--------|--------|
| Availability | Uptime | 99.9% |
| Recovery time | RTO | < 1 hour |
| Recovery point | RPO | < 15 minutes |
| Backups | PHI data backups | Encrypted, daily, tested restores |

### Compliance
| Requirement | Standard | Notes |
|-------------|----------|-------|
| Health data privacy | HIPAA (US) | Privacy & Security Rules |
| Vendor agreements | BAA | Required with payment, SMS/email, and hosting vendors handling PHI |
| Patient rights | HIPAA right of access | Patients can view/export their own records |
| Breach handling | Breach notification | Documented detection + notification process |
| Data retention | Policy-driven | Retention/disposal policy for PHI and audit logs |

### Accessibility
| Requirement | Standard | Notes |
|-------------|----------|-------|
| Patient-facing UI | WCAG 2.1 AA | Public booking flows must be accessible |

---

## Constraints

### Technical Constraints

**Project-wide standards**: Loaded from `memory-bank/standards/` by the Construction Agent
(Laravel 13 / Sail, MySQL 8.4 — see CLAUDE.md).

**Intent-specific constraints**:
- Slot booking must be transactionally safe under concurrency (DB-level locking/constraints to prevent double-booking).
- PHI must be encrypted at rest; uploaded documents stored encrypted.
- Payments via a HIPAA/PCI-compliant third-party provider under a BAA; no PAN stored locally.
- Email/SMS via a vendor under a BAA; notification payloads minimize PHI.

### Business Constraints
- Initial deployment targets a single hospital network (multiple facilities under one operator).
- Copay collection depends on integration with the network's payment provider.

---

## Assumptions

| Assumption | Risk if Invalid | Mitigation |
|------------|-----------------|------------|
| All facilities use fixed time-slot scheduling | Request/confirm model would need added workflow | Revisit booking model in a later intent if needed |
| A HIPAA/PCI-compliant payment & messaging vendor is available under BAA | Payments/notifications blocked or non-compliant | Identify vendors during construction; gate payments behind BAA |
| Insurance eligibility/claims are out of scope (copay only) | Billing expectations unmet | Treat full billing as a separate future intent |
| Single network operator (not multi-tenant SaaS) | Tenant isolation needs would grow scope | Design facility scoping cleanly to allow future multi-tenancy |

---

## Open Questions

| Question | Owner | Due Date | Resolution |
|----------|-------|----------|------------|
| Which payment provider and SMS/email vendor (must support BAA)? | Product/Eng | Before Payments/Notifications units | Pending |
| Telehealth / virtual visits in scope, or in-person only? | Product | Before units | Pending |
| Insurance eligibility checks needed, or copay-only? | Product | Before Payments unit | Assumed copay-only |
| Patient self-registration vs. invite-only for some facilities? | Product | Before Auth unit | Assumed self-registration |
