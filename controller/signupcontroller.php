<?php
require_once "../database/connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Basic validation
    if (empty($name) || empty($email) || empty($password)) {
        echo "All fields are required.";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters long.";
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            echo "Email already registered.";
            exit();
        }

        // Insert new user
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, class) VALUES (?, ?, ?, 'user')");
        $stmt->execute([$name, $email, $hashedPassword]);

        header("Location: ../datatransfer/login.php");
        exit();
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>