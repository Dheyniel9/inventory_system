#!/bin/bash

echo "🔍 Laravel Deployment Debug Script"
echo "=================================="

echo "📍 Current directory: $(pwd)"
echo "🐘 PHP Version: $(php --version | head -1)"
echo "📦 Composer Version: $(composer --version)"
echo "📦 Node Version: $(node --version)"
echo "📦 NPM Version: $(npm --version)"

echo ""
echo "📁 File System Check:"
echo "  .env exists: $([ -f .env ] && echo "YES" || echo "NO")"
echo "  .env.example exists: $([ -f .env.example ] && echo "YES" || echo "NO")"
echo "  composer.json exists: $([ -f composer.json ] && echo "YES" || echo "NO")"
echo "  package.json exists: $([ -f package.json ] && echo "YES" || echo "NO")"
echo "  bootstrap/cache writable: $([ -w bootstrap/cache ] && echo "YES" || echo "NO")"
echo "  storage writable: $([ -w storage ] && echo "YES" || echo "NO")"

echo ""
echo "🔧 Laravel Configuration:"
if [ -f artisan ]; then
    echo "  Artisan available: YES"

    echo "  Environment: $(php artisan env 2>/dev/null || echo "ERROR")"
    echo "  Debug mode: $(php artisan tinker --execute='echo config("app.debug") ? "ON" : "OFF";' 2>/dev/null || echo "ERROR")"
    echo "  APP_KEY set: $(php artisan tinker --execute='echo config("app.key") ? "YES" : "NO";' 2>/dev/null || echo "ERROR")"

    echo ""
    echo "📊 Database Connection Test:"
    php artisan migrate:status 2>&1 | head -10 || echo "  ❌ Database connection failed"

    echo ""
    echo "🗂️ Config Cache Status:"
    php artisan config:show app.name 2>/dev/null || echo "  ❌ Config cache error"

else
    echo "  Artisan available: NO"
fi

echo ""
echo "🌐 Environment Variables:"
env | grep -E '^(APP_|DB_|LOG_)' | sort

echo ""
echo "🗂️ Directory Structure:"
ls -la storage/ 2>/dev/null | head -10
echo "..."
ls -la bootstrap/cache/ 2>/dev/null | head -5

echo ""
echo "📝 Recent Logs (if any):"
if [ -d storage/logs ]; then
    ls -la storage/logs/
    echo ""
    echo "Latest log entries:"
    tail -20 storage/logs/laravel.log 2>/dev/null | head -10 || echo "No logs found"
fi

echo ""
echo "🏁 Debug Complete"
