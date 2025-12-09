release: php artisan migrate --force && php artisan storage:link
web: php artisan migrate --force; php artisan db:seed --class=UserSeeder --force 2>/dev/null; php -S 0.0.0.0:${PORT:-8080} -t public public/router.php
