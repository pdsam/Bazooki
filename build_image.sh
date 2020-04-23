#!/bin/bash

# Stop execution if a step fails
set -e

DOCKER_USERNAME=lbaw2026 # Replace by your docker hub username
IMAGE_NAME=lbaw2026

docker build -t $DOCKER_USERNAME/$IMAGE_NAME .
