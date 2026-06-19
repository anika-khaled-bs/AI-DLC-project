# Data Stack

## Overview

Relational persistence on **MySQL 8.4** (running as a Sail container) accessed through
Laravel's built-in **Eloquent ORM** with schema migrations.

## Database

**MySQL 8.4** — provided by the `mysql` service in `compose.yaml`, exposed on host port
`3306`.

MySQL is Laravel's default and a strong fit for the relational data of a typical full-stack
web app (users, and the domain entities to come). It's well-supported by Eloquent, easy to
run locally via Sail, and broadly available across hosting providers — keeping the deferred
production deployment decision flexible. The container is the source of truth for the live
version; the declared service config lives in `compose.yaml`.

## ORM / Database Client

**Eloquent** (Laravel's built-in ActiveRecord ORM) with **schema migrations** (`database/migrations`).

Eloquent ships with Laravel, so it needs no extra dependency and integrates with the rest of
the framework (validation, relationships, factories, seeders). Migrations are the canonical
way to evolve schema and keep environments reproducible. Test data uses **`fakerphp/faker`**
via model factories.

- Run migrations through Sail: `./vendor/bin/sail artisan migrate`.

## Decision Relationships

- **Eloquent ↔ Laravel**: Eloquent is part of the Laravel framework chosen in
  [tech-stack.md](tech-stack.md) — no separate ORM is introduced.
- **MySQL ↔ Sail**: The database runs in the same Docker Compose stack as the app; versions
  are defined by the container, not the host.
- **Factories ↔ testing**: Faker-backed model factories feed the Pest test suite — see
  [coding-standards.md](coding-standards.md).
