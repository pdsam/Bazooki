#!/bin/bash

# Stop execution if a step fails
set -e

DOCKER_USERNAME=lbaw2026 # Replace by your docker hub username
IMAGE_NAME=lbaw2026                 # Replace with your group's image name

# Ensure that dependencies are available
./build_image.sh
docker push $DOCKER_USERNAME/$IMAGE_NAME
