release: php artisan migrate --force; php artisan storage:link; php artisan db:seed --class=UserSeeder
web: php -S 0.0.0.0:${PORT:-8080} -t public
