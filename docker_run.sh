#!/bin/bash
set -e

cd /var/www
php artisan config:cache
php artisan route:cache
php artisan db:seed --force
mkdir -p storage/app/public/avatars
env >> /var/www/.env
php-fpm7.2 -D
nginx -g "daemon off;"
