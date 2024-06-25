#!/bin/bash

if [ -z "$1" ]; then
    echo "Provide seeder class name"
    echo "exiting..."
    exit 1
fi

php artisan db:seed --class="$1"
