#!/bin/sh
set -e

cd /var/www/html

# Generate APP_KEY otomatis kalau belum ada di environment
if [ -z "$APP_KEY" ]; then
    echo "APP_KEY belum diset di environment variable!"
fi

# --- DIAGNOSTIC: cek DNS & koneksi ke database sebelum migrate ---
echo "=== DIAGNOSTIC START ==="
echo "DB_HOST yang terbaca: $DB_HOST"
echo "Mencoba resolve DNS untuk: $DB_HOST"
getent hosts "$DB_HOST" || echo "GAGAL: getent tidak bisa resolve host"
echo "Mencoba nslookup (jika tersedia):"
nslookup "$DB_HOST" 2>&1 || echo "nslookup tidak tersedia atau gagal"
echo "Isi /etc/resolv.conf:"
cat /etc/resolv.conf 2>&1 || echo "tidak bisa baca resolv.conf"
echo "Mencoba ping 1x ke 8.8.8.8 (cek koneksi internet keluar):"
ping -c 1 -W 3 8.8.8.8 2>&1 || echo "GAGAL ping ke internet"
echo "=== DIAGNOSTIC END ==="

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
