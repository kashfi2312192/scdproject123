# Jewelry E-Commerce Store

A modern, full-featured e-commerce web application built with Laravel 12 for selling jewelry and fashion accessories. This application provides a complete shopping experience with product catalog, shopping cart, checkout process, product reviews, and an admin panel for managing products.

## Project Overview

This is a Laravel-based e-commerce platform designed for jewelry retailers. The application features:

### Key Features

- **Product Catalog**: Browse and view detailed product information with images, descriptions, pricing, and categories
- **Shopping Cart**: Session-based shopping cart with add, remove, update, and clear functionality
- **Checkout Process**: Complete order placement workflow with order storage
- **Order History**: Users can view their complete order history and order details
- **Product Reviews**: Customers can leave reviews and ratings for products
- **Category Management**: Products organized through category relationships with full CRUD operations
- **AJAX Search**: Real-time product search with instant results dropdown
- **Image Upload**: Full image upload functionality for products via admin panel
- **RESTful API**: Complete CRUD APIs for Products, Orders, and Categories
- **API Authentication**: Laravel Passport OAuth2 authentication for API access
- **User Authentication**: Secure user registration and login powered by Laravel Breeze
- **Admin Panel**: Separate admin authentication and dashboard for managing products, orders, and categories
- **Responsive Design**: Modern UI built with Tailwind CSS and Alpine.js
- **Product Management**: Full CRUD operations for products including images, pricing, stock, categories, and tags

### Technology Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Tailwind CSS, Alpine.js, Vite
- **Authentication**: Laravel Breeze
- **Database**: SQLite (default) or MySQL/PostgreSQL
- **Asset Compilation**: Vite

## Setup Instructions

### Prerequisites

Before you begin, ensure you have the following installed on your system:

- **PHP** >= 8.2 with extensions:
  - BCMath
  - Ctype
  - cURL
  - DOM
  - Fileinfo
  - JSON
  - Mbstring
  - OpenSSL
  - PCRE
  - PDO
  - Tokenizer
  - XML
- **Composer** (PHP dependency manager)
- **Node.js** >= 18.x and **npm** (for frontend assets)
- **Database**: SQLite (included) or MySQL/PostgreSQL

### Installation Steps

1. **Clone or navigate to the project directory**
   ```bash
   cd example-app
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Create environment file**
   ```bash
   cp .env.example .env
   ```
   
   If `.env.example` doesn't exist, create a `.env` file with the following minimum configuration:
   ```env
   APP_NAME="Jewelry Store"
   APP_ENV=local
   APP_KEY=
   APP_DEBUG=true
   APP_URL=http://localhost:8000
   
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   ```

4. **Generate application key**
   ```bash
   php artisan key:generate
   ```

5. **Create SQLite database file** (if using SQLite)
   ```bash
   touch database/database.sqlite
   ```

6. **Run database migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed the database** (optional - adds sample products)
   ```bash
   php artisan db:seed --class=ProductSeeder
   ```

8. **Install Node.js dependencies**
   ```bash
   npm install
   ```

9. **Build frontend assets**
   ```bash
   npm run build
   ```

### Quick Setup (Alternative)

You can use the built-in setup script that automates most of the installation:

```bash
composer run setup
```

This command will:
- Install Composer dependencies
- Copy `.env.example` to `.env` (if it doesn't exist)
- Generate application key
- Run database migrations
- Install npm dependencies
- Build frontend assets

### Database Configuration

#### Using SQLite (Default - Recommended for Development)

The application is configured to use SQLite by default. Simply ensure the database file exists:

```bash
touch database/database.sqlite
```

#### Using MySQL/PostgreSQL

If you prefer MySQL or PostgreSQL, update your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Then create the database and run migrations:

```bash
php artisan migrate
```

### Storage Setup

Ensure the storage directory is writable:

```bash
php artisan storage:link
```

On Linux/Mac:
```bash
chmod -R 775 storage bootstrap/cache
```

## Usage Guide

### Starting the Development Server

#### Option 1: Standard Development Mode

Start the Laravel development server and Vite dev server separately:

**Terminal 1 - Laravel Server:**
```bash
php artisan serve
```

**Terminal 2 - Vite Dev Server:**
```bash
npm run dev
```

The application will be available at `http://localhost:8000`

#### Option 2: Concurrent Development Mode (Recommended)

Use the built-in dev script that runs all services concurrently:

```bash
composer run dev
```

This starts:
- Laravel development server (port 8000)
- Queue worker
- Vite dev server

### Accessing the Application

#### Customer Interface

- **Homepage**: `http://localhost:8000/`
- **Products**: `http://localhost:8000/products`
- **Cart**: `http://localhost:8000/cart`
- **Checkout**: `http://localhost:8000/checkout`
- **Contact**: `http://localhost:8000/contactus`

#### User Authentication

- **Register**: `http://localhost:8000/register`
- **Login**: `http://localhost:8000/login`
- **Dashboard**: `http://localhost:8000/dashboard` (after login)
- **Order History**: `http://localhost:8000/orders` (after login)

#### Admin Panel

- **Admin Login**: `http://localhost:8000/admin/login`
- **Admin Dashboard**: `http://localhost:8000/admin` (after admin login)
- **Manage Products**: `http://localhost:8000/admin/products`

### Creating an Admin User

To create an admin user, you can use Laravel Tinker:

```bash
php artisan tinker
```

Then run:
```php
$user = App\Models\User::create([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'is_admin' => true
]);
```

Or create a seeder for admin users.

### Using the Application

#### As a Customer

1. **Browse Products**: Visit the products page to see all available items
2. **View Product Details**: Click on any product to see full details, images, and reviews
3. **Add to Cart**: Click "Add to Cart" on any product page
4. **Manage Cart**: Visit the cart page to update quantities or remove items
5. **Checkout**: Proceed to checkout to complete your order
6. **Leave Reviews**: After viewing a product, you can leave a review (requires authentication)

#### As an Admin

1. **Login**: Access the admin panel at `/admin/login`
2. **Dashboard**: View the admin dashboard for an overview
3. **Manage Products**: 
   - View all products at `/admin/products`
   - Create new products
   - Edit existing products
   - Delete products
4. **Product Fields**: When creating/editing products, you can set:
   - Name, description, and short description
   - Price, old price, and discount percentage
   - Stock quantity and SKU
   - Category and tags
   - Product image

### Building for Production

When deploying to production:

1. **Set environment to production**
   ```env
   APP_ENV=production
   APP_DEBUG=false
   ```

2. **Optimize the application**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

3. **Build production assets**
   ```bash
   npm run build
   ```

### Running Tests

The application includes PHPUnit tests. Run them with:

```bash
composer run test
```

Or directly:
```bash
php artisan test
```

## Project Structure

```
example-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Application controllers
│   │   │   ├── Admin/          # Admin panel controllers
│   │   │   ├── CartController.php
│   │   │   ├── ProductController.php
│   │   │   └── ...
│   │   └── Middleware/         # Custom middleware
│   └── Models/                  # Eloquent models
│       ├── Product.php
│       ├── ProductReview.php
│       └── User.php
├── database/
│   ├── migrations/              # Database migrations
│   └── seeders/                 # Database seeders
├── public/                      # Public assets
│   └── img/                     # Product images
├── resources/
│   ├── views/                   # Blade templates
│   │   ├── admin/               # Admin panel views
│   │   ├── components/          # Reusable components
│   │   └── layouts/             # Layout templates
│   ├── css/                     # Stylesheets
│   └── js/                      # JavaScript files
└── routes/
      └── web.php                  # Web routes
```

## API Documentation

The application includes a complete RESTful API with Laravel Passport authentication.

### API Setup

1. **Install Passport keys**:
   ```bash
   php artisan passport:install
   ```

2. **Create personal access client** (for testing):
   ```bash
   php artisan passport:client --personal
   ```

### API Endpoints

#### Authentication
- `POST /api/register` - Register new user
- `POST /api/login` - Login and get access token
- `GET /api/me` - Get authenticated user (requires auth)
- `POST /api/logout` - Logout and revoke token (requires auth)

#### Products (Public)
- `GET /api/products` - List products (with pagination, search, filters)
- `GET /api/products/{id}` - Get single product

#### Products (Admin - requires auth + admin)
- `POST /api/products` - Create product (with image upload)
- `PUT /api/products/{id}` - Update product
- `DELETE /api/products/{id}` - Delete product

#### Categories (Public)
- `GET /api/categories` - List categories
- `GET /api/categories/{id}` - Get single category with products

#### Categories (Admin - requires auth + admin)
- `POST /api/categories` - Create category
- `PUT /api/categories/{id}` - Update category
- `DELETE /api/categories/{id}` - Delete category

#### Orders (Authenticated)
- `GET /api/orders` - List user's orders (or all orders for admin)
- `GET /api/orders/{id}` - Get single order
- `POST /api/orders` - Create new order

#### Orders (Admin - requires auth + admin)
- `PUT /api/orders/{id}` - Update order status
- `DELETE /api/orders/{id}` - Delete order

### Postman Collection

A complete Postman collection is available at `postman_collection.json` with detailed setup instructions in `POSTMAN_SETUP.md`.

**Quick Start:**
1. Install Passport: `php artisan passport:install && php artisan passport:client --personal`
2. Import `postman_collection.json` into Postman
3. Use the "Login" request to authenticate - it automatically saves the token
4. All authenticated requests will use the saved token

**For detailed instructions, see `POSTMAN_SETUP.md`**

### API Authentication

All protected endpoints require a Bearer token in the Authorization header:
```
Authorization: Bearer {access_token}
```

Get the token by logging in via `/api/login` endpoint.

## Additional Notes

- **Session Storage**: The shopping cart uses Laravel sessions. Ensure sessions are properly configured in `config/session.php`
- **File Storage**: Product images can be stored in `public/img/products/` or uploaded via the admin panel or API
- **Queue Jobs**: If using queues, ensure the queue worker is running: `php artisan queue:work`
- **Logs**: Application logs are stored in `storage/logs/laravel.log`
- **API Rate Limiting**: API routes are rate-limited by default. Adjust in `app/Http/Kernel.php` if needed
- **Order Storage**: All orders are stored in the database with complete order details and status tracking
- **Category Relationships**: Products use category relationships (not string fields) for better data integrity

## Troubleshooting

### Common Issues

1. **"Class not found" errors**: Run `composer dump-autoload`
2. **Assets not loading**: Run `npm run build` or `npm run dev`
3. **Database errors**: Ensure migrations are run: `php artisan migrate`
4. **Permission errors**: Check file permissions on `storage/` and `bootstrap/cache/`
5. **Admin login not working**: Ensure the user has `is_admin = true` in the database

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For Laravel-specific help, refer to the [Laravel documentation](https://laravel.com/docs).
