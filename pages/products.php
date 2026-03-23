<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - ShopLux</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script src="../assets/css/tailwind.css"></script>
    <style>
        :root {
            --primary-gold: #D4AF37;
            --secondary-gold: #FFD700;
            --dark-bg: #0A0A0A;
            --dark-card: #1A1A1A;
            --text-primary: #FFFFFF;
            --text-secondary: #E5E5E5;
            --accent: #2A2A2A;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--dark-bg);
            color: var(--text-primary);
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Cormorant Garamond', serif;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .product-card {
            background: var(--dark-card);
            border: 1px solid rgba(212, 175, 55, 0.2);
            transition: all 0.3s ease;
        }

        .product-card:hover {
            border-color: var(--primary-gold);
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.1);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .search-input {
            background: var(--accent);
            border: 1px solid rgba(212, 175, 55, 0.3);
            color: var(--text-primary);
        }

        .search-input:focus {
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.1);
        }

        .category-filter {
            background: var(--accent);
            border: 1px solid rgba(212, 175, 55, 0.2);
            color: var(--text-secondary);
            transition: all 0.3s ease;
        }

        .category-filter:hover,
        .category-filter.active {
            background: var(--primary-gold);
            color: var(--dark-bg);
            border-color: var(--primary-gold);
        }

        .btn-primary {
            background: var(--primary-gold);
            color: var(--dark-bg);
            border: 1px solid var(--primary-gold);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--secondary-gold);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: transparent;
            color: var(--primary-gold);
            border: 1px solid var(--primary-gold);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: var(--primary-gold);
            color: var(--dark-bg);
        }

        .mobile-menu {
            background: var(--dark-bg);
            border-top: 1px solid rgba(212, 175, 55, 0.2);
        }

        .footer-link {
            color: var(--text-secondary);
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: var(--primary-gold);
        }
    </style>
</head>
<body>
    <?php
    session_start();
    $isLoggedIn = isset($_SESSION['user']);

    // Include database connection
    require_once "../database/connection.php";

    // Handle category filter
    $category_filter = isset($_GET['category']) ? (int)$_GET['category'] : 0;

    // Fetch categories for filter
    $stmt = $pdo->query("SELECT * FROM categories ORDER BY name");
    $categories = $stmt->fetchAll();

    // Fetch products from database with category join
    $query = "SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id";
    $params = [];
    if ($category_filter > 0) {
        $query .= " WHERE p.category_id = ?";
        $params[] = $category_filter;
    }
    $query .= " ORDER BY p.created_at DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $products = $stmt->fetchAll();
    ?>

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-black/90 backdrop-blur-md border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="home.php" class="text-2xl font-bold text-white hover:text-yellow-400 transition-colors duration-300">
                        Shop<span class="text-yellow-400">Lux</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="home.php" class="text-white hover:text-yellow-400 transition-colors duration-300 font-medium">Home</a>
                    <a href="about.php" class="text-white hover:text-yellow-400 transition-colors duration-300 font-medium">About</a>
                    <a href="products.php" class="text-yellow-400 font-medium">Products</a>
                    <a href="contact.php" class="text-white hover:text-yellow-400 transition-colors duration-300 font-medium">Contact</a>
                </div>

                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center space-x-4">
                    <?php if ($isLoggedIn): ?>
                        <a href="../datatransfer/dashboard.php" class="btn-primary px-6 py-2 rounded-full font-medium">
                            Dashboard
                        </a>
                    <?php else: ?>
                        <a href="../datatransfer/login.php" class="text-white hover:text-yellow-400 transition-colors duration-300 font-medium">
                            Login
                        </a>
                        <a href="../datatransfer/signup.php" class="btn-primary px-6 py-2 rounded-full font-medium">
                            Sign Up
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-white hover:text-yellow-400 transition-colors duration-300">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div id="mobile-menu" class="mobile-menu hidden md:hidden pb-4">
                <div class="flex flex-col space-y-4 pt-4">
                    <a href="home.php" class="text-white hover:text-yellow-400 transition-colors duration-300 font-medium">Home</a>
                    <a href="about.php" class="text-white hover:text-yellow-400 transition-colors duration-300 font-medium">About</a>
                    <a href="products.php" class="text-yellow-400 font-medium">Products</a>
                    <a href="contact.php" class="text-white hover:text-yellow-400 transition-colors duration-300 font-medium">Contact</a>
                    <div class="border-t border-white/10 pt-4 space-y-4">
                        <?php if ($isLoggedIn): ?>
                            <a href="../datatransfer/dashboard.php" class="btn-primary px-6 py-2 rounded-full font-medium text-center block">
                                Dashboard
                            </a>
                        <?php else: ?>
                            <a href="../datatransfer/login.php" class="text-white hover:text-yellow-400 transition-colors duration-300 font-medium block">
                                Login
                            </a>
                            <a href="../datatransfer/signup.php" class="btn-primary px-6 py-2 rounded-full font-medium text-center block">
                                Sign Up
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-24 pb-12 bg-gradient-to-br from-black via-gray-900 to-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 fade-in">
                Our <span class="text-yellow-400">Products</span>
            </h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto fade-in">
                Discover our curated collection of premium products, carefully selected for quality and style.
            </p>
        </div>
    </section>

    <!-- Search and Filter Section -->
    <section class="py-8 bg-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-900/50 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                <div class="flex flex-col lg:flex-row gap-6 items-center">
                    <!-- Search Input -->
                    <div class="flex-1 w-full">
                        <div class="relative">
                            <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                            <input type="text" id="searchInput" placeholder="Search products..."
                                   class="search-input w-full pl-10 pr-4 py-3 rounded-xl focus:outline-none">
                        </div>
                    </div>

                    <!-- Category Filters -->
                    <div class="flex flex-wrap gap-3 items-center">
                        <span class="text-yellow-400 font-medium mr-2">Category:</span>
                        <a href="products.php" class="category-filter px-4 py-2 rounded-full text-sm font-medium <?php echo $category_filter == 0 ? 'active' : ''; ?>">
                            All
                        </a>
                        <?php foreach ($categories as $category): ?>
                            <a href="products.php?category=<?php echo $category['id']; ?>"
                               class="category-filter px-4 py-2 rounded-full text-sm font-medium <?php echo $category_filter == $category['id'] ? 'active' : ''; ?>">
                                <?php echo htmlspecialchars($category['name']); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="py-16 bg-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <?php foreach ($products as $product): ?>
                <div class="product-card rounded-2xl overflow-hidden fade-in">
                    <div class="relative overflow-hidden">
                      <img src="<?php echo htmlspecialchars($product['image']); ?>"
                        alt="<?php echo htmlspecialchars($product['name']); ?>"
                        class="product-image"
                        onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'300\' height=\'200\'%3E%3Crect width=\'300\' height=\'200\' fill=\'%23cccccc\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' dominant-baseline=\'middle\' text-anchor=\'middle\' font-size=\'16\' fill=\'%23666\'%3ENo Image%3C/text%3E%3C/svg%3E'">
                        <div class="absolute top-4 right-4">
                            <span class="bg-yellow-400 text-black px-3 py-1 rounded-full text-xs font-bold">
                                NEW
                            </span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2 line-clamp-2">
                            <?php echo htmlspecialchars($product['name']); ?>
                        </h3>

                        <?php if (!empty($product['category_name'])): ?>
                            <div class="inline-block bg-yellow-400/20 text-yellow-400 px-3 py-1 rounded-full text-xs font-medium mb-3">
                                <?php echo htmlspecialchars($product['category_name']); ?>
                            </div>
                        <?php endif; ?>

                        <p class="text-gray-300 text-sm mb-4 line-clamp-2">
                            <?php echo htmlspecialchars($product['description']); ?>
                        </p>

                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <div class="text-xs text-gray-400 mb-1">Price</div>
                                <span class="text-2xl font-bold text-yellow-400">
                                    $<?php echo number_format($product['price'], 2); ?>
                                </span>
                            </div>
                            <div class="text-right">
                                <div class="text-xs text-gray-400 mb-1">Stock</div>
                                <div class="text-lg font-semibold text-white">
                                    <?php echo $product['amount']; ?>
                                </div>
                            </div>
                        </div>

                        <button class="w-full btn-primary py-3 rounded-xl font-medium <?php echo $product['amount'] <= 0 ? 'opacity-50 cursor-not-allowed' : ''; ?>"
                                <?php echo $product['amount'] <= 0 ? 'disabled' : ''; ?>>
                            <?php echo $product['amount'] <= 0 ? 'OUT OF STOCK' : 'VIEW DETAILS'; ?>
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <?php if (empty($products)): ?>
            <div class="text-center py-16">
                <i data-lucide="package" class="w-16 h-16 text-gray-600 mx-auto mb-4"></i>
                <h3 class="text-2xl font-bold text-white mb-2">No products found</h3>
                <p class="text-gray-400">Try adjusting your search or category filter.</p>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black border-t border-white/10 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <a href="home.php" class="text-2xl font-bold text-white mb-4 block">
                        Shop<span class="text-yellow-400">Lux</span>
                    </a>
                    <p class="text-gray-300 mb-6 max-w-md">
                        Your premier destination for luxury shopping. Discover exceptional products curated with care and delivered with excellence.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="footer-link">
                            <i data-lucide="twitter" class="w-6 h-6"></i>
                        </a>
                        <a href="#" class="footer-link">
                            <i data-lucide="instagram" class="w-6 h-6"></i>
                        </a>
                        <a href="#" class="footer-link">
                            <i data-lucide="facebook" class="w-6 h-6"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="home.php" class="footer-link">Home</a></li>
                        <li><a href="about.php" class="footer-link">About</a></li>
                        <li><a href="products.php" class="footer-link">Products</a></li>
                        <li><a href="contact.php" class="footer-link">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Contact Info</h4>
                    <div class="space-y-3 text-gray-300">
                        <p class="flex items-center">
                            <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-yellow-400"></i>
                            123 Commerce St, Shop City, SC 12345
                        </p>
                        <p class="flex items-center">
                            <i data-lucide="phone" class="w-4 h-4 mr-2 text-yellow-400"></i>
                            +1 (555) 123-4567
                        </p>
                        <p class="flex items-center">
                            <i data-lucide="mail" class="w-4 h-4 mr-2 text-yellow-400"></i>
                            support@shoplux.com
                        </p>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/10 mt-12 pt-8 text-center">
                <p class="text-gray-400">&copy; 2024 ShopLux. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!mobileMenuButton.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.add('hidden');
            }
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const products = document.querySelectorAll('.product-card');

            products.forEach(product => {
                const title = product.querySelector('h3').textContent.toLowerCase();
                const description = product.querySelector('p').textContent.toLowerCase();

                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        });

        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        // Observe all fade-in elements
        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html></content>
<parameter name="filePath">c:\xampp\htdocs\php1\ecommerce\pages\products_new.php