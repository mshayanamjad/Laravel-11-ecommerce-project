# Laravel 11 E‑Commerce Project

A modern, scalable e‑commerce application built with **Laravel 11**, offering secure authentication, product management, shopping cart, Stripe checkout, and admin dashboard functionality. Powered by MySQL and modern frontend tools.

## Table of Contents

- [Features](#features)  
- [Tech Stack](#tech-stack)  
- [Getting Started](#getting-started)  
  - [Prerequisites](#prerequisites)  
  - [Installation](#installation)  
  - [Database Setup](#database-setup)  
  - [Running the App](#running-the-app)  
- [Usage](#usage)  
- [Admin Dashboard](#admin-dashboard)  
- [Testing](#testing)  
- [Contributing](#contributing)  
- [License](#license)  
- [Contact](#contact)

---

## Features

- **Secure user authentication** (registration, login, password reset)  
- **Product management** (CRUD operations via admin panel)  
- **Shopping cart system** with session persistence  
- **Stripe-powered checkout** integration  
- **Admin dashboard** for managing users, orders, products, etc.  
- **Scalable architecture** using Laravel, MySQL, and modern frontend stack

---

## Tech Stack

- **Backend**: PHP 8+, Laravel 11  
- **Database**: MySQL  
- **Frontend**: Blade, Tailwind CSS, Vite, JavaScript  
- **Payment**: Stripe API  
- **Containerization**: Dockerfile to build and manage development environment

---

## Getting Started

### Prerequisites

Ensure your system has:

- PHP 8+  
- Composer  
- Node.js & npm  
- MySQL (or compatible)  
- Docker (optional, if using Docker setup)

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/mshayanamjad/Laravel-11-ecommerce-project.git
   cd Laravel-11-ecommerce-project
   ```

2. Copy `.env.example` to `.env`:
   ```bash
   cp .env.example .env
   ```

3. Install PHP dependencies:
   ```bash
   composer install
   ```

4. Install frontend dependencies and build assets:
   ```bash
   npm install
   npm run dev
   ```

### Database Setup

1. In your `.env`, configure your database credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

2. If you have a SQL dump (like `male_fashion.sql`), import it:
   ```bash
   mysql -u your_username -p your_database_name < male_fashion.sql
   ```

3. Run migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```

### Running the App

- Without Docker:
  ```bash
  php artisan serve
  ```

- With Docker (setup via `Dockerfile`):
  ```bash
  docker build -t laravel-ecommerce .
  docker run --rm -p 8000:8000 laravel-ecommerce
  ```

Access the application at: `http://localhost:8000`

---

## Usage

- Browse products and add them to your shopping cart  
- Head to the checkout page and complete your purchases via Stripe  
- Users can register, login, and manage their accounts

---

## Admin Dashboard

- Accessible via: `http://localhost:8000/admin` (or your configured route)  
- Manage products, orders, users, and view metrics  
- Use login credentials provided in `login_details.txt` (ensure this file remains secure)

---

## Testing

Run application tests using PHPUnit:
```bash
php artisan test
```

---

## Contributing

Contributions are welcome! Please:

1. Fork the repository  
2. Create a new feature branch: `git checkout -b feature/YourFeature`  
3. Commit your changes: `git commit -m "Add YourFeature"`  
4. Push to your branch and open a pull request

---

## License

This project is open-source under the **MIT License**. See the [LICENSE](LICENSE) file for full details.

---

## Contact

For questions or feedback:  
**Maintainer**: mshayanamjad  
**GitHub Profile**: https://github.com/mshayanamjad

---

## Additional Notes

- If using Stripe, make sure to set the required keys in `.env`:  
  ```
  STRIPE_KEY=your_publishable_key  
  STRIPE_SECRET=your_secret_key  
  ```

- Customize UI via resources in `resources/views`, `resources/css`, or `resources/js`.

- The project includes a `Dockerfile`—let me know if you’d like a full `docker-compose.yml` setup too!
