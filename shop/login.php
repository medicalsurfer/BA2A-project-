<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <h1>Login to Your Account</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact Us</a>
            <a href="signup.php">Signup</a>
        </nav>
    </header>
    <main>
        <form action="datatransfer/login.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2023 E-Commerce Store</p>
    </footer>
</body>
</html>