# Laravel Base Project Template

Production-ready Laravel starter template with authentication, admin panel, RBAC, and multi-theme support.

**v1.5.0** | [Changelog](CHANGELOG.md) | [Deployment](DEPLOYMENT.md) | [Routes](ROUTES.md) | [Architecture](ARCHITECTURE.md)

![Home](https://github.com/user-attachments/assets/44f659fc-fbe2-4f22-b0a4-6632ea874871)
![Admin](https://github.com/user-attachments/assets/671a42a5-4a08-4303-8c6a-39217c33503e)

---

## Stack

| Layer | Technology |
|-------|------------|
| Framework | Laravel 12 |
| Language | PHP 8.2+ |
| Auth | Laravel Fortify |
| Frontend | Blade, Tailwind CSS 4, Alpine.js |
| Build | Vite 7 |
| Database | MySQL / MariaDB |

---

## Features

### Authentication & Security
- Login with email or username
- Registration with auto-admin (first user)
- Password reset via email
- Rate limiting on all auth endpoints
- Banned/Frozen user enforcement
- CSRF protection on all forms
- Security headers (HSTS, X-Frame-Options, CSP, etc.)

### Admin Panel (`/admin`)
- Dashboard with welcome card and component showcase
- User Management (roles, status, delete)
- System Settings page
- RBAC: `admin` gets full access, `user` gets profile only

### Profile Management
- Edit name, username, email
- Profile picture with crop/zoom/rotate (Cropper.js)
- Password change with current password verification
- WebP image processing

### UI/UX
- Multi-theme: Light, Dark, Solarized
- Multi-language: English, Bahasa Indonesia
- Responsive sidebar + navbar layout
- Reusable components: Card, Button, Modal, Alert, Skeleton, Pagination
- Toast notifications (SweetAlert2)
- Custom error pages (403, 404, 419, 500, 503)

### Public Pages
- Landing page (Home, Services, Gallery)
- Terms of Service
- Privacy Policy

---

## Quick Start

```bash
git clone https://github.com/risunCode/Laravel_Base_Project_Template.git
cd Laravel_Base_Project_Template
composer run setup
php artisan serve
```

Or step by step:

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
# Configure DB_DATABASE, DB_USERNAME, DB_PASSWORD in .env
php artisan migrate
php artisan storage:link
npm run build
php artisan serve
```

Open `http://localhost:8000`. Register your first account - it becomes the admin.

---

## Development

```bash
# Start all services (server + queue + logs + vite)
composer run dev
```

Or run separately:

```bash
php artisan serve    # http://localhost:8000
npm run dev          # Vite HMR
```

---

## Project Structure

```
app/
├── Actions/Fortify/          # Registration logic
├── Http/
│   ├── Controllers/
│   │   ├── Admin/            # SettingsController
│   │   ├── DashboardController
│   │   ├── LandingController
│   │   ├── ProfileController
│   │   └── UserController
│   └── Middleware/
│       ├── Authenticate
│       ├── CheckAdminRole
│       ├── SecurityHeaders
│       └── SetLocale
├── Models/User.php
└── Providers/

resources/views/
├── components/               # Reusable UI components
├── errors/                   # Custom error pages
├── layouts/                  # app, auth, guest
└── pages/
    ├── admin/                # Settings, Users
    ├── auth/                 # Login, Register, Password Reset
    ├── legal/                # ToS, Privacy
    ├── profile/              # Profile management
    ├── dashboard.blade.php
    └── landing.blade.php
```

---

## Route Overview

| Area | Routes | Auth | Docs |
|------|--------|------|------|
| Public | `/`, `/terms-of-use`, `/privacy` | No | [ROUTES.md](ROUTES.md#public-routes) |
| Auth | `/login`, `/register`, `/forgot-password` | Guest | [ROUTES.md](ROUTES.md#guest-routes) |
| Profile | `/admin/profile` | Yes | [ROUTES.md](ROUTES.md#profile-all-authenticated-users) |
| Dashboard | `/admin/dashboard` | Admin | [ROUTES.md](ROUTES.md#dashboard-admin-only) |
| Users | `/admin/users` | Admin | [ROUTES.md](ROUTES.md#user-management-admin-only) |
| Settings | `/admin/settings` | Admin | [ROUTES.md](ROUTES.md#system-settings-admin-only) |

See [ROUTES.md](ROUTES.md) for full documentation including rate limits, middleware, and RBAC rules.

---

## Documentation

| Document | Description |
|----------|-------------|
| [ROUTES.md](ROUTES.md) | Complete route map, rate limits, RBAC rules, middleware reference |
| [DEPLOYMENT.md](DEPLOYMENT.md) | Server setup, Nginx config, SSL, production optimization |
| [ARCHITECTURE.md](ARCHITECTURE.md) | Technical architecture, data models, view hierarchy |
| [CHANGELOG.md](CHANGELOG.md) | Version history and security fixes |

---

## Verification

```bash
php artisan route:list    # Verify routes
php artisan test          # Run tests
npm run build             # Build frontend
composer validate         # Validate composer.json
```

---

## Screenshot

### Home
<img width="1919" height="958" alt="Screenshot 2026-05-09 221537" src="https://github.com/user-attachments/assets/5ae2ab46-84ae-4629-8f01-de1261de1c25" />

### Admin Console
<img width="1913" height="959" alt="Screenshot 2026-05-09 221548" src="https://github.com/user-attachments/assets/cf6064c5-29b1-478f-9964-6f64faef9742" />

---

## License

This project is licensed under the [GNU General Public License v2.0](LICENSE).
