<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Ecommerce</title>
    <script src="../assets/css/tailwind.css"></script>
</head>
<body class="bg-gradient-to-br from-purple-800 to-indigo-900 min-h-screen flex items-center justify-center">
    <div class="bg-gradient-to-br from-gray-800 to-gray-900 p-8 rounded-lg shadow-lg w-full max-w-md border border-purple-700">
        <h2 class="text-2xl font-bold text-center mb-6 text-purple-200 uppercase tracking-wider">Sign Up</h2>
        <form action="../controller/signupcontroller.php" method="post" class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Name</label>
                <input id="name" type="text" name="name" placeholder="Enter your name" required
                       class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white placeholder-gray-400">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                <input id="email" type="email" name="email" placeholder="Enter your email" required
                       class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white placeholder-gray-400">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                <input id="password" type="password" name="password" placeholder="Enter your password" required
                       class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white placeholder-gray-400">
            </div>
            <button type="submit" name="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-2 px-4 rounded-md hover:from-purple-500 hover:to-indigo-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition duration-200 font-bold tracking-wide">
                Sign Up
            </button>
        </form>
        <p class="text-center mt-4 text-sm text-gray-400">
            Already have an account? <a href="login.php" class="text-purple-300 hover:text-purple-200 hover:underline">Login</a>
        </p>
    </div>
</body>
</html>