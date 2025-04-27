<?php
session_start();
require 'functions.php';

if (!isset($_SESSION["username"])) {
    echo "
    <script type='text/javascript'>
        alert('Silahkan login terlebih dahulu, ya!');
        window.location = '../../auth/login/index.php';
    </script>
    ";
    exit;
}

$rute = query("SELECT * FROM rute INNER JOIN maskapai ON maskapai.id_maskapai = rute.id_maskapai ORDER BY rute_asal");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Rute</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Font: Poppins -->
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
            font-weight: bold;
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
    </style>
</head>
<body>

<div class="petugas/sidebar.php">
    <div class="content">
        <div class="container mt-4">
            <div class="card p-4 shadow-lg">
                <h1 class="text-title text-center"><i class="fa fa-route"></i> Data Rute</h1>
                <p class="text-center text-muted">Kelola data rute dengan mudah!</p>
                <div class="d-flex justify-content-between">
                    <a href="tambah.php" class="btn btn-tambah"><i class="fa fa-plus"></i> Tambah Rute</a>
                    <input type="text" id="search" class="form-control w-25" placeholder="Cari Rute...">
                </div>
            </div>

            <div class="table-container">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Maskapai</th>
                            <th>Rute Asal</th>
                            <th>Rute Tujuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="ruteTable">
                        <?php $no = 1; ?>
                        <?php foreach ($rute as $data) : ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= htmlspecialchars($data["nama_maskapai"]); ?></td>
                            <td><?= htmlspecialchars($data["rute_asal"]); ?></td>
                            <td><?= htmlspecialchars($data["rute_tujuan"]); ?></td>
                            <td class="aksi">
                                <a href="edit.php?id=<?= $data["id_rute"]; ?>" class="edit">Edit</a>
                                <a href="hapus.php?id=<?= $data["id_rute"]; ?>" class="hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php $no++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.getElementById('search').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#ruteTable tr');
        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>

</body>
</html>
