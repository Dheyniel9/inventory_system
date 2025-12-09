release: php artisan migrate --force && php artisan storage:link && mkdir -p public/css && cp resources/css/global.css public/css/
web: php artisan migrate --force; php artisan db:seed --class=UserSeeder --force 2>/dev/null; mkdir -p public/css && cp resources/css/global.css public/css/ && php -S 0.0.0.0:${PORT:-8080} -t public public/router.php
