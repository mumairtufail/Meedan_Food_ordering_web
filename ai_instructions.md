# Laravel UI Standards & Structure (Shneiderman’s Eight Golden Rules)

This document defines **project-wide UI/UX + frontend architecture standards** for our Laravel + Blade + Tailwind + SheafUI stack.

This file is meant to be used as a **prompt / rulebook for AI Copilot** and human developers to keep the project:

* consistent
* scalable
* smooth
* accessible
* future‑proof

---

## 1. Core Design Principles (Must Follow)

The UI must always respect Shneiderman’s rules:

1. Strive for consistency
2. Enable shortcuts
3. Offer informative feedback
4. Design dialogs to yield closure
5. Prevent errors
6. Permit undo
7. Support user control
8. Reduce memory load

These principles must guide:

* layout decisions
* component design
* navigation
* forms
* modals
* notifications
* error handling

---

## 2. Tech Stack

* Laravel (latest stable)
* Blade components
* Tailwind CSS
* SheafUI (Navbar, Toasts, Modals)
* Alpine.js (optional for light interactivity)

---

## 3. Color Scheme (Strict)

Only use the following primary colors:

| Purpose                 | Hex       |
| ----------------------- | --------- |
| Background / Light Base | `#F9F6F1` |
| Primary / Accent / Text | `#014152` |

No random colors unless approved.

---

## 4. Tailwind Configuration

### tailwind.config.js

```js
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        base: '#F9F6F1',
        primary: '#014152',
      },
    },
  },
  plugins: [],
}
```

### Usage Rules

Always use:

* `bg-base`
* `text-primary`
* `border-primary`
* `hover:bg-primary`
* `hover:text-base`

❌ Never hardcode hex colors in Blade files.

---

## 5. Project Folder Structure (Frontend)

```
resources/
 └── views/
     ├── layouts/
     │   └── app.blade.php
     ├── components/
     │   ├── ui/
     │   ├── cards/
     │   ├── forms/
     │   ├── navigation/
     │   └── sections/
     ├── pages/
     │   ├── home.blade.php
     │   ├── docs.blade.php
     │   └── settings.blade.php
```

Component naming:

* `x-ui-*` → generic UI
* `x-card-*` → cards
* `x-form-*` → forms
* `x-section-*` → layout sections

---

## 6. Global Layout (SheafUI Based)

### Base Layout Example

```blade
<x-ui.layout.main>
    <x-ui.layout.header>
        <x-ui.navbar class="flex-1">
            <x-ui.navbar.item icon="home" label="Home" href="/" />
            <x-ui.navbar.item icon="cog-6-tooth" label="Settings" href="/settings" />
        </x-ui.navbar>
        
        <div class="flex gap-x-3 items-center">
            <x-ui.avatar size="sm" src="/avatar.png" circle />
            <x-ui.theme-switcher variant="inline" />
        </div>
    </x-ui.layout.header>

    <div class="p-6 bg-base min-h-screen">
        {{ $slot }}
    </div>

    <x-ui.toast />
</x-ui.layout.main>
```

---

## 7. SheafUI Setup

### Install Navbar

```bash
php artisan sheaf:install navbar
```

Usage:

```blade
<x-ui.navbar>
    <x-ui.navbar.item icon="home" label="Home" href="/" />
    <x-ui.navbar.item icon="document-text" label="Docs" href="/docs" />
    <x-ui.navbar.item icon="users" label="Team" href="/team" />
    <x-ui.navbar.item icon="cog" label="Settings" href="/settings" />
</x-ui.navbar>
```

---

### Install Toast Notifications

```bash
php artisan sheaf:install toast
```

Then add globally:

```blade
<x-ui.toast />
```

Toast rules:

* success → actions completed
* error → validation/system failure
* info → system feedback

---

### Modals

Use SheafUI modals only:

[https://sheafui.dev/](https://sheafui.dev/)

Rules:

* modal must have title
* clear close button
* confirm + cancel actions
* keyboard accessible

---

## 8. Component Design Rules

### Cards

* rounded-xl
* shadow-sm
* bg-base
* border border-primary/10
* padding 4–6

### Buttons

* primary: bg-primary text-base
* secondary: border border-primary text-primary
* disabled states required

### Forms

* labels always visible
* inline validation
* prevent invalid submissions
* helpful placeholder text

---

## 9. UX Standards Mapping

| Rule           | Implementation                |
| -------------- | ----------------------------- |
| Consistency    | shared layout + components    |
| Shortcuts      | keyboard support later        |
| Feedback       | toast notifications           |
| Closure        | success modals + toasts       |
| Prevent errors | validation + disabled states  |
| Undo           | confirm dialogs + soft delete |
| User control   | cancel buttons everywhere     |
| Reduce memory  | visible hints + placeholders  |

---

## 10. Carousel Libraries (Recommended)

Use one of these:

1. Swiper.js
2. Embla Carousel
3. Splide.js

Selection priority:

Swiper > Embla > Splide

Requirements:

* touch support
* keyboard support
* responsive
* lightweight

---

## 11. Coding Standards

* Blade components only (no inline HTML mess)
* No duplicated UI logic
* No inline styles
* No color hardcoding
* Semantic HTML
* Accessible labels
* Mobile‑first design

---

## 12. AI Copilot Instructions (Strict)

Whenever generating code:

* follow folder structure
* use Tailwind utility classes
* use defined colors only
* use components
* integrate SheafUI for navbar, toast, modals
* optimize for performance
* keep UI minimal and elegant
* respect Shneiderman’s rules

---

## 13. Future Enhancements (Planned)

* Dark mode using same palette
* Keyboard shortcuts system
* Component library documentation
* Storybook style preview
* Automated accessibility checks

---

## 14. Responsive & Mobile‑First Standards

This project must be **mobile‑first**, fully responsive, and optimized for **all screen sizes** (phones → tablets → laptops → desktops → ultrawide).

### Breakpoints (Tailwind default)

* `sm` → phones (≥640px)
* `md` → tablets (≥768px)
* `lg` → laptops (≥1024px)
* `xl` → desktops (≥1280px)
* `2xl` → large screens

### Rules

* Design **mobile first**, then scale up using `md:`, `lg:`, `xl:`
* Never design desktop first
* No horizontal scrolling on any device
* Touch targets ≥ 44px height
* Navbar collapses on mobile (hamburger / drawer)
* Cards stack vertically on mobile
* Grids must convert to single column on small screens

### Layout Example Pattern

```html
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
```

### Typography

* Use fluid sizes
* Example:

```html
<h1 class="text-2xl md:text-3xl lg:text-4xl">
```

### Performance

* Avoid heavy JS
* Lazy load images
* Use SVG icons
* Prefer CSS over JS animations

---

## 15. Reusable Component Architecture

All UI must be built as **reusable Blade components**.

### Component Principles

* Single responsibility
* Accept props
* No hardcoded text
* No hardcoded colors
* Configurable via attributes

### Example Card Component

```
x-card.base
```

```blade
@props(['title', 'description'])

<div class="bg-base border border-primary/10 rounded-xl p-5 shadow-sm">
    <h3 class="text-primary font-semibold">{{ $title }}</h3>
    <p class="text-primary/70 text-sm mt-2">{{ $description }}</p>
    {{ $slot }}
</div>
```

Usage:

```blade
<x-card.base title="Fast UI" description="Reusable components system" />
```

---

### Button Component Example

```
x-ui.button
```

```blade
@props(['variant' => 'primary'])

@php
$classes = $variant === 'primary'
    ? 'bg-primary text-base'
    : 'border border-primary text-primary';
@endphp

<button {{ $attributes->merge(['class' => "$classes px-4 py-2 rounded-lg transition"]) }}>
    {{ $slot }}
</button>
```

---

### Form Input Component Example

```
x-form.input
```

Includes:

* label
* error state
* hint text
* accessibility attributes

---

## 16. Responsiveness Checklist (AI must follow)

Before delivering UI code, ensure:

* [ ] Works on 320px width
* [ ] No overflow
* [ ] Buttons reachable by thumb
* [ ] Navbar collapses
* [ ] Cards stack
* [ ] Fonts scale
* [ ] Modals fit screen
* [ ] Toasts visible on mobile

---

## 17. Updated AI Copilot Rules (Mandatory)

AI must always:

* Build mobile first
* Use responsive classes
* Use reusable Blade components
* Avoid duplicated markup
* Respect Tailwind color tokens
* Integrate SheafUI properly
* Follow Shneiderman’s rules

---

## End

This file is the **single source of truth** for frontend architecture and UI behavior in this project.

No cowboy coding. No chaos. Only clean systems. 🧠✨
