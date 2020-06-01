#!/bin/bash
set -e

cd /var/www
php artisan config:cache
php artisan route:cache
mkdir -p storage/app/public/avatars
rm public/storage
php artisan storage:link

# add cron job into cronfile
echo "* * * * * cd /var/www && php artisan schedule:run >> /dev/null 2>&1" >> cronfile
# install cron job
crontab cronfile
# rm tmp file
rm cronfile

php artisan db:seed --force

env >> /var/www/.env
php-fpm7.2 -D
cron -f &
nginx -g "daemon off;"
