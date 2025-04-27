<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas</title>
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Layout */
        .container {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #2f4f4f;
            color: white;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar ul {
            list-style-type: none;
        }

        .sidebar ul li {
            margin-bottom: 20px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            display: block;
        }

        .sidebar ul li a:hover {
            background-color: #3b6363;
            padding: 5px;
            border-radius: 5px;
        }

        /* Main content */
        .main-content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f0f8ff;
            overflow-y: auto;
        }

        section {
            margin-bottom: 30px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="layouts/sidebar.php">
            <h2>Dashboard Petugas</h2>
            <ul>
        <li><a href="/tiket/petugas/maskapai/index.php" class="menu-item"><i class="bi bi-airplane-engines"></i> Data Maskapai</a></li>
        <li><a href="/tiket/admin/kota/" class="menu-item"><i class="bi bi-geo-alt"></i> Data Kota</a></li>
        <li><a href="/tiket/admin/rute/" class="menu-item"><i class="bi bi-map"></i> Data Rute</a></li>
        <li><a href="/tiket/admin/jadwal/" class="menu-item"><i class="bi bi-calendar"></i> Jadwal Penerbangan</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h2>Selamat datang di Dashboard Petugas</h2>
            <p>Gunakan sidebar untuk navigasi ke halaman yang berbeda.</p>
        </div>
    </div>
</body>
</html>
