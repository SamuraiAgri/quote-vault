#!/bin/bash
# デプロイ後に本番サーバーで実行されるスクリプト

cd /home/laravel-times/www/quote-vault || exit 1

echo "🔄 Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo "✅ Cache cleared successfully!"
