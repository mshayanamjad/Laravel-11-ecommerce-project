# Male Fashion Ecommerce

Male Fashion is a Laravel 11 ecommerce application for browsing products, managing a cart and wishlist, placing orders, and administering the storefront.

## Features

- Product catalog with categories, subcategories, brands, images, publishing, and draft states
- Customer registration, login, profile, address, password, and account management
- Shopping cart with AJAX add, update, delete, and mini-cart refresh
- Wishlist toggle with AJAX add and remove actions
- Checkout with cash-on-delivery and Stripe card payments
- Country-based shipping rates with a safe `$0.00` fallback when no rate is configured
- Customer order history and order detail pages
- Order status tracking with status history and a progressive tracking interface
- Admin order status updates for pending, confirmed, packed, shipped, delivered, and cancelled orders
- Database notifications for customers and administrators
- Product reviews and administrative review management
- Admin dashboards for products, categories, brands, users, shipping, orders, and notifications

## Technology

- PHP 8.2 or newer
- Laravel 11
- MySQL/MariaDB through XAMPP, or another Laravel-supported database
- Composer
- Blade, jQuery, and the existing public assets
- Stripe PHP SDK for card payments
- Hardevine ShoppingCart for cart storage

This project does not use npm, Vite, or a Node.js build pipeline. Frontend assets are already included in the project and are loaded from the application views.

## Local Setup With XAMPP

The commands below assume the project is located at `D:\Xampp\htdocs\laravel` and that XAMPP provides PHP and MySQL.

1. Start Apache and MySQL from the XAMPP Control Panel.
2. Open a terminal in the project directory.
3. Install PHP dependencies:

    ```bash
    composer install
    ```

4. Create the environment file and application key:

    ```bash
    copy .env.example .env
    php artisan key:generate
    ```

5. Configure the database in `.env`. A typical XAMPP MySQL configuration is:

    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=male_fashion
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6. Create the `male_fashion` database in phpMyAdmin, then choose one database setup method:

    - Run the current migrations and seeders:

        ```bash
        php artisan migrate --seed
        php artisan db:seed --class=CountrySeeder
        ```

    - Or import the included `male_fashion.sql` dump through phpMyAdmin instead of running migrations against an existing database.

7. Create the public storage link if product files use Laravel storage:

    ```bash
    php artisan storage:link
    ```

8. Start the application with Laravel's local server:

    ```bash
    php artisan serve
    ```

    The application is then available at `http://127.0.0.1:8000/male-fashion`.

    Alternatively, with Apache configured for the project, open `http://localhost/laravel/public/male-fashion`.

## Configuration

### Mail

For local development, the default mailer can remain set to `log`. Emails will be written to `storage/logs/laravel.log` instead of being sent.

Set these values in `.env` for real email delivery:

```dotenv
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-gmail-address@gmail.com
MAIL_PASSWORD=your-16-character-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-gmail-address@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

#### Gmail App Password Setup

Gmail does not allow Laravel to authenticate with your normal Google account password. Use a Google app password instead:

1. Sign in to the Google account that will send application emails.
2. Open [Google Account Security](https://myaccount.google.com/security).
3. Enable **2-Step Verification** if it is not already enabled.
4. Open **App passwords** in the Google account security settings.
5. Create a new app password, give it a name such as `Male Fashion Laravel`, and click **Create**.
6. Copy the generated 16-character password. Use it as `MAIL_PASSWORD` without spaces.
7. Set `MAIL_USERNAME` and `MAIL_FROM_ADDRESS` to the same Gmail address, then save `.env`.
8. Clear cached Laravel configuration:

    ```bash
    php artisan config:clear
    ```

9. Place an order or trigger another email action to test delivery. Check `storage/logs/laravel.log` if the message fails.

For Google Workspace accounts, an administrator may need to allow app passwords. Never commit `.env` or share the app password; it grants access to send mail through the Google account. If the app password is revoked, generate a new one and update `MAIL_PASSWORD`.

### Stripe

Stripe checkout requires test or live credentials in `.env`:

```dotenv
STRIPE_KEY=your_publishable_key
STRIPE_SECRET=your_secret_key
```

Never commit real Stripe secrets or other credentials to source control. Cash on delivery does not require Stripe configuration.

### Shipping

Shipping rates are managed from the admin area. A country-specific rate is used first, followed by the `rest_of_world` rate. If neither exists, checkout continues with shipping set to zero.

## Main URLs

The storefront uses the `/male-fashion` prefix:

- Storefront: `/male-fashion`
- Shop: `/male-fashion/shop`
- Customer dashboard: `/male-fashion/profile`
- Customer orders: `/male-fashion/orders-list`
- Customer notifications: `/male-fashion/notifications`
- Admin login: `/admin/login`
- Admin dashboard: `/admin/dashboard`
- Admin notifications: `/admin/notifications`

Most customer and admin routes require authentication.

## Testing

Run the automated test suite with:

```bash
php artisan test
```

The feature tests cover notification inbox access and order status history. Run a focused test with:

```bash
php artisan test --filter=OrderStatusHistoryTest
```

Useful validation commands after view or PHP changes:

```bash
php artisan view:cache
php -l app/Http/Controllers/front/CheckoutController.php
```

## Project Structure

```text
app/Http/Controllers/       Storefront and admin request handling
app/Models/                  Eloquent models
app/Notifications/           Database notification classes
database/migrations/         Database schema changes
database/seeders/            Country and application seeders
resources/views/front/       Storefront and customer Blade views
resources/views/admin/       Admin Blade views
routes/web.php               Storefront and admin routes
tests/Feature/               Feature-level automated tests
public/                      Public assets and entry point
```

## Development Notes

- Use migrations for schema changes and keep existing user and order data intact.
- Do not reset or reseed a shared database unless data loss is intentional.
- Real-time WebSocket notifications are not currently enabled; notifications use Laravel's database notification channel.
- Keep payment credentials in `.env` and out of commits.

## License

This application is built on the Laravel framework and follows the project's existing license and dependency terms.