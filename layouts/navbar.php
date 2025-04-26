<?php
require 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sky Trip</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-200 shadow-md py-4 px-6">
        <div class="container mx-auto flex items-center justify-between">
            <!-- Navbar Brand -->
            <div class="text-xl font-bold text-blue-800">
                <a href="index.php">Sky Trip</a>
            </div>

            <!-- Navbar Menu -->
            <div class="hidden md:flex space-x-6">
                <a href="index.php" class="text-blue-900 hover:text-blue-700 transition">Home</a>
                <a href="cart.php" class="text-blue-900 hover:text-blue-700 transition">Cart</a>
                <a href="riwayat-transaksi.php" class="text-blue-900 hover:text-blue-700 transition">History Transaksi</a>
            </div>

            <!-- Authentication Buttons -->
            <div class="flex items-center space-x-4">
                <?php if(isset($_SESSION['username'])) : ?>
                    <span class="text-blue-900">Halo, <?= $_SESSION['username']; ?></span>
                    <a href="logout.php" class="bg-red-400 text-white px-4 py-2 rounded hover:bg-red-500 transition">Logout</a>
                <?php else : ?>
                    <a href="auth/login/" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Login</a>
                    <a href="auth/register/" class="bg-green-400 text-white px-4 py-2 rounded hover:bg-green-500 transition">Register</a>
                <?php endif; ?>
            </div>

            <!-- Mobile Menu Button -->
            <button id="menu-toggle" class="md:hidden text-blue-900">
                ☰
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-blue-200 py-2 px-4">
            <a href="index.php" class="block py-2 text-blue-900 hover:text-blue-700 transition">Home</a>
            <a href="cart.php" class="block py-2 text-blue-900 hover:text-blue-700 transition">Cart</a>
            <a href="#" class="block py-2 text-blue-900 hover:text-blue-700 transition">History Transaksi</a>

            <div class="mt-4">
                <?php if(isset($_SESSION['username'])) : ?>
                    <span class="block py-2 text-blue-900">Halo, <?= $_SESSION['username']; ?></span>
                    <a href="logout.php" class="block text-red-500 hover:text-red-600 transition">Logout</a>
                <?php else : ?>
                    <a href="auth/login/" class="block py-2 text-blue-500 hover:text-blue-600 transition">Login</a>
                    <a href="auth/register/" class="block py-2 text-green-500 hover:text-green-600 transition">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>
