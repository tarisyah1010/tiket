<?php
require 'functions.php';

session_start();
//ini index nya dashboard
// Cek apakah user sudah login atau belum
if (!isset($_SESSION["username"])) {
    echo "
    <script>
        alert('Silahkan login terlebih dahulu!');
        window.location = '../auth/login/index.php';
    </script>
    ";
    exit;
}


require '../layouts/sidebar_admin.php';
$pengguna = query("SELECT COUNT(*) AS total FROM user where roles = 'penumpang'");
$petugas = query("SELECT COUNT(*) AS total FROM user where roles = 'petugas'");
$users = query("SELECT COUNT(*) AS total FROM user ");
$harga = query("SELECT SUM(total_harga) AS total_pendapatan FROM order_detail "); //sum digunakan untuk menghitung total
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: rgb(200, 215, 236);
            font-family: 'Poppins', sans-serif;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
        }

        .card {
            background-color: #b0c4de;
            border-radius: 15px;
            border: none;
            transition: 0.3s;
            text-align: center;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .text-title {
            color: #2D6187;
            /* Warna biru lebih gelap */
            font-weight: bold;
        }

        .btn-dashboard {
            background-color: #4C93B9;
            color: white;
            font-weight: bold;
            border-radius: 20px;
            padding: 10px 15px;
            transition: 0.3s;
            text-decoration: none;
        }

        .btn-dashboard:hover {
            background-color: #2D6187;
            color: #fff;
        }

        .dashboard-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .dashboard-card h3 {
            font-size: 1.2rem;
        }

        .dashboard-card p {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .icon {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #007bff;
        }

        @media (max-width: 768px) {
            .content {
                margin-left: 0;
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <?php include '../layouts/sidebar_admin.php'; ?>

    <!-- Konten Utama -->
    <div class="content">
        <div class="container mt-4">
            <div class="card p-5 shadow-lg">
                <h1 class="text-title"><i class="fa fa-user-cog"></i> Halo, <?= htmlspecialchars($_SESSION["username"]); ?>!</h1>
                <p class="lead">Selamat datang di Dashboard Admin. Kelola data dengan mudah dan cepat.</p>
                <a href="/tiket/admin/pengguna/" class="btn btn-dashboard"><i class="fa fa-users"></i> Kelola Pengguna</a>
            </div>
        </div>
        <div class="container mt-4">
            <div class="row g-3">
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-card">
                        <i class="fa fa-ticket icon"></i>
                        <h3>Data Penumpang</h3>
                        <p><?= $pengguna[0]["total"] ?? 0; ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-card">
                        <i class="fa fa-check icon"></i>
                        <h3>Data Petugas</h3>
                        <p><?= $petugas[0]["total"] ?? 0; ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-card">
                        <i class="fa fa-box icon"></i>
                        <h3>Data User</h3>
                        <p><?= $users[0]["total"] ?? 0; ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-card">
                        <i class="fa fa-money-bill icon"></i>
                        <h3>Pendapatan</h3>
                        <p><?= number_format ($harga[0]["total_pendapatan"]) ?? 0; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>