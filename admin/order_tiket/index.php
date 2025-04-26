<?php
session_start();
require 'functions.php';

// Redirect ke halaman login jika belum login
if (!isset($_SESSION["username"])) {
    echo "
    <script type='text/javascript'>
        alert('Silahkan login terlebih dahulu, ya!');
        window.location = '../auth/login/index.php';
    </script>";
    exit();
}

// Koneksi ke database
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Mengambil data order tiket dari database
$query = "SELECT * FROM order_tiket";
$result = mysqli_query($conn, $query);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Tutup koneksi database
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Order Tiket</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            background-color: #f0f8ff;
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
            padding: 20px;
        }
        .text-title {
            color: #2d6187;
            font-weight: bold;
        }
        .btn-tambah {
            background-color: #4682b4;
            color: white;
            border-radius: 20px;
            padding: 10px 15px;
        }
        .table-container {
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
        }
        th {
            background-color: #4682b4;
            color: white;
            padding: 12px;
        }
        td {
            padding: 10px;
            text-align: center;
        }
        .aksi a {
            padding: 8px 12px;
            border-radius: 8px;
            text-decoration: none;
        }
        .edit {
            background-color: #32cd32;
            color: white;
        }
        .hapus {
            background-color: #dc143c;
            color: white;
        }
        .search-box {
            width: 100%;
            max-width: 300px;
        }
    </style>
</head>
<body>

    <?php require '../../layouts/sidebar_admin.php'; ?>

    <div class="content">
        <div class="container mt-4">
            <div class="card p-4 shadow-lg">
                <h1 class="text-title text-center"><i class="fa fa-ticket-alt"></i> Data Order Tiket</h1>
                <p class="text-center text-muted">Kelola data pemesanan tiket dengan mudah!</p>
                <div class="d-flex justify-content-between">
                    <a href="tambah.php" class="btn btn-tambah"><i class="fa fa-plus"></i> Tambah Order</a>
                    <input type="text" id="search" class="form-control search-box" placeholder="Cari ID Order...">
                </div>
            </div>

            <div class="table-container mt-4">
                <table class="table table-bordered text-center" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Order</th>
                            <th>Tanggal Transaksi</th>
                            <th>Struk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= htmlspecialchars($order["id_order"]); ?></td>
                            <td><?= htmlspecialchars($order["tanggal_transaksi"]); ?></td>
                            <td><?= htmlspecialchars($order["struk"]); ?></td>
                            <td class="aksi">
                                <a href="edit.php?id=<?= $order["id_order"]; ?>" class="edit">Edit</a>
                                <a href="hapus.php?id=<?= $order["id_order"]; ?>" class="hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php $no++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
</body>
</html>