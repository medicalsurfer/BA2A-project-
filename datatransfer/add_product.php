<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Ecommerce</title>
    <script src="../assets/css/tailwind.css"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen">
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Include database connection
require_once "../database/connection.php";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);
    $amount = trim($_POST['amount']);
    $category_id = trim($_POST['category_id']);

    // Handle image upload
    $image_path = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = "../uploads/";
        $file_name = basename($_FILES['image']['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Validate file type
        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($file_ext, $allowed_exts)) {
            $error = "Only JPG, JPEG, PNG, GIF, and WebP images are allowed.";
        } elseif ($_FILES['image']['size'] > 5 * 1024 * 1024) { // 5MB limit
            $error = "Image size must be less than 5MB.";
        } else {
            // Generate unique filename
            $unique_name = uniqid() . '_' . time() . '.' . $file_ext;
            $target_path = $upload_dir . $unique_name;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                $image_path = "uploads/" . $unique_name;
            } else {
                $error = "Failed to upload image.";
            }
        }
    } elseif (!empty($_POST['image_url'])) {
        // Use URL if no file uploaded
        $image_path = trim($_POST['image_url']);
    }

    // Basic validation
    if (empty($name) || empty($price) || empty($image_path) || empty($description) || empty($amount)) {
        $error = "All fields are required.";
    } elseif (!is_numeric($price) || $price <= 0) {
        $error = "Please enter a valid price.";
    } elseif (!is_numeric($amount) || $amount < 0) {
        $error = "Please enter a valid amount (0 or greater).";
    } elseif (empty($category_id)) {
        $error = "Please select a category.";
    } else {
        // Insert product into database
        $stmt = $pdo->prepare("INSERT INTO products (name, price, image, description, amount, category_id) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$name, $price, $image_path, $description, $amount, $category_id])) {
            $success = "Product added successfully!";
            // Clear form data
            $name = $price = $image_path = $description = $amount = $category_id = "";
        } else {
            $error = "Error adding product.";
        }
    }
}

// Fetch categories for dropdown
$stmt = $pdo->query("SELECT * FROM categories ORDER BY name");
$categories = $stmt->fetchAll();
?>

    <nav class="bg-gradient-to-r from-purple-800 to-indigo-900 w-full flex items-center justify-between px-5 py-3 shadow-lg">
        <a href="../pages/home.php" class="text-white font-bold text-xl hover:text-purple-300 transition duration-300">Ecommerce</a>
        <ul class="flex space-x-6">
            <li><a href="../pages/home.php" class="text-white px-4 py-2 rounded-lg hover:bg-purple-700 hover:bg-opacity-50 transition duration-300">Home</a></li>
            <li><a href="../pages/about.php" class="text-white px-4 py-2 rounded-lg hover:bg-purple-700 hover:bg-opacity-50 transition duration-300">About</a></li>
            <li><a href="../pages/products.php" class="text-white px-4 py-2 rounded-lg hover:bg-purple-700 hover:bg-opacity-50 transition duration-300">Products</a></li>
            <li><a href="../pages/contact.php" class="text-white px-4 py-2 rounded-lg hover:bg-purple-700 hover:bg-opacity-50 transition duration-300">Contact</a></li>
            <li><a href="dashboard.php" class="bg-yellow-500 text-black px-4 py-2 rounded-lg hover:bg-yellow-400 transition duration-300 font-semibold">Dashboard</a></li>
            <li><a href="logout.php" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-500 transition duration-300 font-semibold">Logout</a></li>
        </ul>
    </nav>

    <div class="max-w-2xl mx-auto py-12 px-4">
        <div class="bg-gradient-to-r from-purple-800 to-indigo-900 text-white p-8 rounded-2xl shadow-xl mb-8 border border-purple-700">
            <h1 class="text-4xl font-bold mb-4 flex items-center">
                <svg class="w-10 h-10 mr-3 text-green-300" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                </svg>
                Add New Product
            </h1>
            <p class="text-xl opacity-90">Add a new product to your ecommerce store.</p>
        </div>

        <div class="bg-gradient-to-br from-gray-800 to-gray-900 shadow-xl rounded-2xl p-8 border border-purple-700">
            <?php if (isset($error)): ?>
                <div class="bg-red-600 text-white p-4 rounded-lg mb-6">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($success)): ?>
                <div class="bg-green-600 text-white p-4 rounded-lg mb-6">
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data" class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Product Name</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name ?? ''); ?>" required
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200 text-white placeholder-gray-400">
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Price ($)</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" value="<?php echo htmlspecialchars($price ?? ''); ?>" required
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200 text-white placeholder-gray-400">
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-300 mb-2">Product Image</label>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">Upload from Computer:</label>
                            <input type="file" id="image_file" name="image" accept="image/*"
                                   class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200 text-white file:bg-purple-600 file:text-white file:border-none file:rounded-md file:px-3 file:py-1 file:mr-3 file:cursor-pointer">
                        </div>
                        <div class="text-center text-gray-400 text-sm">OR</div>
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">Use Image URL:</label>
                            <input type="url" id="image_url" name="image_url" value="<?php echo htmlspecialchars($image_path ?? ''); ?>"
                                   class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200 text-white placeholder-gray-400"
                                   placeholder="https://example.com/image.jpg">
                        </div>
                    </div>
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                    <select id="category_id" name="category_id" required
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200 text-white">
                        <option value="">Select a category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>" <?php echo (isset($category_id) && $category_id == $category['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($category['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                    <textarea id="description" name="description" rows="4" required
                              class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200 text-white placeholder-gray-400 resize-none"><?php echo htmlspecialchars($description ?? ''); ?></textarea>
                </div>

                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-300 mb-2">Stock Amount</label>
                    <input type="number" id="amount" name="amount" min="0" value="<?php echo htmlspecialchars($amount ?? ''); ?>" required
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200 text-white placeholder-gray-400"
                           placeholder="Enter stock quantity">
                </div>

                <div class="flex space-x-4">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-green-600 to-teal-600 text-white py-3 px-6 rounded-lg font-semibold hover:from-green-500 hover:to-teal-500 transform hover:scale-105 transition duration-300 shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                        </svg>
                        Add Product
                    </button>
                    <a href="dashboard.php" class="flex-1 bg-gradient-to-r from-gray-600 to-gray-700 text-white py-3 px-6 rounded-lg font-semibold hover:from-gray-500 hover:to-gray-600 transition duration-300 text-center flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                        </svg>
                        Back to Dashboard
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>