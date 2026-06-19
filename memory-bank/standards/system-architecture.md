# System Architecture

## Overview

A **modular monolith**: a single Laravel 13 application whose code is organized by business
domain, serving a React 19 frontend through Inertia v3. No separate API tier — controllers
return Inertia responses. Redis backs caching, sessions, and queues.

## Architecture Style

**Modular monolith.**

One deployable Laravel app, with code grouped by domain/module rather than purely by
technical type as the app grows. Each module owns its models, actions/services, controllers,
and tests. This keeps the operational simplicity of a monolith while enforcing internal
boundaries — and it lines up directly with the **domain-driven (DDD) unit decomposition**
that the Construction phase uses to plan bolts.

**Layering within a module**: `Controller (Inertia) → Form Request (validation) →
Action/Service (domain logic) → Eloquent Model`. Keep controllers thin; business rules live
in actions/services, not controllers or models.

## API Design

**Server-driven via Inertia v3.** Controllers return `Inertia::render('Page', [...props])`;
the React frontend never calls a separate JSON API for first-party screens. Validation,
authorization, and redirects stay server-side. Conventions for an _optional_ future JSON API
are documented separately in [api-conventions.md](api-conventions.md).

## State Management

- **Server is the source of truth.** Page data flows from Laravel through Inertia props.
- **Shared/global data** (auth user, flash, errors) via Inertia shared props
  (`HandleInertiaRequests` middleware) — read with `usePage()`.
- **Local UI state** via React hooks (`useState`/`useReducer`) and Context for small cross-cutting
  concerns. Reach for a dedicated client store (e.g. Zustand) only if genuinely complex client
  state appears — avoid premature global state.

## Caching Strategy

**Redis** (added as a Sail service) for application cache, sessions, and queue backend.

Use Laravel's `Cache` facade with tagged/keyed entries for expensive reads; prefer
cache-aside (read-through on miss, explicit invalidation on write). Run background work on
Redis-backed queues via `./vendor/bin/sail artisan queue:work`. Set `CACHE_STORE`,
`SESSION_DRIVER`, and `QUEUE_CONNECTION` to `redis` in `.env`.

## Security Patterns

- **Authentication**: Laravel **Fortify** (sessions; 2FA available) — see [tech-stack.md](tech-stack.md).
- **Authorization**: Laravel Policies / Gates; authorize in controllers or Form Requests.
- **Input validation**: every write goes through a Form Request; never trust client input.
- **CSRF**: Laravel's CSRF protection on all session-authenticated state-changing requests
  (Inertia handles the token automatically).
- **Mass-assignment**: explicit `$fillable` (or guarded) on models.
- **Secrets**: in `.env` only; never logged or committed.
- **Transport**: enforce HTTPS in production; secure, http-only session cookies.
- **Dependencies**: keep Laravel/React deps patched; review `composer`/`npm` audit output.

## Decision Relationships

- **Modular monolith ↔ DDD bolts**: domain modules map to the units Construction plans.
- **Inertia ↔ state management**: server-as-source-of-truth is a direct consequence of the
  Inertia choice in [tech-stack.md](tech-stack.md).
- **Redis ↔ Sail**: Redis runs as another container in the Compose stack alongside MySQL.
- **Fortify ↔ security patterns**: auth scaffolding and the authorization/validation layers
  together form the security baseline.
