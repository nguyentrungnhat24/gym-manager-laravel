# Gym Management System

Web application for managing a gym center, built with Laravel 10. The project includes separate flows for administrators and customers, covering authentication, training package management, trainers, schedules, equipment, cart/checkout, and profile management.

## Overview

This project was developed as a team project for practicing full-stack web development with Laravel and MySQL. The application combines an admin management area and a customer-facing area:

- Admin area:
  manage staff, customers, trainers, training packages, schedules, equipment, and summary statistics
- User area:
  browse classes, view trainers and schedules, add packages to cart, checkout, and manage profile information

## Main Features

### Authentication

- Sign in / sign up
- Logout
- Role-based redirection after login

### Admin Features

- Dashboard with overview statistics
- Manage staff
- Manage customers
- Manage personal trainers
- Manage training packages
- Manage training schedules
- Manage equipment and equipment categories
- View package statistics

### User Features

- Home page and gym introduction pages
- Browse training classes and class details
- View schedules and trainers
- Add packages to cart
- Checkout and order flow
- View and edit profile
- BMI page
- Contact page

## Tech Stack

- Backend: PHP, Laravel 10
- Database: MySQL
- Frontend: Blade, HTML, CSS, JavaScript
- Build tool: Vite
- Authentication: Laravel Auth with customized user fields

## Project Structure

```text
app/
  Http/
    Controllers/
      Admin/        # Admin controllers
      Auth/         # Login and registration
      User/         # Customer-facing controllers
  Models/           # Eloquent models
database/
  migrations/       # Migrations
  seeders/          # Seed data
resources/views/
  admin/            # Admin Blade views
  user/             # User Blade views
  signin_signup/    # Authentication views
routes/
  web.php           # Main web routes
public/             # Images, uploaded files, CSS, JS
```

## Important Routes

### Public

- `/` - landing page
- `/signin` - sign in
- `/signup` - sign up

### Admin

- `/admin/trangchu` - dashboard
- `/admin/nhanvien` - staff management
- `/admin/khachhang` - customer management
- `/admin/pt` - trainer management
- `/admin/goitap` - training package management
- `/admin/lichtap` - schedule management
- `/admin/dungcu` - equipment management
- `/admin/thongke` - statistics

### User

- `/user/home` - home page
- `/user/classes` - training classes
- `/user/class/{id}` - class details
- `/user/schedule` - schedule
- `/user/trainer` - trainers
- `/user/cart` - cart
- `/user/checkout` - checkout page
- `/user/profile` - user profile
- `/user/orders` - orders

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/nguyentrungnhat24/gym-manager-laravel.git
cd gym-manager-laravel
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Create environment file

```bash
cp .env.example .env
php artisan key:generate
```

Then update your database configuration in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 4. Run database setup

```bash
php artisan migrate
php artisan db:seed
```

### 5. Start the project

```bash
npm run dev
php artisan serve
```

The application should be available at:

```text
http://127.0.0.1:8000
```

## Default Admin Account

If the seeder runs successfully, the default admin account is:

- Username: `admin`
- Password: `admin123`

## Notes About Database Schema

This codebase contains signs of migration from an older schema to a newer Laravel-based structure. Some models and seeders use customized fields such as:

- `users.username`
- `users.password_hash`
- `users.full_name`
- `training_packages`
- `training_categories`

Because of that:

- the current migrations may not fully match the models used by the application
- you may need to adjust migrations or import the original database schema for the project to work completely
- some legacy field mappings are handled directly inside models

If you are setting the project up from scratch, review the models and migrations carefully before relying on `php artisan migrate` alone.

## Development Notes

- The project uses mostly server-rendered Blade views
- Static assets are stored under `public/`
- Uploaded images are stored in `public/uploaded` and `public/admin/uploaded`
- Authentication logic is customized to use `username` and `password_hash`

## Future Improvements

- Normalize database schema and migrations
- Protect admin routes with dedicated middleware
- Replace debug/fix routes with artisan commands or admin-only tools
- Add automated tests for checkout and authentication flows
- Improve validation and error handling across forms

## Author

Nguyen Trung Nhat

- GitHub: https://github.com/nguyentrungnhat24

