FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip unzip git curl \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        mbstring \
        xml \
        zip \
        bcmath \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# --no-scripts でビルド時の php artisan 実行をスキップ（.envがないため）
RUN COMPOSER_MEMORY_LIMIT=-1 composer install --no-dev --optimize-autoloader --no-scripts --ignore-platform-reqs \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 10000

# 起動時に package:discover → config cache → migrate → サーバー起動
CMD php artisan package:discover --ansi \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan migrate --force \
    && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
