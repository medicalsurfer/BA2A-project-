-- Create database
CREATE DATABASE IF NOT EXISTS ecommerce_db;

-- Use database
USE ecommerce_db;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    class VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create categories table
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create products table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    amount INT NOT NULL DEFAULT 0,
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Insert sample categories
INSERT INTO categories (name, description) VALUES
('Electronics', 'Electronic devices and gadgets'),
('Audio', 'Headphones, speakers, and audio equipment'),
('Gaming', 'Gaming accessories and peripherals'),
('Computers', 'Laptops, desktops, and computer accessories'),
('Mobile', 'Smartphones and mobile accessories');

-- Insert sample products
INSERT INTO products (name, price, image, description, amount, category_id) VALUES
('Wireless Headphones', 99.99, '', 'High-quality wireless headphones with noise cancellation.', 50, 2),
('Smart Watch', 199.99, '', 'Feature-packed smart watch with health tracking.', 30, 1),
('Laptop', 899.99, '', 'Powerful laptop for work and entertainment.', 15, 4),
('Gaming Mouse', 49.99, '', 'Ergonomic gaming mouse with RGB lighting.', 75, 3),
('Bluetooth Speaker', 79.99, '', 'Portable Bluetooth speaker with excellent sound quality.', 40, 2),
('Tablet', 349.99, '', 'Versatile tablet for productivity and entertainment.', 25, 4);