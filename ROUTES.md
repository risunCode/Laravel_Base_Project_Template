# Route Documentation

Complete route map for **Laravel Base Project Template v1.5.0**.

---

## Public Routes

No authentication required.

| Method | URI | Name | Controller | Middleware |
|--------|-----|------|------------|------------|
| `GET` | `/` | `landing` | `LandingController@index` | `web` |
| `GET` | `/terms-of-use` | `terms` | Closure (view) | `web` |
| `GET` | `/privacy` | `privacy` | Closure (view) | `web` |

---

## Guest Routes

Only accessible when NOT logged in. Redirects to dashboard if authenticated.

| Method | URI | Name | Controller | Rate Limit |
|--------|-----|------|------------|------------|
| `GET` | `/login` | `login` | `AuthenticatedSessionController@create` | - |
| `POST` | `/login` | `login.store` | `AuthenticatedSessionController@store` | `5/min` per IP+user |
| `GET` | `/register` | `register` | `RegisteredUserController@create` | - |
| `POST` | `/register` | `register.store` | `RegisteredUserController@store` | `3/min` per IP |
| `GET` | `/forgot-password` | `password.request` | `PasswordResetLinkController@create` | - |
| `POST` | `/forgot-password` | `password.email` | `PasswordResetLinkController@store` | `3/min` per IP |
| `GET` | `/reset-password/{token}` | `password.reset` | `NewPasswordController@create` | - |
| `POST` | `/reset-password` | `password.update` | `NewPasswordController@store` | `3/min` per IP |

---

## Auth Routes

Requires authentication.

| Method | URI | Name | Controller | Middleware |
|--------|-----|------|------------|------------|
| `POST` | `/logout` | `logout` | `AuthenticatedSessionController@destroy` | `auth` |
| `GET` | `/home` | - | Redirect to `dashboard` | `auth` |

---

## Admin Panel Routes

All prefixed with `/admin`. Requires `auth` middleware.

### Profile (All authenticated users)

| Method | URI | Name | Controller | Rate Limit |
|--------|-----|------|------------|------------|
| `GET` | `/admin/profile` | `profile.show` | `ProfileController@show` | - |
| `PUT` | `/admin/profile` | `profile.update` | `ProfileController@update` | - |
| `DELETE` | `/admin/profile/picture` | `profile.picture.remove` | `ProfileController@removePicture` | - |
| `PUT` | `/admin/profile/password` | `profile.password` | `ProfileController@updatePassword` | `5/min` per user |

### Dashboard (Admin only)

| Method | URI | Name | Controller | Middleware |
|--------|-----|------|------------|------------|
| `GET` | `/admin/dashboard` | `dashboard` | `DashboardController@index` | `auth`, `admin` |

### User Management (Admin only)

| Method | URI | Name | Controller | Middleware |
|--------|-----|------|------------|------------|
| `GET` | `/admin/users` | `admin.users.index` | `UserController@index` | `auth`, `admin` |
| `PUT` | `/admin/users/{user}/status` | `admin.users.status` | `UserController@updateStatus` | `auth`, `admin` |
| `PUT` | `/admin/users/{user}/role` | `admin.users.role` | `UserController@updateRole` | `auth`, `admin` |
| `DELETE` | `/admin/users/{user}` | `admin.users.destroy` | `UserController@destroy` | `auth`, `admin` |

### System Settings (Admin only)

| Method | URI | Name | Controller | Middleware |
|--------|-----|------|------------|------------|
| `GET` | `/admin/settings` | `admin.settings.index` | `SettingsController@index` | `auth`, `admin` |
| `PUT` | `/admin/settings` | `admin.settings.update` | `SettingsController@update` | `auth`, `admin` |

---

## Framework Routes

Auto-registered by Laravel.

| Method | URI | Purpose |
|--------|-----|---------|
| `GET` | `/up` | Health check endpoint |
| `GET` | `/storage/{path}` | Serve files from local storage |

---

## Middleware Reference

| Alias | Class | Description |
|-------|-------|-------------|
| `auth` | `App\Http\Middleware\Authenticate` | Redirects unauthenticated users to login |
| `admin` | `App\Http\Middleware\CheckAdminRole` | Blocks non-admin users with 403 |
| `guest` | Framework default | Redirects authenticated users away |
| `throttle:*` | Framework default | Rate limiting |
| `web` (global) | `SecurityHeaders` | Adds security headers to all responses |
| `web` (global) | `SetLocale` | Sets app locale from `?lang=` parameter |

---

## Rate Limiting Summary

| Limiter Name | Limit | Key | Applied To |
|--------------|-------|-----|------------|
| `login` | 5 per minute | `IP + login input` | `POST /login` |
| `register` | 3 per minute | `IP` | `POST /register` |
| `password-reset` | 3 per minute | `IP` | `POST /forgot-password`, `POST /reset-password` |
| `password-change` | 5 per minute | `User ID` | `PUT /admin/profile/password` |

---

## RBAC (Role-Based Access Control)

### Roles

| Role | Access |
|------|--------|
| `admin` | Full access: Dashboard, Users, Settings, Profile |
| `user` | Profile only (`/admin/profile`) |

### User Status

| Status | Effect |
|--------|--------|
| `active` | Normal access |
| `frozen` | Login blocked with message |
| `banned` | Login blocked with message |

### Rules

- First registered user automatically gets `admin` role
- Admins cannot change their own role
- Cannot demote the last remaining admin
- Cannot change status of an admin to banned/frozen
- Cannot delete an admin account

---

## Security Headers

Applied globally via `SecurityHeaders` middleware:

```
X-Content-Type-Options: nosniff
X-Frame-Options: SAMEORIGIN
Referrer-Policy: strict-origin-when-cross-origin
Permissions-Policy: geolocation=(), microphone=(), camera=()
Strict-Transport-Security: max-age=31536000; includeSubDomains  (HTTPS only)
```

---

## CSRF Protection

All `POST`, `PUT`, `DELETE` forms include `@csrf` token. Laravel's `VerifyCsrfToken` middleware is active globally on the `web` group.

---

## Verification

```bash
# List all routes
php artisan route:list

# Run tests
php artisan test

# Build frontend
npm run build
```
