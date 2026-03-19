<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - E-shop</title>
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&amp;family=DM+Sans:wght@300;400;500;600&amp;display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0f0e0d;
            --surface: #1c1a18;
            --text: #f0ebe3;
            --accent: #c9a96e;
            --muted: #6b6560;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { height: 100%; font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text); }
        body { overflow-x: hidden; }
        .app-wrapper { min-height: 100%; display: flex; flex-direction: column; }

        h1, h2, h3, .serif { font-family: 'Cormorant Garamond', serif; }

        /* Nav */
        .nav { position: sticky; top: 0; z-index: 100; background: rgba(15,14,13,0.85); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(201,169,110,0.15); }

        /* Section fade-in */
        .fade-in { opacity: 0; transform: translateY(24px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .fade-in.visible { opacity: 1; transform: translateY(0); }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--muted); border-radius: 3px; }

        /* Footer */
        .footer-bg { background: #080807; border-top: 1px solid rgba(201,169,110,0.12); }

        /* Gold line */
        .gold-line { height: 1px; background: linear-gradient(90deg, transparent, var(--accent), transparent); }
    </style>
</head>
<body class="h-full">
    <div class="app-wrapper">
        <!-- Navigation -->
        <nav class="nav" role="navigation" aria-label="Main navigation">
            <div class="max-w-7xl mx-auto px-6 flex items-center justify-between h-16">
                <div class="flex items-center gap-8">
                    <a href="home.php" class="text-2xl font-light serif tracking-[0.2em]" style="color: var(--accent);">E-SHOP</a>
                    <div class="hidden md:flex items-center gap-6 text-sm text-gray-400">
                        <a href="home.php" class="hover:text-white transition-colors">Home</a>
                        <a href="about.php" class="hover:text-white transition-colors">About</a>
                        <a href="products.php" class="hover:text-white transition-colors">Shop</a>
                        <a href="contact.php" class="hover:text-white transition-colors">Contact</a>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <button onclick="toggleSearch()" class="text-gray-400 hover:text-white transition-colors p-2" aria-label="Search">
                        <i data-lucide="search" style="width:18px;height:18px;"></i>
                    </button>
                    <div class="hidden md:flex gap-2">
                        <?php if ($isLoggedIn): ?>
                        <a href="../datatransfer/dashboard.php" class="text-sm text-gray-400 hover:text-white px-3 py-1 transition-colors border-l border-white/10 pl-4">Dashboard</a>
                        <a href="../datatransfer/logout.php" class="text-sm text-gray-400 hover:text-red-400 px-3 py-1 transition-colors border-l border-white/10 pl-4">Logout</a>
                        <?php else: ?>
                        <a href="../datatransfer/login.php" class="text-sm text-gray-400 hover:text-white px-3 py-1 transition-colors border-l border-white/10 pl-4">Sign In</a>
                        <?php endif; ?>
                    </div>
                    <button class="md:hidden text-gray-400 hover:text-white p-2" onclick="toggleMobileMenu()" aria-label="Menu">
                        <i data-lucide="menu" style="width:18px;height:18px;"></i>
                    </button>
                </div>
            </div>
            <!-- Search Bar -->
            <div id="searchBar" class="hidden border-t border-white/5 px-6 py-3">
                <div class="max-w-2xl mx-auto relative">
                    <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500" style="width:16px;height:16px;"></i>
                    <input type="text" id="searchInput" placeholder="Search products..." class="w-full bg-black/30 border border-white/10 pl-9 pr-4 py-2.5 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-amber-500/50 rounded-none" aria-label="Search products">
                </div>
            </div>
            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden border-t border-white/5 px-6 py-4 flex flex-col gap-4 text-sm text-gray-400">
                <a href="home.php" class="text-left hover:text-white">Home</a>
                <a href="about.php" class="text-left hover:text-white">About</a>
                <a href="products.php" class="text-left hover:text-white">Shop</a>
                <a href="contact.php" class="text-left hover:text-white">Contact</a>
                <?php if ($isLoggedIn): ?>
                <a href="../datatransfer/dashboard.php" class="text-left hover:text-white">Dashboard</a>
                <a href="../datatransfer/logout.php" class="text-left hover:text-red-400">Logout</a>
                <?php else: ?>
                <a href="../datatransfer/login.php" class="text-left hover:text-white">Sign In</a>
                <?php endif; ?>
            </div>
        </nav>

        <main class="flex-1">
            <!-- About Section -->
            <section class="py-20 px-6" aria-label="About Us">
                <div class="max-w-4xl mx-auto">
                    <div class="mb-16 fade-in">
                        <div class="text-xs tracking-[0.3em] uppercase mb-4" style="color:var(--accent)">
                            Our Story
                        </div>
                        <h1 class="text-5xl md:text-6xl font-light serif mb-8">About E-shop</h1>
                        <p class="text-lg text-gray-400 leading-relaxed mb-6">Founded in 2024, E-shop emerged from a simple belief: quality products shouldn't compromise on accessibility or customer satisfaction. We curate the finest items from trusted manufacturers worldwide.</p>
                        <p class="text-lg text-gray-400 leading-relaxed">Every product in our collection is handpicked for its quality, value, and positive impact. We believe that great shopping is about finding the right items that fit your lifestyle and budget.</p>
                    </div>
                    <div class="gold-line my-12"></div>
                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="fade-in">
                            <div class="text-4xl font-light serif mb-3" style="color:var(--accent)">
                                500+
                            </div>
                            <div class="text-sm text-gray-400 mb-3">
                                Quality Products
                            </div>
                            <p class="text-xs text-gray-600 leading-relaxed">Our carefully curated collection spans electronics, fashion, home goods, and more.</p>
                        </div>
                        <div class="fade-in">
                            <div class="text-4xl font-light serif mb-3" style="color:var(--accent)">
                                12K+
                            </div>
                            <div class="text-sm text-gray-400 mb-3">
                                Happy Customers
                            </div>
                            <p class="text-xs text-gray-600 leading-relaxed">Our community spans across the globe, each member part of our growing customer family.</p>
                        </div>
                        <div class="fade-in">
                            <div class="text-4xl font-light serif mb-3" style="color:var(--accent)">
                                100%
                            </div>
                            <div class="text-sm text-gray-400 mb-3">
                                Customer Satisfaction
                            </div>
                            <p class="text-xs text-gray-600 leading-relaxed">We stand behind every purchase with our commitment to quality and service excellence.</p>
                        </div>
                    </div>
                    <div class="gold-line my-12"></div>
                    <div class="bg-white/5 border border-white/10 p-8 rounded-lg fade-in">
                        <h3 class="text-2xl font-light serif mb-4">Our Mission</h3>
                        <p class="text-gray-400 leading-relaxed">To provide exceptional shopping experiences by connecting quality-conscious consumers with premium products, creating a marketplace where value, trust, and satisfaction converge.</p>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="footer-bg px-6 py-12 mt-auto" role="contentinfo">
            <div class="max-w-7xl mx-auto">
                <div class="grid md:grid-cols-4 gap-8 mb-10">
                    <div>
                        <div class="text-2xl font-light serif tracking-[0.2em] mb-4" style="color:var(--accent);">E-SHOP</div>
                        <p class="text-xs text-gray-600 leading-relaxed">Premium products curated for those who appreciate quality and value.</p>
                    </div>
                    <div>
                        <div class="text-xs tracking-widest uppercase text-gray-500 mb-4">Shop</div>
                        <div class="space-y-2">
                            <div><a href="products.php" class="text-sm text-gray-600 hover:text-gray-300 transition-colors">Collections</a></div>
                            <div><a href="products.php" class="text-sm text-gray-600 hover:text-gray-300 transition-colors">New Arrivals</a></div>
                        </div>
                    </div>
                    <div>
                        <div class="text-xs tracking-widest uppercase text-gray-500 mb-4">Help</div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <div><a href="contact.php" class="hover:text-gray-300 transition-colors">Contact Us</a></div>
                            <div>Shipping & Returns</div>
                            <div>Size Guide</div>
                        </div>
                    </div>
                    <div>
                        <div class="text-xs tracking-widest uppercase text-gray-500 mb-4">Follow</div>
                        <div class="flex gap-4">
                            <button class="text-gray-600 hover:text-gray-300 transition-colors" aria-label="Instagram">
                                <i data-lucide="instagram" style="width:18px;height:18px;"></i>
                            </button>
                            <button class="text-gray-600 hover:text-gray-300 transition-colors" aria-label="Twitter">
                                <i data-lucide="twitter" style="width:18px;height:18px;"></i>
                            </button>
                            <button class="text-gray-600 hover:text-gray-300 transition-colors" aria-label="Facebook">
                                <i data-lucide="facebook" style="width:18px;height:18px;"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="gold-line mb-6"></div>
                <div class="flex flex-wrap justify-between items-center gap-4 text-xs text-gray-600">
                    <span>© 2024 E-shop. All rights reserved.</span>
                    <span>Privacy Policy · Terms of Service</span>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Mobile menu toggle
        function toggleMobileMenu() {
            document.getElementById('mobileMenu')?.classList.toggle('hidden');
        }

        // Search toggle
        function toggleSearch() {
            const bar = document.getElementById('searchBar');
            bar.classList.toggle('hidden');
            if (!bar.classList.contains('hidden')) {
                document.getElementById('searchInput')?.focus();
            }
        }

        // Initialize Lucide icons
        document.addEventListener('DOMContentLoaded', () => {
            // Restore user session
            <?php
            session_start();
            $isLoggedIn = isset($_SESSION['user']);
            ?>

            // Observe fade-in elements
            const fadeObserver = new IntersectionObserver((entries) => {
                entries.forEach(e => {
                    if (e.isIntersecting) e.target.classList.add('visible');
                });
            }, { threshold: 0.1 });
            document.querySelectorAll('.fade-in').forEach(el => fadeObserver.observe(el));

            // Initialize icons
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
</body>
</html>