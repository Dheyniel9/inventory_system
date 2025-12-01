# Laravel 12 Inventory Management System

A comprehensive inventory management system built with Laravel 12, featuring:
- **Spatie Laravel Permission** for RBAC (Role-Based Access Control)
- **Eloquent ORM** for database operations
- **Tailwind CSS v3** for styling
- **Service Layer Pattern** for business logic separation

## Features

- 📦 Product Management (CRUD)
- 📁 Category Management
- 🏭 Supplier Management
- 📊 Stock Management (In/Out transactions)
- 💰 **POS (Point of Sale) Terminal**
  - Quick product search & barcode scanning
  - Shopping cart with quantity management
  - Discount support (percentage & fixed)
  - Tax calculation
  - Multiple payment methods (Cash, Card, Transfer)
  - Receipt generation & printing
  - Sales history & reporting
- 👥 User Management with Roles & Permissions
- 📈 Dashboard with Analytics
- 🔍 Search & Filter functionality
- 📱 Responsive Design

## Requirements

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL/PostgreSQL/SQLite

## Installation

```bash
# Clone and navigate to project
cd inventory-system

# Install PHP dependencies
composer install

# Install NPM dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure your database in .env file
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=inventory_db
# DB_USERNAME=root
# DB_PASSWORD=

# Run migrations and seeders
php artisan migrate --seed

# Build assets
npm run build

# Start the development server
php artisan serve
```

## Default Users

| Email | Password | Role |
|-------|----------|------|
| admin@example.com | password | Admin |
| manager@example.com | password | Manager |
| staff@example.com | password | Staff |

## Roles & Permissions

### Admin
- Full access to all features
- User management
- Role & permission management

### Manager
- Product management
- Category management
- Supplier management
- Stock management
- POS access & cancel sales
- View reports

### Staff
- View products
- Stock in/out operations
- POS access (create sales)
- View own transactions

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/
│   │   ├── CategoryController.php
│   │   ├── DashboardController.php
│   │   ├── POSController.php
│   │   ├── ProductController.php
│   │   ├── StockController.php
│   │   ├── SupplierController.php
│   │   └── UserController.php
│   ├── Middleware/
│   │   └── CheckPermission.php
│   └── Requests/
├── Models/
│   ├── Category.php
│   ├── Product.php
│   ├── Sale.php
│   ├── SaleItem.php
│   ├── StockTransaction.php
│   ├── Supplier.php
│   └── User.php
├── Services/
│   ├── CategoryService.php
│   ├── DashboardService.php
│   ├── POSService.php
│   ├── ProductService.php
│   ├── StockService.php
│   ├── SupplierService.php
│   └── UserService.php
└── Providers/
```

## License

MIT License
