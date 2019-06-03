#!/usr/bin/env bash

# Create link for php72
ln -f /usr/bin/php72 /usr/bin/php

maxcounter=45
counter=1
while ! mysql -h db --protocol tcp -proot -e "show databases;" > /dev/null 2>&1; do
    echo "Waiting for MySQL"
    sleep 1
    counter=`expr $counter + 1`
    if [ $counter -gt $maxcounter ]; then
        >&2 echo "We have been waiting for MySQL too long already; failing."
        exit 1
    fi;
done

# Init db
MIGRATION=`mysqlshow --user=root --password=root --host db docker | grep -v Wildcard | grep -o migrations`
if [ "$MIGRATION" == "" ]; then
    php artisan migrate
    php artisan db:seed
    # php artisan migrate:refresh --seed
fi

# Run composer
# php composer install

# Start apache
/usr/sbin/httpd -D FOREGROUND
