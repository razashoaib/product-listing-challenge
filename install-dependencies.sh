#!/bin/bash

# Author : Syed Shoaib Abidi
# Script follows here:
echo " <<<<<<<<<<<<<<<<<<<< Copying .env file >>>>>>>>>>>>>>>>>>>>"
cp .env.example .env
echo " <<<<<<<<<<<<<<<<<<<< Installing composer dependencies >>>>>>>>>>>>>>>>>>>>"
composer install && composer update
echo " <<<<<<<<<<<<<<<<<<<< Generating laravel application key >>>>>>>>>>>>>>>>>>>>"
php artisan key:generate
echo " <<<<<<<<<<<<<<<<<<<< Installing npm dependencies >>>>>>>>>>>>>>>>>>>>"
npm install && npm run dev
echo " <<<<<<<<<<<<<<<<<<<< Run Tests for Laravel >>>>>>>>>>>>>>>>>>>>"
php artisan test
echo "Everything is ready please navigate to http://localhost:8100 to see the application in action"