<!DOCTYPE html>
<?php
session_start();
$isLoggedIn = isset($_SESSION['user']);
?>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-shop - Curated for the Bold</title>
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

        /* Hero */
        .hero-bg {
            background: radial-gradient(ellipse at 60% 40%, rgba(201,169,110,0.12) 0%, transparent 65%),
                        linear-gradient(160deg, #1a1713 0%, #0f0e0d 60%);
            position: relative; overflow: hidden;
        }
        .hero-bg::before {
            content: '';
            position: absolute; inset: 0;
            background-image: repeating-linear-gradient(0deg, transparent, transparent 39px, rgba(201,169,110,0.04) 40px),
                            repeating-linear-gradient(90deg, transparent, transparent 39px, rgba(201,169,110,0.04) 40px);
        }
        .hero-badge { background: rgba(201,169,110,0.12); border: 1px solid rgba(201,169,110,0.3); }
        .hero-cta { background: var(--accent); color: #0f0e0d; transition: all 0.3s ease; }
        .hero-cta:hover { background: #d4b87a; transform: translateY(-2px); box-shadow: 0 12px 30px rgba(201,169,110,0.3); }
        .hero-outline-btn { border: 1px solid rgba(240,235,227,0.3); color: var(--text); transition: all 0.3s ease; }
        .hero-outline-btn:hover { border-color: var(--accent); color: var(--accent); }

        /* Marquee */
        .marquee-track { display: flex; gap: 3rem; animation: marquee 28s linear infinite; white-space: nowrap; }
        @keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
        .marquee-wrapper { overflow: hidden; }

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
            <!-- Hero -->
            <section class="hero-bg relative py-24 md:py-36 px-6" aria-label="Hero">
                <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 items-center relative z-10">
                    <div>
                        <div class="hero-badge inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-medium tracking-widest uppercase mb-6">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span> New Collection 2024
                        </div>
                        <h1 class="text-5xl md:text-7xl font-light leading-[1.05] mb-6 serif">Welcome to Our<br><em style="color: var(--accent);">E-commerce Store</em></h1>
                        <p class="text-gray-400 text-lg leading-relaxed mb-10 max-w-md">Discover amazing products and shop with ease. Quality items at great prices, curated for those who appreciate craftsmanship.</p>
                        <div class="flex items-center gap-4 flex-wrap">
                            <a href="products.php" class="hero-cta px-8 py-4 text-sm font-semibold tracking-widest uppercase">Shop Now</a>
                            <a href="about.php" class="hero-outline-btn px-8 py-4 text-sm font-medium tracking-wider uppercase">Learn More</a>
                        </div>
                        <div class="flex items-center gap-8 mt-12 pt-12 border-t border-white/5">
                            <div>
                                <div class="text-3xl font-light serif" style="color:var(--accent)">500+</div>
                                <div class="text-xs text-gray-500 tracking-widest uppercase mt-1">Products</div>
                            </div>
                            <div class="w-px h-10" style="background:rgba(255,255,255,0.08)"></div>
                            <div>
                                <div class="text-3xl font-light serif" style="color:var(--accent)">12K+</div>
                                <div class="text-xs text-gray-500 tracking-widest uppercase mt-1">Happy Clients</div>
                            </div>
                            <div class="w-px h-10" style="background:rgba(255,255,255,0.08)"></div>
                            <div>
                                <div class="text-3xl font-light serif" style="color:var(--accent)">98%</div>
                                <div class="text-xs text-gray-500 tracking-widest uppercase mt-1">Satisfaction</div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center justify-center">
                        <div class="relative w-80 h-96">
                            <!-- Decorative product mockup -->
                            <div class="absolute inset-0 rounded-2xl overflow-hidden" style="background: linear-gradient(135deg,#252220,#1c1a18); border:1px solid rgba(201,169,110,0.15);">
                                <div class="absolute inset-0 flex items-center justify-center opacity-10">
                                    <svg width="200" height="200" viewbox="0 0 200 200" fill="none">
                                        <circle cx="100" cy="100" r="80" stroke="#c9a96e" stroke-width="1"/>
                                        <circle cx="100" cy="100" r="50" stroke="#c9a96e" stroke-width="0.5"/>
                                        <line x1="20" y1="100" x2="180" y2="100" stroke="#c9a96e" stroke-width="0.5"/>
                                        <line x1="100" y1="20" x2="100" y2="180" stroke="#c9a96e" stroke-width="0.5"/>
                                    </svg>
                                </div>
                                <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/80 to-transparent">
                                    <div class="text-xs text-gray-400 tracking-widest uppercase mb-1">Featured</div>
                                    <div class="text-lg font-light serif">Premium Collection</div>
                                    <div class="text-amber-400 font-medium mt-1">Starting from $99</div>
                                </div>
                            </div>
                            <div class="absolute -top-4 -right-4 w-20 h-20 rounded-xl flex items-center justify-center" style="background:var(--accent); color:#0f0e0d;">
                                <div class="text-center">
                                    <div class="text-xs font-bold">NEW</div>
                                    <div class="text-xl font-light serif">24</div>
                                    <div class="text-xs">items</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Marquee -->
            <div class="py-4 overflow-hidden border-y border-white/5" style="background:var(--surface)">
                <div class="marquee-wrapper">
                    <div class="marquee-track text-xs tracking-[0.3em] uppercase" style="color:var(--muted)">
                        <span>Free Shipping Over $75</span><span style="color:var(--accent)">✦</span>
                        <span>New Arrivals Weekly</span><span style="color:var(--accent)">✦</span>
                        <span>Sustainable Materials</span><span style="color:var(--accent)">✦</span>
                        <span>Easy Returns</span><span style="color:var(--accent)">✦</span>
                        <span>Premium Quality</span><span style="color:var(--accent)">✦</span>
                        <span>Free Shipping Over $75</span><span style="color:var(--accent)">✦</span>
                        <span>New Arrivals Weekly</span><span style="color:var(--accent)">✦</span>
                        <span>Sustainable Materials</span><span style="color:var(--accent)">✦</span>
                        <span>Easy Returns</span><span style="color:var(--accent)">✦</span>
                        <span>Premium Quality</span><span style="color:var(--accent)">✦</span>
                    </div>
                </div>
            </div>

            <!-- About / USP -->
            <section class="py-20 px-6" aria-label="About">
                <div class="max-w-7xl mx-auto">
                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="text-center fade-in">
                            <div class="w-12 h-12 rounded-full mx-auto mb-5 flex items-center justify-center" style="background:rgba(201,169,110,0.1); border:1px solid rgba(201,169,110,0.25);">
                                <i data-lucide="package" style="width:20px;height:20px;color:var(--accent);"></i>
                            </div>
                            <h3 class="text-lg font-light serif mb-2">Free Shipping</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">Complimentary delivery on all orders over $75. Fast and reliable worldwide.</p>
                        </div>
                        <div class="text-center fade-in">
                            <div class="w-12 h-12 rounded-full mx-auto mb-5 flex items-center justify-center" style="background:rgba(201,169,110,0.1); border:1px solid rgba(201,169,110,0.25);">
                                <i data-lucide="refresh-cw" style="width:20px;height:20px;color:var(--accent);"></i>
                            </div>
                            <h3 class="text-lg font-light serif mb-2">Easy Returns</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">Not in love? Return within 30 days, no questions asked. Hassle-free process.</p>
                        </div>
                        <div class="text-center fade-in">
                            <div class="w-12 h-12 rounded-full mx-auto mb-5 flex items-center justify-center" style="background:rgba(201,169,110,0.1); border:1px solid rgba(201,169,110,0.25);">
                                <i data-lucide="shield-check" style="width:20px;height:20px;color:var(--accent);"></i>
                            </div>
                            <h3 class="text-lg font-light serif mb-2">Secure Shopping</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">Your data is always protected. Shop with confidence using encrypted checkout.</p>
                        </div>
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
                        <p class="text-xs text-gray-600 leading-relaxed">Premium fashion curated for those who appreciate craftsmanship and individuality.</p>
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