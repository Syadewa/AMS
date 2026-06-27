#!/bin/sh
set -e

cd /var/www/html

# Generate APP_KEY otomatis kalau belum ada di environment Render
if [ -z "$APP_KEY" ]; then
    echo "APP_KEY belum diset di environment variable Render!"
fi

# Cache config, route, view untuk performa
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Jalankan migration otomatis tiap deploy (hapus baris ini kalau mau manual)
php artisan migrate --force

# Jalankan storage link (kalau pakai file upload publik)
php artisan storage:link || true

# Start nginx + php-fpm
exec supervisord -c /etc/supervisor/conf.d/supervisord.conf
