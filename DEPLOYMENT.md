# Deployment Guide

Step-by-step deployment guide for **Laravel Base Project Template v1.5.0**.

---

## Requirements

| Software | Version |
|----------|---------|
| PHP | >= 8.2 |
| Composer | >= 2.x |
| Node.js | >= 18.x |
| npm | >= 9.x |
| MySQL / MariaDB | >= 8.0 / 10.6 |

Required PHP extensions:

```
bcmath, ctype, curl, dom, fileinfo, json, mbstring, openssl,
pdo, pdo_mysql, tokenizer, xml, zip
```

---

## Local Development

```bash
# 1. Clone the repository
git clone https://github.com/risunCode/Laravel_Base_Project_Template.git
cd Laravel_Base_Project_Template

# 2. Install dependencies
composer install
npm install

# 3. Environment setup
cp .env.example .env
php artisan key:generate

# 4. Configure database
# Edit .env and set DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 5. Run migrations
php artisan migrate

# 6. Create storage symlink
php artisan storage:link

# 7. Build frontend assets
npm run build

# 8. Start the development server
composer run dev
```

This starts Laravel server, queue worker, log viewer, and Vite dev server concurrently.

Or run individually:

```bash
php artisan serve    # Backend at http://localhost:8000
npm run dev          # Vite HMR at http://localhost:5173
```

### Quick Setup (single command)

```bash
composer run setup
```

This runs `composer install`, copies `.env`, generates key, runs migrations, installs npm, and builds assets.

---

## Production Deployment

### 1. Server Setup

```bash
# Clone to server
git clone https://github.com/risunCode/Laravel_Base_Project_Template.git /var/www/app
cd /var/www/app

# Install production dependencies only
composer install --no-dev --optimize-autoloader
npm ci
```

### 2. Environment Configuration

```bash
cp .env.production.example .env
php artisan key:generate
```

Edit `.env` with your production values:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_HOST=your-db-host
DB_DATABASE=your-database
DB_USERNAME=your-username
DB_PASSWORD=your-password

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_USERNAME=your-smtp-user
MAIL_PASSWORD=your-smtp-pass
MAIL_FROM_ADDRESS=noreply@yourdomain.com

SESSION_SECURE_COOKIE=true
SESSION_ENCRYPT=true
```

### 3. Build & Optimize

```bash
# Build frontend assets
npm run build

# Optimize Laravel for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Run database migrations
php artisan migrate --force

# Create storage symlink
php artisan storage:link
```

### 4. File Permissions

```bash
# Set ownership
sudo chown -R www-data:www-data /var/www/app

# Set directory permissions
sudo find /var/www/app -type d -exec chmod 755 {} \;
sudo find /var/www/app -type f -exec chmod 644 {} \;

# Writable directories
sudo chmod -R 775 storage bootstrap/cache
```

### 5. Nginx Configuration

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name yourdomain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name yourdomain.com;

    root /var/www/app/public;
    index index.php;

    ssl_certificate     /etc/letsencrypt/live/yourdomain.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/yourdomain.com/privkey.pem;

    charset utf-8;
    client_max_body_size 20M;

    # Gzip
    gzip on;
    gzip_types text/plain text/css application/json application/javascript text/xml;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### 6. SSL Certificate

```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d yourdomain.com
```

---

## First User (Admin)

The **first user** who registers becomes the Admin automatically. All subsequent users get the `user` role.

```
1. Open https://yourdomain.com/register
2. Fill in name, username, email, password
3. This account will have admin role
4. Access admin panel at /admin/dashboard
```

---

## Maintenance

### Clear Caches

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Rebuild Caches

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Update Deployment

```bash
cd /var/www/app

# Pull latest code
git pull origin main

# Update dependencies
composer install --no-dev --optimize-autoloader
npm ci && npm run build

# Run new migrations
php artisan migrate --force

# Rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Restart services
sudo systemctl restart php8.2-fpm
```

---

## Troubleshooting

| Problem | Solution |
|---------|----------|
| 500 error after deploy | Check `storage/logs/laravel.log`, verify `.env` exists |
| Blank page | Run `php artisan config:clear` and check `APP_KEY` |
| CSS not loading | Run `npm run build` and check `public/build/` exists |
| Permission denied | Fix `storage/` and `bootstrap/cache/` permissions |
| Profile pictures broken | Run `php artisan storage:link` |
| Login not working | Check database connection and run `php artisan migrate` |
