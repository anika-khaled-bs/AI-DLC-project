# UX Guide

## Overview

UI/UX standards for the React 19 + Inertia frontend, built on **Tailwind CSS v4** with
**shadcn/ui** as the component foundation. Mobile-first and accessible by default
(WCAG 2.1 AA).

## Design System / Component Library

**shadcn/ui** — Radix UI primitives + Tailwind, copied into the project as components we own.

Components live under `resources/js/Components/ui/` and are customized in-repo rather than
pulled from an opaque package, which keeps full control over markup, styling, and a11y. Radix
under the hood gives accessible behavior (focus management, keyboard nav, ARIA) for free.
Compose app-specific components from these primitives; don't fork a primitive unless needed.

- Tokens (colors, radius, etc.) configured via Tailwind theme + CSS variables.
- Prefer a shadcn/ui component before hand-rolling an interactive control (dialogs, menus,
  combobox, tabs, toasts).

## Styling Approach

**Tailwind CSS v4**, utility-first (`@tailwindcss/vite`).

- Style with utility classes in JSX; avoid bespoke CSS files except the Tailwind entrypoint
  and rare global styles.
- Use the Tailwind theme for design tokens; reference CSS variables for shadcn/ui theming.
- Sort classes consistently (`prettier-plugin-tailwindcss`, recommended).
- Extract a React component (not a CSS abstraction) when markup repeats.
- Support light/dark via Tailwind's `dark:` variant + a class strategy.

## Accessibility Standards

**Target: WCAG 2.1 AA.**

- Semantic HTML first; lean on Radix/shadcn primitives for complex widgets.
- All interactive elements keyboard-operable with a visible focus state.
- Meaningful `alt` text; label every form control; associate errors via `aria-describedby`.
- Maintain AA color-contrast ratios; never rely on color alone to convey meaning.
- Respect `prefers-reduced-motion` for animations.
- Manage focus on route/modal changes (Inertia navigations).

## Responsive Design Strategy

**Mobile-first**, using Tailwind's breakpoint system (`sm md lg xl 2xl`).

- Author base styles for small screens, layer larger breakpoints with `md:`/`lg:` utilities.
- Fluid layouts (flexbox/grid) over fixed widths; test common phone, tablet, and desktop sizes.
- Touch targets ≥ 44×44px; avoid hover-only interactions for primary actions.

## Decision Relationships

- **shadcn/ui ↔ Tailwind v4**: the component library is Tailwind-native — chosen together with
  the styling approach.
- **Radix (via shadcn/ui) ↔ accessibility**: accessible primitives are how we meet the
  WCAG 2.1 AA target without rebuilding behavior.
- **React/Inertia ↔ UX**: pages are React components under `resources/js/Pages/`; see
  [tech-stack.md](tech-stack.md) and [coding-standards.md](coding-standards.md) for structure.
