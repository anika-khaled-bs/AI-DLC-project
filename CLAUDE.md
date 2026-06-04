# CLAUDE.md

Guidance for Claude Code (and specsmd AI-DLC agents) working in this repo.

## Runtime lives in Docker (Laravel Sail) — not on the host

This is a **Laravel 13** app that runs inside Laravel Sail containers, defined in
[compose.yaml](compose.yaml). The host's own toolchain is **stale and must not be
trusted** for runtime checks:

| Tool | Host (wrong) | Container (correct) |
|------|--------------|---------------------|
| PHP  | 7.4          | 8.5                 |
| Node | 21           | 24                  |

**Always run PHP / Node / Composer / npm / Artisan commands through Sail**, which
execs inside the `laravel.test` container. Never run bare `php` / `node` on the host
to determine the project's runtime.

```bash
./vendor/bin/sail php -v          # PHP version (container)
./vendor/bin/sail node -v         # Node version (container)
./vendor/bin/sail composer show   # installed PHP packages
./vendor/bin/sail npm ls --depth=0
./vendor/bin/sail artisan ...     # any artisan command
./vendor/bin/sail shell           # interactive shell inside the container
```

`./vendor/bin/sail <cmd>` is equivalent to `docker compose exec laravel.test <cmd>`.

## Declared vs. runtime versions

For **declared/locked dependency versions**, read the manifests directly (these are
authoritative and identical on host and container):

- PHP: [composer.json](composer.json) (constraints) and `composer.lock` (exact, e.g. `laravel/framework v13.13.0`)
- JS: [package.json](package.json) and `package-lock.json`

Only reach into the container (via `sail`) when you need the **live runtime** version
of an installed binary.

## Local environment notes

- App URL: **http://localhost:8080** (`APP_PORT=8080` in `.env`; host port 80 was taken).
- Start the stack: `./vendor/bin/sail up -d` — Stop: `./vendor/bin/sail down`.
- Database: MySQL 8.4 container (`mysql` service), exposed on host `3306`.
- `vendor/` and `node_modules/` are installed; both are git-ignored.
