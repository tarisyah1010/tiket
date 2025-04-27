<?php
session_start();
require 'functions.php';
require '../../layouts/sidebar_admin.php';

// Check if admin is logged in
if (!isset($_SESSION['username']) || $_SESSION['roles'] !== 'Admin') {
    header("Location: ../../auth/login/");
    exit;
}

// Handle verification process
if (isset($_POST['verify'])) {
    $id_order = $_POST['id_order'];
    if (verifikasiOrder($id_order)) {
        echo "<script>
                alert('Order berhasil diverifikasi!');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal memverifikasi order!');
              </script>";
    }
}

// Get active tab
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'all';

// Prepare query based on active tab
$where_clause = "WHERE 1=1"; // Default clause to avoid SQL error when no filters are applied

if ($active_tab === 'proses') {
    $where_clause = "WHERE ot.status = 'proses'";
} elseif ($active_tab === 'verifikasi') {
    $where_clause = "WHERE ot.status = 'verifikasi'";
}

// Handle search
if (!empty($_GET['search_penumpang'])) {
    $search_penumpang = $_GET['search_penumpang'];
    $where_clause .= " AND u.nama_lengkap LIKE '%$search_penumpang%'";
}

// Get orders
$query = "SELECT 
    ot.id_order,
    ot.tanggal_transaksi,
    ot.status,
    od.jumlah_tiket,
    od.total_harga,
    u.username as nama_penumpang,
    jp.waktu_berangkat,
    jp.waktu_tiba,
    r.rute_asal,
    r.rute_tujuan,
    r.tanggal_pergi,
    m.nama_maskapai,
    m.logo_maskapai
FROM order_tiket ot
INNER JOIN order_detail od ON ot.id_order = od.id_order
INNER JOIN user u ON od.id_user = u.id_user
INNER JOIN jadwal_penerbangan jp ON od.id_penerbangan = jp.id_jadwal
INNER JOIN rute r ON jp.id_rute = r.id_rute
INNER JOIN maskapai m ON r.id_maskapai = m.id_maskapai
$where_clause
ORDER BY ot.tanggal_transaksi DESC";

$orders = query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Tiket - Admin</title>
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

        .nav-tabs {
            border-bottom: 2px solid #4682b4;
        }

        .nav-link.active {
            background-color: #4682b4;
            color: white;
        }

        .badge {
            font-weight: bold;
        }

        .badge.bg-warning {
            background-color: #ffcc00;
        }

        .badge.bg-success {
            background-color: #28a745;
        }

        .search-box {
            width: 100%;
            max-width: 300px;
        }
    </style>
</head>
<body>
    <?php include '../../layouts/sidebar_admin.php'; ?>

    <div class="content">
        <div class="container mt-4">
            <div class="card p-4 shadow-lg">
                <h1 class="text-title text-center"><i class="fa fa-ticket-alt"></i> Data Order Tiket</h1>
                <p class="text-center text-muted">Kelola data pemesanan tiket dengan mudah!</p>

                <div class="d-flex justify-content-between">
                    <input type="text" id="search" class="form-control search-box" placeholder="Cari Penumpang...">
                </div>
            </div>

            <!-- Tab Menu -->
            <ul class="nav nav-tabs mt-4">
                <li class="nav-item">
                    <a class="nav-link <?= $active_tab === 'all' ? 'active' : '' ?>" href="?tab=all">Semua Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $active_tab === 'proses' ? 'active' : '' ?>" href="?tab=proses">Proses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $active_tab === 'terverifikasi' ? 'active' : '' ?>" href="?tab=terverifikasi">Terverifikasi</a>
                </li>
            </ul>

            <!-- Tabel Data Order -->
            <div class="table-container mt-4">
                <table class="table table-bordered text-center" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Order</th>
                            <th>Tanggal</th>
                            <th>Penumpang</th>
                            <th>Maskapai</th>
                            <th>Rute</th>
                            <th>Waktu</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($orders)): ?>
                            <tr><td colspan="11" class="text-center">Tidak ada data order</td></tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($orders as $order): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $order['id_order']; ?></td>
                                    <td><?= date('d/m/Y', strtotime($order['tanggal_transaksi'])); ?></td>
                                    <td><?= $order['nama_penumpang']; ?></td>
                                    <td><?= $order['nama_maskapai']; ?></td>
                                    <td><?= $order['rute_asal']; ?> - <?= $order['rute_tujuan']; ?></td>
                                    <td><?= date('H:i', strtotime($order['waktu_berangkat'])); ?> - <?= date('H:i', strtotime($order['waktu_tiba'])); ?></td>
                                    <td><?= $order['jumlah_tiket']; ?></td>
                                    <td>Rp <?= number_format($order['total_harga']); ?></td>
                                    <td>
                                        <span class="badge bg-<?= $order['status'] === 'proses' ? 'warning' : 'success' ?>">
                                            <?= ucfirst($order['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($order['status'] === 'proses'): ?>
                                            <form action="" method="POST" class="d-inline">
                                                <input type="hidden" name="id_order" value="<?= $order['id_order']; ?>">
                                                <button type="submit" name="verify" class="btn btn-sm btn-primary">Verifikasi</button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false
            });

            $('#search').on('input', function() {
                var value = $(this).val().toLowerCase();
                $('#dataTable tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
</body>
</html>
