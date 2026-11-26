FROM php:8.4-cli

# Install ekstensi PHP & Node.js (untuk build Tailwind/Vite)
RUN apt-get update && apt-get install -y \
    git unzip curl libsqlite3-dev libzip-dev libpng-dev libonig-dev libxml2-dev \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_sqlite zip gd mbstring xml bcmath \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Install dependency PHP & build aset frontend Tailwind/Vite
RUN composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build

# Siapkan folder SQLite & izin akses Laravel
RUN mkdir -p database storage/framework/sessions storage/framework/views storage/framework/cache storage/logs \
    && touch database/database.sqlite \
    && chmod -R 775 storage bootstrap/cache database

EXPOSE 10000

CMD php artisan migrate --force --seed && php artisan config:clear && php artisan serve --host=0.0.0.0 --port=10000
