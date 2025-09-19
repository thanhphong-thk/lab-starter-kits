#!/bin/sh
set -e

echo "⏳ Waiting for database..."
until php -r "try { new PDO('mysql:host=${DB_HOST};dbname=${DB_DATABASE}', '${DB_USERNAME}', '${DB_PASSWORD}'); echo 'DB ready'; exit(0); } catch (Exception \$e) { exit(1); }"; do
  sleep 2
done

echo "🔑 Generating app key..."
php artisan key:generate --force

echo "📦 Running migrations..."
php artisan migrate --force

echo "🌱 Seeding database..."
php artisan db:seed --force

echo "🚀 Starting PHP-FPM..."
exec php-fpm
