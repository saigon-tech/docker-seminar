#!/usr/bin/env bash

# Create link for php72
ln -f /usr/bin/php72 /usr/bin/php

# Init db
php artisan migrate
php artisan db:seed

# Run composer
# php composer install

# Start apache
/usr/sbin/httpd -D FOREGROUND
