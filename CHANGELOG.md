# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.5.0] - 2026-05-10

### Added
- Static landing page with Home, Services, and Gallery sections
- Public/Admin route split (`/` public, `/admin/*` authenticated)
- Role-Based Access Control (RBAC) - first registered user becomes Admin
- `CheckAdminRole` middleware for admin-only routes
- Admin User Management (view, change role, change status, delete)
- Admin System Settings page
- Banned/Frozen user login prevention with clear error messages
- Rate limiting on registration (`3/min per IP`)
- Rate limiting on password reset (`3/min per IP`)
- Rate limiting on password change (`5/min per user`)
- Base64 image upload validation (MIME type check + size cap)
- Last-admin demotion protection (cannot demote if only 1 admin remains)
- HSTS header (Strict-Transport-Security) on HTTPS connections
- `.env.production.example` production environment template
- `CHANGELOG.md`, `DEPLOYMENT.md`, `ROUTES.md` documentation
- Multi-language support (English, Bahasa Indonesia)
- `SetLocale` middleware with whitelist validation

### Changed
- Landing page is now fully static (removed `landing_contents` database table)
- Login rate limiter key fixed to use correct `login` form field
- `SecurityHeaders` middleware: removed deprecated `X-XSS-Protection`
- Profile picture upload now validates decoded base64 as actual image
- `cropped_image` field capped at ~1.5MB decoded
- `/home` route now requires `auth` middleware
- Removed unused `intervention/image-laravel` dependency
- Removed orphaned `config/image.php`
- Updated `composer.json` license from MIT to GPL-2.0-only

### Security
- **CRITICAL**: Banned/Frozen users could previously bypass login checks
- **CRITICAL**: Login rate limiter was keyed on wrong field (`email` vs `login`)
- **HIGH**: Registration had no rate limiting (mass account creation)
- **HIGH**: Password reset had no rate limiting (email spam vector)
- **HIGH**: Base64 image data was written to disk without content validation
- **HIGH**: No size limit on `cropped_image` field (memory exhaustion)
- **MEDIUM**: Password change had no rate limiting (brute-force current password)
- **MEDIUM**: Two admins could demote each other simultaneously (0 admins)
- **MEDIUM**: Missing HSTS header

## [1.0.0] - 2025-10-20 (Sibaraku template rework)

### Added
- Initial Laravel 12 project setup
- Laravel Fortify authentication (login, register, password reset)
- Split-screen auth UI with animated value-proposition slider
- Authenticated dashboard with welcome card and component showcase
- Google-style profile management (photo crop/zoom/rotate via Cropper.js)
- WebP image processing for profile pictures
- Multi-theme system (Light, Dark, Solarized)
- Theme persistence via `localStorage`
- Reusable Blade components (Card, Button, Modal, Alert, Skeleton, Section, Pagination)
- Toast notification system via SweetAlert2
- Responsive sidebar + navbar layout for admin panel
- Public guest layout with navbar and footer
- Terms of Service and Privacy Policy pages
- Custom error pages (403, 404, 419, 500, 503)
- `SecurityHeaders` middleware
- `ARCHITECTURE.md` technical documentation
- UUID primary keys for users
- Username + Email login support
