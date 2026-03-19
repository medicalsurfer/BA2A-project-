<?php
require_once "../database/connection.php";

try {
    // Check current products table structure
    $stmt = $pdo->query("DESCRIBE products");
    $columns = $stmt->fetchAll();

    echo "<h3>Current Products Table Structure:</h3>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    foreach ($columns as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['Field']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Type']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Null']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Key']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Default']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Extra']) . "</td>";
        echo "</tr>";
    }
    echo "</table><br>";

    // Check if amount column exists
    $amount_exists = false;
    foreach ($columns as $row) {
        if ($row['Field'] == 'amount') {
            $amount_exists = true;
            break;
        }
    }

    // Add amount column if it doesn't exist
    if (!$amount_exists) {
        echo "Adding amount column...<br>";
        $pdo->exec("ALTER TABLE products ADD COLUMN amount INT NOT NULL DEFAULT 0");
        echo "✅ Amount column added successfully!<br>";
    } else {
        echo "✅ Amount column already exists.<br>";
    }

    // Check if category_id column exists
    $category_exists = false;
    foreach ($columns as $row) {
        if ($row['Field'] == 'category_id') {
            $category_exists = true;
            break;
        }
    }

    // Add category_id column if it doesn't exist
    if (!$category_exists) {
        echo "Adding category_id column...<br>";
        $pdo->exec("ALTER TABLE products ADD COLUMN category_id INT, ADD CONSTRAINT fk_category FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL");
        echo "✅ Category_id column added successfully!<br>";
    } else {
        echo "✅ Category_id column already exists.<br>";
    }

    echo "<br>Database structure check completed!";
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>