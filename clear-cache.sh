#!/bin/sh
docker-compose exec server bash -c "php artisan config:cache"
