# 🚨 Render Deployment Troubleshooting Guide

## Common 500 Error Causes & Solutions

### 1. Application Key Missing
**Symptom**: 500 error, logs show "No application encryption key"
**Solution**:
- Set `APP_KEY` environment variable in Render dashboard
- Or let the startup script generate one automatically

### 2. Database Connection Issues
**Symptom**: 500 error during database operations
**Solutions**:
- Verify database credentials in Render environment variables
- Check if database service is running
- Ensure database and web service are in same region

### 3. Storage Permissions
**Symptom**: 500 error, logs show permission denied
**Solution**: The startup script should handle this, but verify:
```bash
chmod -R 755 storage bootstrap/cache
```

### 4. Missing Dependencies
**Symptom**: Class not found errors
**Solution**: Ensure composer install runs successfully in build

### 5. Caching Issues
**Symptom**: Config/Route cache errors
**Solution**: Clear caches before deployment:
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

## Debugging Steps

### Step 1: Check Health Endpoint
Visit: `https://your-app.onrender.com/health`
This will show:
- Database connection status
- PHP version
- Laravel version
- App key status
- Debug mode status

### Step 2: Check Render Logs
1. Go to your Render service dashboard
2. Click on "Logs" tab
3. Look for error messages during build or runtime

### Step 3: Enable Debug Mode Temporarily
In Render environment variables, set:
- `APP_DEBUG=true`
- `LOG_LEVEL=debug`

This will show detailed error messages.

### Step 4: Database Troubleshooting
If database connection fails:
1. Check environment variables match your Render database
2. Verify database service is running
3. Test connection with: `php artisan migrate:status`

## Environment Variables Checklist

Required variables in Render dashboard:

```
APP_NAME=Inventory System
APP_ENV=production
APP_DEBUG=true (for debugging, set to false in production)
APP_KEY=(auto-generated or manually set)
APP_URL=https://your-service-name.onrender.com

LOG_CHANNEL=stderr
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=(from your Render database)
DB_PORT=3306
DB_DATABASE=(from your Render database)
DB_USERNAME=(from your Render database)
DB_PASSWORD=(from your Render database)

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

SEED_DATABASE=true (for first deployment only)
```

## Quick Fixes

### If build fails:
1. Check PHP/Node versions in logs
2. Verify all dependencies in composer.json/package.json
3. Check for syntax errors in code

### If deployment succeeds but 500 errors occur:
1. Check the health endpoint first
2. Look at runtime logs in Render dashboard
3. Verify database connection
4. Check file permissions

### If database migrations fail:
1. Verify database credentials
2. Check if database service is accessible
3. Try running migrations manually in Render shell

## Manual Deployment Commands

If automatic deployment fails, you can run these manually in Render shell:

```bash
# 1. Install dependencies
composer install --no-dev --optimize-autoloader
npm ci && npm run build

# 2. Setup Laravel
php artisan key:generate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Database setup
php artisan migrate --force
php artisan db:seed --force  # only if needed

# 4. Start server
php artisan serve --host=0.0.0.0 --port=$PORT
```

Remember to set `APP_DEBUG=false` and `LOG_LEVEL=info` once everything is working!
