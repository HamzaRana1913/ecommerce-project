# LuxeStore — Complete Laravel eCommerce

## Test Credentials
- Admin:    admin@luxestore.pk   / password
- Customer: customer@example.com / password

## URLs
- Home:    /
- Products: /products
- Contact:  /contact
- Admin:    /admin/dashboard

## Setup
```bash
composer create-project laravel/laravel luxestore
cd luxestore
# Copy all files from this project
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve
```

## Files Added/Completed
- app/Http/Controllers/HomeController.php
- app/Http/Controllers/ProductController.php
- app/Http/Controllers/CartController.php
- app/Http/Controllers/CheckoutController.php
- app/Http/Controllers/ContactController.php
- app/Http/Controllers/Auth/* (Login, Register, Password Reset)
- app/Http/Controllers/Admin/* (Dashboard, Products, Orders, Users, Contacts)
- app/Http/Middleware/AdminMiddleware.php
- app/Models/User|Product|Order|OrderItem|Contact.php
- database/migrations/* (5 tables)
- database/seeders/DatabaseSeeder.php
- resources/views/auth/* (login, register, forgot-password)
- resources/views/checkout/success.blade.php
- resources/views/admin/products/index+edit.blade.php
- resources/views/admin/orders/index+show+items.blade.php
- resources/views/admin/users/index+admins.blade.php
- routes/web.php (complete)
- routes/auth.php
- bootstrap/app.php (admin middleware registered)
