#!/bin/bash

# Production deployment/optimization script
# Run this after deploying new code to production

set -e

echo "🚀 Starting production optimization..."

# Change to project root directory
cd "$(dirname "$0")/.."

# Maintenance mode (optional - uncomment if needed)
echo "→ Enabling maintenance mode..."
php artisan down --refresh=15

echo "→ Installing/updating Composer dependencies..."
composer install --optimize-autoloader --no-dev --no-interaction

echo "→ Running database migrations..."
php artisan migrate --force

echo "→ Clearing all caches..."
php artisan optimize:clear

# echo "→ Building frontend assets..."
# npm ci --omit=dev
# npm run build

echo "→ Caching configuration..."
php artisan config:cache

echo "→ Caching routes..."
php artisan route:cache

echo "→ Caching views..."
php artisan view:cache

echo "→ Caching events..."
php artisan event:cache

echo "→ Optimizing application..."
php artisan optimize

echo "→ Restarting queue workers..."
php artisan queue:restart

# Storage link (only needed once, but safe to run)
php artisan storage:link 2>/dev/null || true

# Disable maintenance mode (if enabled above)
echo "→ Disabling maintenance mode..."
php artisan up

echo "✅ Production optimization completed!"
