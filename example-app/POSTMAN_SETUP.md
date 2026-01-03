# Postman Collection Setup Guide

This guide will help you set up and use the Postman collection for testing the Jewelry Store API.

## Prerequisites

1. **Postman Desktop App** - Download from [postman.com](https://www.postman.com/downloads/)
2. **Laravel Application Running** - Make sure your Laravel server is running on `http://localhost:8000`
3. **Passport Installed** - Ensure Laravel Passport is set up (see below)

## Initial Setup

### Step 1: Install and Configure Passport

Before using the API, you need to set up Laravel Passport:

```bash
# Install Passport keys (run this once)
php artisan passport:install

# Create a personal access client (for testing)
php artisan passport:client --personal
```

### Step 2: Import Postman Collection

1. Open Postman
2. Click **Import** button (top left)
3. Select **File** tab
4. Choose `postman_collection.json` from the project root
5. Click **Import**

The collection "Jewelry Store API" will appear in your Postman workspace.

### Step 3: Configure Collection Variables

1. Click on the collection name "Jewelry Store API"
2. Go to the **Variables** tab
3. Verify these variables are set:
   - `base_url`: `http://localhost:8000/api`
   - `access_token`: (leave empty - will be auto-filled after login)

## Using the API

### Authentication Flow

1. **Register a User** (Optional)
   - Go to: `Authentication > Register`
   - Click **Send**
   - The access token will be automatically saved to `access_token` variable

2. **Login** (Recommended)
   - Go to: `Authentication > Login`
   - Update the email/password in the request body if needed
   - Click **Send**
   - The access token will be automatically saved to `access_token` variable

3. **Get Current User**
   - Go to: `Authentication > Get Current User`
   - Click **Send**
   - This will show your authenticated user details

### Testing Endpoints

#### Public Endpoints (No Authentication Required)

- **List Products**: `GET /api/products`
- **Get Single Product**: `GET /api/products/{id}`
- **List Categories**: `GET /api/categories`
- **Get Single Category**: `GET /api/categories/{id}`

#### Authenticated Endpoints (Require Token)

After logging in, the token is automatically added to all requests via the `Authorization: Bearer {{access_token}}` header.

- **Get Orders**: `GET /api/orders`
- **Create Order**: `POST /api/orders`
- **Get Single Order**: `GET /api/orders/{id}`

#### Admin Endpoints (Require Admin Token)

You need to login with an admin account (user with `is_admin = true`):

1. Login with admin credentials via `Authentication > Login`
2. The token will be saved automatically
3. Use these endpoints:
   - **Create Product**: `POST /api/products`
   - **Update Product**: `PUT /api/products/{id}`
   - **Delete Product**: `DELETE /api/products/{id}`
   - **Create Category**: `POST /api/categories`
   - **Update Category**: `PUT /api/categories/{id}`
   - **Delete Category**: `DELETE /api/categories/{id}`
   - **Update Order Status**: `PUT /api/orders/{id}`
   - **Delete Order**: `DELETE /api/orders/{id}`

## Creating an Admin User

To test admin endpoints, create an admin user:

```bash
php artisan tinker
```

Then run:
```php
$user = App\Models\User::create([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'password' => bcrypt('password123'),
    'is_admin' => true
]);
```

Use `admin@example.com` / `password123` to login via Postman.

## Tips

1. **Token Auto-Save**: The Login and Register requests automatically save the token to the collection variable. You don't need to manually copy it.

2. **Testing Image Upload**: For "Create Product" endpoint, use the form-data body type and select an image file for the `image` field.

3. **Error Responses**: If you get 401 Unauthorized, make sure you've logged in and the token is saved.

4. **Base URL**: If your server runs on a different port, update the `base_url` variable in the collection.

5. **Rate Limiting**: The API has rate limiting. If you hit limits, wait a few seconds before retrying.

## Collection Structure

```
Jewelry Store API
├── Authentication
│   ├── Register
│   ├── Login
│   ├── Get Current User
│   └── Logout
├── Products
│   ├── List Products (Public)
│   ├── Get Single Product (Public)
│   ├── Create Product (Admin)
│   ├── Update Product (Admin)
│   └── Delete Product (Admin)
├── Categories
│   ├── List Categories (Public)
│   ├── Get Single Category (Public)
│   ├── Create Category (Admin)
│   ├── Update Category (Admin)
│   └── Delete Category (Admin)
└── Orders
    ├── List Orders (Authenticated)
    ├── Get Single Order (Authenticated)
    ├── Create Order (Authenticated)
    ├── Update Order Status (Admin)
    └── Delete Order (Admin)
```

## Troubleshooting

**Issue**: "Route not found" errors
- **Solution**: Make sure your Laravel server is running and routes are cached: `php artisan route:clear`

**Issue**: "Unauthenticated" errors
- **Solution**: Login again to get a fresh token, or check if the token expired

**Issue**: "Admin access required" errors
- **Solution**: Make sure you're logged in with a user that has `is_admin = true`

**Issue**: Passport errors
- **Solution**: Run `php artisan passport:install` and `php artisan passport:client --personal`

