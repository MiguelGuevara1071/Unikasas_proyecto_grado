#!/bin/sh
cd ..
docker-compose up --build -d
docker exec -it shouts-laravel-app php artisan migrate:fresh --seed
