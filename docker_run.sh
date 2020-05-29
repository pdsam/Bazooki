#!/bin/bash
set -e

cd /var/www
php artisan config:cache
php artisan route:cache
mkdir -p storage/app/public/avatars
rm public/storage
php artisan storage:link


php artisan db:seed --force

env >> /var/www/.env
php-fpm7.2 -D
nginx -g "daemon off;"
