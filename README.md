# Ecommerce Website

A modern ecommerce website built with PHP 8+, MySQL, PDO, and Tailwind CSS.

## Features

- User registration and login with secure password hashing
- Product catalog with images and categories
- Dashboard for logged-in users with product management
- Responsive design with Tailwind CSS
- Real-time search functionality
- Secure database interactions with PDO and prepared statements
- Session management
- File upload for product images

## Security Improvements

- PDO for database connections (replacing mysqli)
- Prepared statements to prevent SQL injection
- Input validation and sanitization
- Secure password hashing with PASSWORD_DEFAULT
- CSRF protection considerations
- Proper error handling

## Setup Instructions

1. **Database Setup:**
   - Open phpMyAdmin (usually at http://localhost/phpmyadmin)
   - Import the `setup.sql` file to create the database, tables, and sample data

2. **Configuration:**
   - Update `config.php` with your database credentials if needed

3. **Start the Website:**
   - Access the site at: `http://localhost/php1/ecommerce/pages/home.php`

## File Structure

- `config.php` - Application configuration
- `assets/css/` - Tailwind CSS
- `database/` - PDO database connection
- `controller/` - Login and signup controllers with validation
- `pages/` - Main website pages with modern UI
- `datatransfer/` - Secure data handling scripts
- `uploads/` - Product image uploads

## Pages

- Home: `pages/home.php`
- About: `pages/about.php`
- Products: `pages/products.php`
- Contact: `pages/contact.php`
- Login: `datatransfer/login.php`
- Signup: `datatransfer/signup.php`
- Dashboard: `datatransfer/dashboard.php`