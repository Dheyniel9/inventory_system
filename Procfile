release: php artisan migrate --force && php artisan storage:link
web: php -S 0.0.0.0:${PORT:-8080} -t public public/router.php
