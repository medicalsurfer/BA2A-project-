<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Include database connection
require_once "../database/connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = (int)$_POST['product_id'];

    // Prepare and execute delete query
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    if ($stmt->execute([$product_id])) {
        // Check if any row was actually deleted
        if ($stmt->rowCount() > 0) {
            $_SESSION['success_message'] = "Product removed successfully!";
        } else {
            $_SESSION['error_message'] = "Product not found or already removed.";
        }
    } else {
        $_SESSION['error_message'] = "Error removing product.";
    }
} else {
    $_SESSION['error_message'] = "Invalid request.";
}

// Redirect back to dashboard
header("Location: dashboard.php");
exit();
?>