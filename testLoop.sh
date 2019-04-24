#!/bin/sh
while [ 1 ]; do
    clear&
    ./vendor/bin/phpunit&
    sleep 4
done
