<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Ecommerce</title>
    <script src="../assets/css/tailwind.css"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen">
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$user = $_SESSION['user'];

// Include database connection
require_once "../database/connection.php";
?>

    <nav class="bg-gradient-to-r from-purple-800 to-indigo-900 w-full flex items-center justify-between px-5 py-3 shadow-lg">
        <a href="../pages/home.php" class="text-white font-bold text-xl hover:text-purple-300 transition duration-300">Ecommerce</a>
        <ul class="flex space-x-6">
            <li><a href="../pages/home.php" class="text-white px-4 py-2 rounded-lg hover:bg-purple-700 hover:bg-opacity-50 transition duration-300">Home</a></li>
            <li><a href="../pages/about.php" class="text-white px-4 py-2 rounded-lg hover:bg-purple-700 hover:bg-opacity-50 transition duration-300">About</a></li>
            <li><a href="../pages/products.php" class="text-white px-4 py-2 rounded-lg hover:bg-purple-700 hover:bg-opacity-50 transition duration-300">Products</a></li>
            <li><a href="../pages/contact.php" class="text-white px-4 py-2 rounded-lg hover:bg-purple-700 hover:bg-opacity-50 transition duration-300">Contact</a></li>
            <li><a href="logout.php" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-500 transition duration-300 font-semibold">Logout</a></li>
        </ul>
    </nav>

    <div class="max-w-7xl mx-auto py-12 px-4">
        <div class="bg-gradient-to-r from-purple-800 to-indigo-900 text-white p-8 rounded-2xl shadow-xl mb-8 border border-purple-700">
            <h1 class="text-4xl font-bold mb-4">Welcome back, <?php echo htmlspecialchars($user['name']); ?>! <svg class="w-10 h-10 inline text-yellow-300" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 2L15.09 10.26H24L17.45 15.52L20.54 23.78L12 18.52L3.46 23.78L6.55 15.52L0 10.26H8.91L12 2Z" fill="currentColor"/></svg></h1>
            <p class="text-xl opacity-90">Great to see you again. Ready to explore our amazing products?</p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-8 mb-8">
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 shadow-xl rounded-2xl p-6 hover:shadow-2xl transition duration-300 border border-purple-700">
                <div class="flex items-center mb-4">
                    <div class="bg-purple-800 p-3 rounded-full mr-4">
                        <svg class="w-6 h-6 text-purple-300" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" fill="currentColor"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white">Profile Info</h3>
                </div>
                <div class="space-y-2">
                    <p class="text-gray-300"><span class="font-semibold text-purple-200">Email:</span> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p class="text-gray-300"><span class="font-semibold text-purple-200">Class:</span> <?php echo htmlspecialchars($user['class']); ?></p>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 shadow-xl rounded-2xl p-6 hover:shadow-2xl transition duration-300 border border-purple-700">
                <div class="flex items-center mb-4">
                    <div class="bg-indigo-800 p-3 rounded-full mr-4">
                        <svg class="w-6 h-6 text-indigo-300" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 18C5.9 18 5.01 18.9 5.01 20C5.01 21.1 5.9 22 7 22C8.1 22 9 21.1 9 20C9 18.9 8.1 18 7 18ZM1 2V4H3L6.6 11.59L5.24 14.04C5.09 14.32 5 14.65 5 15C5 16.1 5.9 17 7 17H19V15H7.42C7.27 15 7.15 14.85 7.15 14.7L7.42 14H15.55C16.3 14 16.96 13.59 17.3 12.97L20.88 6.5C21.05 6.23 21.2 5.9 21.2 5.5C21.2 4.95 20.75 4.5 20.2 4.5H5.21L4.27 2H1ZM17 18C15.9 18 15.01 18.9 15.01 20C15.01 21.1 15.9 22 17 22C18.1 22 19 21.1 19 20C19 18.9 18.1 18 17 18Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white">Quick Actions</h3>
                </div>
                <div class="space-y-3">
                    <a href="add_product.php" class="block bg-gradient-to-r from-green-600 to-teal-600 text-white py-2 px-4 rounded-lg hover:from-green-500 hover:to-teal-500 transition duration-300 text-center font-semibold">
                        Add Product
                    </a>
                    <a href="../pages/products.php" class="block bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-2 px-4 rounded-lg hover:from-purple-500 hover:to-indigo-500 transition duration-300 text-center font-semibold">
                        Browse Products
                    </a>
                    <a href="../pages/contact.php" class="block bg-gradient-to-r from-pink-600 to-purple-600 text-white py-2 px-4 rounded-lg hover:from-pink-500 hover:to-purple-500 transition duration-300 text-center font-semibold">
                        Contact Support
                    </a>
                </div>
            </div>
        </div>

        <!-- Product Management Section -->
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 shadow-xl rounded-2xl p-8 border border-purple-700 mt-8">
            <?php
            // Display success/error messages
            if (isset($_SESSION['success_message'])) {
                echo '<div class="bg-green-600 text-white p-4 rounded-lg mb-6 flex items-center">';
                echo '<svg class="w-6 h-6 mr-3" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">';
                echo '<path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>';
                echo '</svg>';
                echo htmlspecialchars($_SESSION['success_message']);
                echo '</div>';
                unset($_SESSION['success_message']);
            }

            if (isset($_SESSION['error_message'])) {
                echo '<div class="bg-red-600 text-white p-4 rounded-lg mb-6 flex items-center">';
                echo '<svg class="w-6 h-6 mr-3" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">';
                echo '<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>';
                echo '</svg>';
                echo htmlspecialchars($_SESSION['error_message']);
                echo '</div>';
                unset($_SESSION['error_message']);
            }
            ?>

            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="bg-red-800 p-3 rounded-full mr-4">
                        <svg class="w-6 h-6 text-red-300" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" fill="currentColor"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-white">Product Management</h2>
                </div>
                <a href="add_product.php" class="bg-gradient-to-r from-green-600 to-teal-600 text-white py-2 px-4 rounded-lg hover:from-green-500 hover:to-teal-500 transition duration-300 font-semibold">
                    Add New Product
                </a>
            </div>

            <?php
            // Fetch all products with category info
            $stmt = $pdo->query("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.created_at DESC");
            $products = $stmt->fetchAll();

            if (count($products) > 0) {
                echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">';
                foreach ($products as $product) {
                    echo '<div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-xl p-4 border border-gray-600 hover:border-red-500 transition duration-300">';
                    echo '<div class="flex justify-between items-start mb-3">';
                    echo '<h3 class="text-lg font-semibold text-white truncate">' . htmlspecialchars($product['name']) . '</h3>';
                    echo '<form method="POST" action="remove_product.php" class="ml-2" onsubmit="return confirm(\'Are you sure you want to remove this product?\')">';
                    echo '<input type="hidden" name="product_id" value="' . $product['id'] . '">';
                    echo '<button type="submit" class="text-red-400 hover:text-red-300 transition duration-200" title="Remove Product">';
                    echo '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">';
                    echo '<path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>';
                    echo '</svg>';
                    echo '</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '<div class="space-y-1 text-sm text-gray-300">';
                    echo '<p><span class="font-medium text-purple-300">Price:</span> $' . number_format($product['price'], 2) . '</p>';
                    echo '<p><span class="font-medium text-green-300">Stock:</span> ' . $product['amount'] . ' units</p>';
                    if (!empty($product['category_name'])) {
                        echo '<p><span class="font-medium text-blue-300">Category:</span> ' . htmlspecialchars($product['category_name']) . '</p>';
                    }
                    echo '</div>';
                    echo '<img src="' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '" class="w-full h-24 object-cover rounded-lg mt-3">';
                    echo '</div>';
                }
                echo '</div>';
            } else {
                echo '<div class="text-center py-12">';
                echo '<svg class="w-20 h-20 mx-auto mb-4 text-gray-400" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">';
                echo '<path d="M20 7h-4V5c0-.55-.45-1-1-1h-4c-.55 0-1 .45-1 1v2H4c-.55 0-1 .45-1 1s.45 1 1 1h1v11c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V9h1c.55 0 1-.45 1-1s-.45-1-1-1zM10 5h4v2h-4V5zM8 9h8v10H8V9z"/>';
                echo '</svg>';
                echo '<h3 class="text-xl font-semibold text-gray-300 mb-2">No Products Found</h3>';
                echo '<p class="text-gray-400 mb-6">You haven\'t added any products yet.</p>';
                echo '<a href="add_product.php" class="inline-block bg-gradient-to-r from-green-600 to-teal-600 text-white py-3 px-8 rounded-full font-semibold hover:from-green-500 hover:to-teal-500 transform hover:scale-105 transition duration-300 shadow-lg">Add Your First Product</a>';
                echo '</div>';
            }
            ?>
        </div>

        <div class="bg-gradient-to-br from-gray-800 to-gray-900 shadow-xl rounded-2xl p-8 border border-purple-700">
            <div class="flex items-center mb-6">
                <div class="bg-yellow-800 p-3 rounded-full mr-4">
                    <svg class="w-6 h-6 text-yellow-300" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 9.2h3V7H5zM5 5h5V3H5zm7 14h2v-2h-2zm4-6h-2v2h2zM5 21h14V7H5zm2-6h10v-2H7z" fill="currentColor"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-white">Recent Activity</h2>
            </div>
            <div class="text-center py-12">
                <svg class="w-20 h-20 mx-auto mb-4 text-indigo-300" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 18C5.9 18 5.01 18.9 5.01 20C5.01 21.1 5.9 22 7 22C8.1 22 9 21.1 9 20C9 18.9 8.1 18 7 18ZM1 2V4H3L6.6 11.59L5.24 14.04C5.09 14.32 5 14.65 5 15C5 16.1 5.9 17 7 17H19V15H7.42C7.27 15 7.15 14.85 7.15 14.7L7.42 14H15.55C16.3 14 16.96 13.59 17.3 12.97L20.88 6.5C21.05 6.23 21.2 5.9 21.2 5.5C21.2 4.95 20.75 4.5 20.2 4.5H5.21L4.27 2H1ZM17 18C15.9 18 15.01 18.9 15.01 20C15.01 21.1 15.9 22 17 22C18.1 22 19 21.1 19 20C19 18.9 18.1 18 17 18Z" fill="currentColor"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-300 mb-2">No Recent Activity</h3>
                <p class="text-gray-400 mb-6">You haven't made any purchases yet. Start exploring our amazing products!</p>
                <a href="../pages/products.php" class="inline-block bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-3 px-8 rounded-full font-semibold hover:from-purple-500 hover:to-indigo-500 transform hover:scale-105 transition duration-300 shadow-lg flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 18C5.9 18 5.01 18.9 5.01 20C5.01 21.1 5.9 22 7 22C8.1 22 9 21.1 9 20C9 18.9 8.1 18 7 18ZM1 2V4H3L6.6 11.59L5.24 14.04C5.09 14.32 5 14.65 5 15C5 16.1 5.9 17 7 17H19V15H7.42C7.27 15 7.15 14.85 7.15 14.7L7.42 14H15.55C16.3 14 16.96 13.59 17.3 12.97L20.88 6.5C21.05 6.23 21.2 5.9 21.2 5.5C21.2 4.95 20.75 4.5 20.2 4.5H5.21L4.27 2H1ZM17 18C15.9 18 15.01 18.9 15.01 20C15.01 21.1 15.9 22 17 22C18.1 22 19 21.1 19 20C19 18.9 18.1 18 17 18Z" fill="white"/>
                    </svg>
                    Start Shopping
                </a>
            </div>
        </div>
    </div>
</body>
</html>