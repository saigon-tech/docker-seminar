#!/bin/sh
docker-compose exec server bash -c "php artisan migrate"
docker-compose exec server bash -c "php artisan db:seed"
