#!/bin/sh
while [ 1 ]; do
    php artisan migrate:fresh --seed&
    sleep 2
    clear&
    ./vendor/bin/phpunit&
    sleep 8
done
