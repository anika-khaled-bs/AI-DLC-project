# Tech Stack

## Overview

A Laravel 13 full-stack web application with a PHP backend and a React 19 single-page
frontend bridged by Inertia v3. It runs locally on Laravel Sail (Docker) and is built
with Vite and styled with Tailwind CSS v4.

## Languages

- **Backend**: PHP — `^8.3` declared (`composer.json`), **8.5** in the Sail runtime container.
- **Frontend**: TypeScript / JavaScript (React 19, JSX/TSX), Node **24** in the container.

PHP is the application's core language (Laravel). The frontend is built in React with
TypeScript recommended for type safety across Inertia page props. Type safety on the
backend is reinforced by PHP 8.x typed properties, enums, and Laravel's typed APIs.

## Framework

- **Backend framework**: Laravel `^13.8` (`laravel/framework`, locked to v13.x).
- **Frontend framework**: React **19** delivered via **Inertia v3** (no separate API layer —
  controllers return Inertia responses with typed props).
- **Build tooling**: Vite **8** (`laravel-vite-plugin`), Tailwind CSS **4** (`@tailwindcss/vite`).

Inertia was chosen to keep a single Laravel monolith (routing, auth, validation stay
server-side) while delivering a modern React SPA experience — avoiding the overhead of a
separately deployed API + client. Laravel is hard to change later, so it anchors the stack.

## Authentication

**Laravel Fortify** — a headless (frontend-agnostic) authentication backend.

Fortify provides login, registration, password reset, email verification, and two-factor
auth as backend routes/actions, leaving the UI to our React + Inertia frontend. This pairs
naturally with Inertia (we render our own React auth pages) and avoids the opinionated Blade
scaffolding of Breeze/Jetstream. _Not yet installed_ — to be added via `laravel/fortify`.

## Infrastructure & Deployment

- **Local**: Laravel Sail (Docker Compose, `compose.yaml`). App at **http://localhost:8080**
  (`APP_PORT=8080`; host port 80 was taken). Start: `./vendor/bin/sail up -d`.
- **Production**: **TBD** — deferred decision. Revisit before the Operations phase. The
  Docker-based Sail setup keeps container-platform deploys (Forge/VPS, Laravel Cloud, or
  Kubernetes) all open.

## Package Manager

- **PHP**: Composer (`composer.json` / `composer.lock`).
- **JavaScript**: npm (`package.json` / `package-lock.json`).

Both run through Sail (`./vendor/bin/sail composer ...`, `./vendor/bin/sail npm ...`) so they
execute against the container's PHP 8.5 / Node 24, not the stale host toolchain.

## Decision Relationships

- **Inertia v3 ↔ React 19**: Inertia is the adapter that lets Laravel controllers drive React
  pages; the two are chosen together.
- **Fortify ↔ Inertia**: Fortify's headless design is specifically what makes it a good fit for
  a React/Inertia frontend (we own the auth UI).
- **Sail ↔ runtime versions**: All language/tool versions are defined by the Sail container,
  not the host — see [CLAUDE.md](../../CLAUDE.md).
- **Database**: see [data-stack.md](data-stack.md). **Code style/testing**: see [coding-standards.md](coding-standards.md).
