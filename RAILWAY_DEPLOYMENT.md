# Railway Deployment Guide

## Step 1: Connect GitHub Repository
1. Go to [railway.app](https://railway.app)
2. Click "New Project"
3. Select "GitHub" and connect your account
4. Search for and select `Dheyniel9/inventory_system`

## Step 2: Configure MySQL Database
1. In Railway dashboard, click "Add Service"
2. Select "MySQL"
3. Wait for it to provision (should see a green checkmark)

## Step 3: Set Environment Variables
The following variables will be automatically available from Railway:

### From MySQL Service
- `MYSQLHOST` → Use as `DB_HOST`
- `MYSQLPORT` → Use as `DB_PORT` (default: 3306)
- `MYSQL_USER` → Use as `DB_USERNAME`
- `MYSQL_PASSWORD` → Use as `DB_PASSWORD`
- `MYSQL_DATABASE` → Use as `DB_DATABASE`

### Configure in Railway UI:
Add these environment variables:

```
APP_NAME=Inventory System
APP_ENV=production
APP_DEBUG=false
APP_TIMEZONE=UTC
APP_URL=https://your-railway-domain.up.railway.app

DB_CONNECTION=mysql
DB_HOST=${{MYSQLHOST}}
DB_PORT=${{MYSQLPORT}}
DB_DATABASE=${{MYSQL_DATABASE}}
DB_USERNAME=${{MYSQL_USER}}
DB_PASSWORD=${{MYSQL_PASSWORD}}

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

LOG_CHANNEL=stderr
LOG_LEVEL=info

MAIL_MAILER=log
```

## Step 4: Deploy
1. The deployment will happen automatically on GitHub push
2. Railway will:
   - Install PHP 8.3, Node.js 20, and Composer
   - Run `composer install --no-dev --optimize-autoloader`
   - Run `npm ci && npm run build`
   - Cache configuration, views, and routes
   - Run database migrations (via release phase)
   - Start the web server

## Step 5: Generate Application Key
After first deployment:
1. Go to Railway dashboard
2. Click on your project
3. Open the terminal
4. Run: `php artisan key:generate`
5. Or re-deploy to trigger the release phase

## Step 6: Seed Database (Optional)
To populate test data:
```bash
php artisan db:seed
```

## Database Migrations
Migrations will run automatically during deployment via the release phase in `Procfile`.

## Access Your Application
Once deployed, Railway will provide a public URL like:
`https://your-app.up.railway.app`

Default credentials:
- Email: `admin@example.com`
- Password: `password`

## Troubleshooting

### View Logs
- Go to Railway dashboard → Select your project → Click "Logs" tab

### Common Issues
1. **Key not set**: Run `php artisan key:generate` in Railway terminal
2. **Database not connecting**: Verify `MYSQL_*` variables in Railway
3. **Cache issues**: Run `php artisan cache:clear`
4. **View cache issues**: Run `php artisan view:clear`

### Manual Commands
Access Railway's terminal and run:
```bash
php artisan migrate --force
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```
