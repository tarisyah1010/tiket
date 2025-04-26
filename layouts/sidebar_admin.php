<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKY TRIP</title>
    
    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Google Font (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f5f7fa;
        }

        /* Sidebar Styling */
        .sidebar-admin {
            width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            position: fixed;
            height: 100%;
            overflow-y: auto;
            transition: width 0.3s;
        }

        /* Logo */
        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo i {
            font-size: 24px;
            margin-right: 10px;
            color:rgb(75, 188, 26);
        }

        .logo h2 {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }

        /* Menu */
        .sidebar-admin a {
            display: flex;
            align-items: center;
            color: #ecf0f1;
            text-decoration: none;
            padding: 12px;
            margin: 6px 0;
            border-radius: 5px;
            transition: background 0.3s, padding-left 0.3s;
            font-size: 16px;
        }

        .sidebar-admin a i {
            margin-right: 12px;
            font-size: 18px;
        }

        .sidebar-admin a:hover {
            background-color: #34495e;
            padding-left: 15px;
        }

        /* Menu Aktif */
        .sidebar-admin a.active {
            background-color: #2980b9;
            font-weight: bold;
        }

        /* Tombol Logout */
        .sidebar-admin a.logout {
            color: #e74c3c;
            font-weight: bold;
        }

        .sidebar-admin a.logout:hover {
            background-color: #c0392b;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .sidebar-admin {
                width: 220px;
            }
        }

        @media (max-width: 576px) {
            .sidebar-admin {
                width: 200px;
            }

            .sidebar-admin a {
                font-size: 14px;
                padding: 10px;
            }
        }

        /* Content Styling */
        .content {
            margin-left: 260px;
            padding: 20px;
            flex: 1;
        }

        @media (max-width: 768px) {
            .content {
                margin-left: 220px;
            }
        }

        @media (max-width: 576px) {
            .content {
                margin-left: 200px;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar-admin">
        <!-- Logo -->
        <div class="logo">
            <i class="bi bi-airplane"></i>
            <h2>SKY TRIP</h2>
        </div>

        <!-- Menu -->
        <a href="/tiket/admin/index.php" class="menu-item"><i class="bi bi-house-door"></i> Dashboard</a>
        <a href="/tiket/admin/pengguna/" class="menu-item"><i class="bi bi-person"></i> Data Pengguna</a>
        <a href="/tiket/admin/maskapai/" class="menu-item"><i class="bi bi-airplane-engines"></i> Data Maskapai</a>
        <a href="/tiket/admin/kota/" class="menu-item"><i class="bi bi-geo-alt"></i> Data Kota</a>
        <a href="/tiket/admin/rute/" class="menu-item"><i class="bi bi-map"></i> Data Rute</a>
        <a href="/tiket/admin/jadwal/" class="menu-item"><i class="bi bi-calendar"></i> Jadwal Penerbangan</a>
        <a href="/tiket/admin/order/" class="menu-item"><i class="bi bi-ticket-perforated"></i> Deskripsi Tiket</a>
        <a href="/tiket/admin/order_tiket/" class="menu-item"><i class="bi bi-ticket-perforated"></i> Pemesanan Tiket</a>
        


        <!-- Logout -->
        <a href="/tiket/auth/login/index.php" class="logout" onclick="return confirm('Apakah Anda yakin ingin logout?')">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>

    <script>
        // Ambil URL halaman saat ini
        const currentLocation = window.location.href;
        
        // Ambil semua menu item
        const menuItems = document.querySelectorAll(".sidebar-admin a");

        // Loop melalui setiap menu dan tambahkan kelas "active" jika URL cocok
        menuItems.forEach(menu => {
            if (menu.href === currentLocation) {
                menu.classList.add("active");
            }
        });
    </script>

</body>
</html>
