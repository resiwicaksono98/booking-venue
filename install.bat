@echo off

npm run install
call php artisan migrate
call php artisan db:seed --class=AdminSeeder
