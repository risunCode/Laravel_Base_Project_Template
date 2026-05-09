# Architecture Overview

> **Version 1.5.0** | See also: [README](README.md) | [ROUTES](ROUTES.md) | [DEPLOYMENT](DEPLOYMENT.md) | [CHANGELOG](CHANGELOG.md)

This workspace is a **Laravel Base Project Template** - a production-ready foundation for new projects. Includes authentication, RBAC admin panel, profile management, static landing page, reusable Blade components, and multi-theme system.

## Summary

```json
{
  "framework": "Laravel 12",
  "php": "^8.2",
  "frontend": ["Blade", "Tailwind CSS 4", "Vite"],
  "auth": "Laravel Fortify controllers with manual routes",
  "application_models": ["User"],
  "pages": ["landing", "login", "register", "dashboard", "profile"],
  "themes": ["light", "dark", "solarized", "amoled", "black"]
}
```

## High-Level Flow

```txt
Browser
  -> routes/web.php
  -> LandingController (Public)
  -> Fortify auth controllers / application controllers (Admin)
  -> actions and models
  -> database
```

Detailed flow:

```txt
Browser
  |
  v
routes/web.php
  |
  +-- Public routes: / (Landing), /login, /register
  +-- Admin routes (Auth): /admin/dashboard, /admin/profile
  |
  v
Controllers
  |
  +-- LandingController
  +-- Fortify Auth Controllers
  +-- DashboardController (Admin)
  +-- ProfileController (Admin)
  |
  v
Actions / Models
  |
  +-- CreateNewUser
  +-- User
  |
  v
Optional database tables
  +-- users
  +-- sessions
  +-- password_reset_tokens
  +-- cache / jobs infrastructure tables
```

## Layer Diagram

```txt
+--------------------------------------------------+
| Presentation                                      |
| Blade views, components, layouts, Tailwind, Vite  |
+--------------------------------------------------+
                         |
+--------------------------------------------------+
| Routing                                           |
| routes/web.php                                    |
+--------------------------------------------------+
                         |
+--------------------------------------------------+
| Application                                       |
| DashboardController, ProfileController, Fortify   |
+--------------------------------------------------+
                         |
+--------------------------------------------------+
| Data / Auth Actions                               |
| User model, CreateNewUser                         |
+--------------------------------------------------+
                         |
+--------------------------------------------------+
| Persistence                                       |
| users, sessions, cache, queues                    |
+--------------------------------------------------+
```

## Directory Map

```txt
app/
├── Actions/Fortify/
│   ├── CreateNewUser.php
│   └── PasswordValidationRules.php
├── Http/
│   ├── Controllers/
│   │   ├── Controller.php
│   │   ├── DashboardController.php
│   │   └── ProfileController.php
│   └── Middleware/
│       ├── Authenticate.php
│       └── SecurityHeaders.php
├── Models/User.php
└── Providers/
    ├── AppServiceProvider.php
    └── FortifyServiceProvider.php

resources/
├── css/app.css
├── js/app.js
├── js/bootstrap.js
└── views/
    ├── components/
    ├── errors/
    ├── layouts/
    ├── pages/
    └── welcome.blade.php

database/
├── factories/UserFactory.php
├── migrations/
│   ├── 0001_01_01_000000_create_users_table.php
│   ├── 0001_01_01_000001_create_cache_table.php
│   └── 0001_01_01_000002_create_jobs_table.php
└── seeders/DatabaseSeeder.php
```

## Route Map

| Method | URI | Name | Handler | Middleware |
|---|---|---|---|---|
| GET | `/` | `landing` | `LandingController@index` | `web` |
| GET | `/login` | `login` | Fortify `AuthenticatedSessionController@create` | `guest` |
| POST | `/login` | `login.store` | Fortify `AuthenticatedSessionController@store` | `guest`, `throttle:login` |
| GET | `/register` | `register` | Fortify `RegisteredUserController@create` | `guest` |
| POST | `/register` | `register.store` | Fortify `RegisteredUserController@store` | `guest` |
| POST | `/logout` | `logout` | Fortify `AuthenticatedSessionController@destroy` | `auth` |
| GET | `/admin/dashboard` | `dashboard` | `DashboardController@index` | `auth` |
| GET | `/admin/profile` | `profile.show` | `ProfileController@show` | `auth` |
| PUT | `/admin/profile` | `profile.update` | `ProfileController@update` | `auth` |
| PUT | `/admin/profile/password` | `profile.password` | `ProfileController@updatePassword` | `auth` |

Laravel framework routes can also appear:

| Method | URI | Purpose |
|---|---|---|
| GET | `/up` | Health check |
| GET | `/storage/{path}` | Local storage file serving |

## Auth Architecture

Fortify is still used for auth controllers, but default Fortify route registration is disabled. This keeps the public route surface explicit and minimal.

```txt
FortifyServiceProvider
  +-- Fortify::ignoreRoutes()
  +-- Fortify::createUsersUsing(CreateNewUser::class)
  +-- Fortify::loginView(...)
  +-- Fortify::registerView(...)
```

Registration only needs these fields:

```json
["name", "email", "password", "password_confirmation"]
```

There are no roles, reference codes, security questions, or domain-specific registration requirements.

## Request Flows

### Login

```txt
GET /login
  -> AuthenticatedSessionController@create
  -> pages/auth/login.blade.php

POST /login
  -> throttle:login
  -> AuthenticatedSessionController@store
  -> redirect /
```

### Register

```txt
POST /register
  -> RegisteredUserController@store
  -> CreateNewUser::create()
  -> User::create()
  -> redirect /
```

### Dashboard

```txt
GET /
  -> DashboardController@index
  -> check database connectivity
  -> pages/dashboard.blade.php
  -> show environment anomaly card if database is unavailable
```

### Profile

```txt
GET /profile
  -> auth middleware
  -> ProfileController@show
  -> pages/profile/show.blade.php

PUT /profile
  -> validate name/email
  -> update authenticated user
  -> redirect back with success toast

PUT /profile/password
  -> validate current password
  -> validate password confirmation
  -> update authenticated user password
  -> redirect back with success toast
```

## View Architecture

```txt
layouts/app.blade.php
  +-- components/sidebar.blade.php
  +-- components/navbar.blade.php
  +-- @yield('content')
  +-- components/footer.blade.php
  +-- components/toast-notifications.blade.php

layouts/auth.blade.php
  +-- auth shell / branding
  +-- @yield('content')
  +-- components/toast-notifications.blade.php

pages/auth/login.blade.php
pages/auth/register.blade.php
pages/dashboard.blade.php
pages/profile/show.blade.php
```

## Component Responsibilities

| Component | Responsibility |
|---|---|
| `sidebar.blade.php` | Main navigation |
| `navbar.blade.php` | Theme selector, user menu, mobile menu trigger |
| `footer.blade.php` | Footer |
| `modal.blade.php` | Generic modal shell |
| `pagination.blade.php` | Reusable pagination UI for future list pages |
| `toast-notifications.blade.php` | SweetAlert session/error messages |

## Theme Architecture

Theme styling lives in `resources/css/app.css` using CSS variables.

```txt
:root  -> light theme
.dark  -> dark theme
.black -> pure black theme
.pink  -> pink gradient theme
```

The selected theme is stored in browser storage:

```js
localStorage.setItem('theme', theme)
```

Layouts read the value early in the document head so the theme is applied before the page body renders.

## Data Architecture

The only application model is:

```txt
App\Models\User
```

User model contract:

```json
{
  "fillable": ["name", "email", "password"],
  "hidden": ["password", "remember_token"],
  "casts": {
    "email_verified_at": "datetime",
    "password": "hashed"
  },
  "computed": ["initials"]
}
```

Database scope:

```json
{
  "application_tables": ["users"],
  "framework_tables": [
    "password_reset_tokens",
    "sessions",
    "cache",
    "cache_locks",
    "jobs",
    "job_batches",
    "failed_jobs"
  ]
}
```

## Backend Map

```json
{
  "controllers": {
    "DashboardController": "renders dashboard",
    "ProfileController": "shows profile, updates profile, updates password"
  },
  "actions": {
    "CreateNewUser": "validates registration and creates User"
  },
  "middleware": {
    "Authenticate": "redirects guests to login for protected pages",
    "SecurityHeaders": "adds generic browser security headers"
  },
  "providers": {
    "AppServiceProvider": "registers login rate limiter",
    "FortifyServiceProvider": "configures Fortify auth views/actions"
  }
}
```

## Frontend Map

```json
{
  "layouts": ["app", "auth", "guest"],
  "pages": ["login", "register", "dashboard", "profile"],
  "components": [
    "sidebar",
    "navbar",
    "footer",
    "modal",
    "pagination",
    "toast-notifications"
  ],
  "assets": {
    "css": "resources/css/app.css",
    "js": ["resources/js/app.js", "resources/js/bootstrap.js"],
    "build_tool": "Vite"
  }
}
```

## Dependencies

Composer runtime dependencies:

```json
[
  "laravel/framework",
  "laravel/fortify",
  "laravel/tinker"
]
```

NPM frontend dependencies:

```json
[
  "vite",
  "laravel-vite-plugin",
  "tailwindcss",
  "@tailwindcss/vite",
  "@tailwindcss/forms",
  "axios",
  "concurrently"
]
```

Infrastructure defaults:

```json
{
  "SESSION_DRIVER": "file",
  "CACHE_STORE": "file",
  "QUEUE_CONNECTION": "sync"
}
```

Removed feature packages:

```json
[
  "barryvdh/laravel-dompdf",
  "qrcode",
  "qrious"
]
```

## Removed Domain Areas

The template intentionally no longer contains these modules:

```json
[
  "letters",
  "incoming letters",
  "outgoing letters",
  "dispositions",
  "attachments",
  "document signatures",
  "QR verification",
  "reference codes",
  "activity logs",
  "admin settings page",
  "gallery",
  "agenda",
  "PDF transcript"
]
```

## Extension Points

| Need | Add code in |
|---|---|
| New page | `routes/web.php`, `app/Http/Controllers`, `resources/views/pages` |
| New reusable UI | `resources/views/components` |
| New table/model | `database/migrations`, `app/Models` |
| New registration logic | `app/Actions/Fortify/CreateNewUser.php` |
| New auth behavior | `app/Providers/FortifyServiceProvider.php` |
| New global styling | `resources/css/app.css` |
| New JS behavior | `resources/js/app.js` or imported JS module |

## Verification Commands

```bash
composer validate --no-check-publish
php artisan route:list
php artisan test
npm run build
```

Current verified status from cleanup:

```txt
composer validate: pass
php artisan route:list: pass
php artisan test: pass
npm run build: pass
```
