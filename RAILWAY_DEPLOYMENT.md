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

### From MySQL Service (Auto-linked)
- `MYSQLHOST`
- `MYSQLPORT` (default: 3306)
- `MYSQL_USER`
- `MYSQL_PASSWORD`
- `MYSQL_DATABASE`

### From Railway App Service (Auto-generated)
- `RAILWAY_PUBLIC_DOMAIN` - Your app's public URL
- `PORT` - Server port

### Configure in Railway UI:
Add these environment variables in your app's variables section:

```
APP_NAME=Inventory System
APP_ENV=production
APP_DEBUG=false
APP_TIMEZONE=UTC
LOG_CHANNEL=stderr
LOG_LEVEL=info
```

**Important:**
- Database variables (MYSQL_*) are automatically provided when you link the MySQL service
- The app key will be generated automatically during deployment
- If you need to reset, set `APP_KEY=` to trigger regeneration

## Step 4: Deploy
1. The deployment will happen automatically on GitHub push
2. Railway will:
   - Install PHP 8.3, Node.js 20, and Composer
   - Run `composer install --no-dev --optimize-autoloader`
   - Run `npm ci && npm run build`
   - Generate application key automatically (`php artisan key:generate --force`)
   - Cache configuration, views, and routes
   - Build assets with Vite
   - Start the web server (migrations run on startup)

## Step 5: Access Your Application
Once deployed, Railway will provide a public URL like:
`https://your-app.up.railway.app`

Default credentials:
- Email: `admin@example.com`
- Password: `password`

First time: You may need to seed demo data. Go to Railway's terminal and run:
```bash
php artisan db:seed
```

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
