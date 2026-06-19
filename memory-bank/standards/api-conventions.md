# API Conventions

## Overview

The app is **Inertia-first**: first-party screens are served via Inertia v3, not a JSON API.
These conventions define a **ready-to-adopt REST/JSON standard** for when a separate API
surface is needed (mobile, third-party clients, webhooks) so it can be added consistently
without re-litigating the format.

## API Style

**Primary contract: Inertia (server-driven).** Controllers return Inertia responses; there is
no public JSON API today.

**When a JSON API is introduced: RESTful resources** under a dedicated prefix
(`/api/...`), authenticated with Laravel **Fortify/Sanctum tokens** (separate from the
session-based Inertia auth). Use `routes/api.php`, API Resource controllers, and Eloquent
**API Resources** for serialization.

## API Versioning

**URI-path versioning**: `/api/v1/...`.

Start at `v1` when the first endpoint ships. Keep a version live until consumers migrate;
introduce `v2` only for breaking changes. Non-breaking additions stay within the current
version.

## Response Format

JSON, using Laravel **API Resources**. Single resources return the object under `data`;
collections return an array under `data` with `meta`/`links` for pagination.

```json
{
  "data": { "id": 1, "name": "Example" }
}
```

```json
{
  "data": [ { "id": 1 }, { "id": 2 } ],
  "meta": { "current_page": 1, "per_page": 15, "total": 42 },
  "links": { "next": "/api/v1/items?page=2", "prev": null }
}
```

- Timestamps in ISO 8601 (UTC).
- Field names in `snake_case` (matches Eloquent attributes).
- Correct HTTP status codes (`200/201/204`, `4xx`, `5xx`).

## Error Response Format

Follows Laravel's default validation/exception shape:

```json
{
  "message": "The given data was invalid.",
  "errors": {
    "email": ["The email field is required."]
  }
}
```

- `422` for validation errors (`errors` keyed by field).
- `401` unauthenticated, `403` unauthorized, `404` not found.
- `message` is user-safe; technical detail goes to logs, never the response (outside `debug`).

## Pagination Strategy

**Page-based pagination** via Laravel's paginator (`->paginate()`), default **15 per page**,
overridable with `?per_page=` (capped to a sane max, e.g. 100). `meta` and `links` carry the
pagination state as shown above. Consider cursor pagination for very large/real-time datasets.

## Decision Relationships

- **Inertia ↔ this standard**: today's contract is Inertia (see [system-architecture.md](system-architecture.md));
  these REST conventions activate only when a JSON API is added.
- **API Resources ↔ Eloquent**: serialization builds on the Eloquent models from
  [data-stack.md](data-stack.md); `snake_case` fields match DB columns.
- **Token auth ↔ Fortify/Sanctum**: API auth is token-based, distinct from the session auth
  used for Inertia — see [tech-stack.md](tech-stack.md).
