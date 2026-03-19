<?php
require_once "../database/connection.php";

try {
    // Create categories table if it doesn't exist
    $create_categories = "
    CREATE TABLE IF NOT EXISTS categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL UNIQUE,
        description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $pdo->exec($create_categories);
    echo "Categories table created successfully.<br>";

    // Add category_id column to products table if it doesn't exist
    $add_category_column = "
    ALTER TABLE products
    ADD COLUMN IF NOT EXISTS category_id INT,
    ADD CONSTRAINT fk_category FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL";

    $pdo->exec($add_category_column);
    echo "Category column added to products table successfully.<br>";

    // Insert default categories if they don't exist
    $insert_categories = "
    INSERT IGNORE INTO categories (name, description) VALUES
    ('Electronics', 'Electronic devices and gadgets'),
    ('Audio', 'Headphones, speakers, and audio equipment'),
    ('Gaming', 'Gaming accessories and peripherals'),
    ('Computers', 'Laptops, desktops, and computer accessories'),
    ('Mobile', 'Smartphones and mobile accessories')";

    $pdo->exec($insert_categories);
    echo "Default categories inserted successfully.<br>";

    echo "<br>Database schema update completed!";
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>