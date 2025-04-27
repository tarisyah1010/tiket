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

$maskapai = query("SELECT * FROM maskapai");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Maskapai</title>

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
        td img {
            width: 80px;
            height: auto;
            border-radius: 10px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>

<div class="petugas/sidebar.php">
    <div class="content">
        <div class="container mt-4">
            <div class="card p-4 shadow-lg">
                <h1 class="text-title text-center"><i class="fa fa-plane"></i> Data Maskapai</h1>
                <p class="text-center text-muted">Kelola data maskapai dengan mudah!</p>
                <div class="d-flex justify-content-between">
                    <a href="tambah.php" class="btn btn-tambah"><i class="fa fa-plus"></i> Tambah Maskapai</a>
                    <input type="text" id="search" class="form-control w-25" placeholder="Cari Maskapai...">
                </div>
            </div>
            <div class="table-container">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Logo</th>
                            <th>Nama Maskapai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="maskapaiTable">
                        <?php $no = 1; ?>
                        <?php foreach ($maskapai as $data) : ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><img src="../../assets/images/<?= htmlspecialchars($data["logo_maskapai"]); ?>" alt="Logo <?= htmlspecialchars($data["nama_maskapai"]); ?>"></td>
                            <td><?= htmlspecialchars($data["nama_maskapai"]); ?></td>
                            <td class="aksi">
                                <a href="edit.php?id=<?= $data["id_maskapai"]; ?>" class="edit">Edit</a>
                                <a href="hapus.php?id=<?= $data["id_maskapai"]; ?>" class="hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php $no++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('search').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#maskapaiTable tr');
        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>

</body>
</html>
