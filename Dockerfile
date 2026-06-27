# ---- Stage 1: Build frontend assets (Vite/Tailwind) ----
FROM node:20-alpine AS frontend

WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# ---- Stage 2: PHP + Laravel ----
FROM php:8.2-fpm-alpine

# Install system deps & PHP extensions
RUN apk add --no-cache \
    nginx \
    supervisor \
    git \
    curl \
    libzip-dev \
    zip \
    unzip \
    oniguruma-dev \
    libpng-dev \
    libxml2-dev \
    bind-tools \
    iputils \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy app source
COPY . .

# Pastikan folder sertifikat SSL Aiven ikut ter-copy
RUN mkdir -p /var/www/html/storage/certs

# Copy built frontend assets from stage 1
COPY --from=frontend /app/public/build ./public/build

# Install PHP deps
RUN composer install --optimize-autoloader --no-dev --no-interaction --no-progress

# Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Nginx config
COPY docker/nginx.conf /etc/nginx/http.d/default.conf

# Supervisor config (runs nginx + php-fpm together)
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Entrypoint: run migrations, cache config, then start services
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 8080

ENTRYPOINT ["/entrypoint.sh"]
