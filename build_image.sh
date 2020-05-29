#!/bin/bash

# Stop execution if a step fails
set -e

DOCKER_USERNAME=lbaw2026 # Replace by your docker hub username
IMAGE_NAME=lbaw2026                 # Replace with your group's image name

composer install
php artisan clear-compiled
php artisan optimize

docker build -t $DOCKER_USERNAME/$IMAGE_NAME .
