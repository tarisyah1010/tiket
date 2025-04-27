<?php
session_start();
require 'functions.php';

if (!isset($_SESSION["username"])) {
    echo "<script>alert('Silahkan login terlebih dahulu!'); window.location = '../../auth/login/index.php';</script>";
    exit;
}

if (isset($_POST["tambah"])) {
    if (tambah($_POST) > 0) {
        echo "<script>alert('Data kota berhasil ditambahkan!'); window.location = 'index.php';</script>";
    } else {
        echo "<script>alert('Data kota gagal ditambahkan!'); window.location = 'index.php';</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kota</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color:rgb(255, 255, 255);
            color: #ffffff;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 500px;
            background: #2c4b76;
            padding: 30px;
            border-radius: 15px;
            border: 5px solid #ffffff;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        .form-control {
            background: #ffffff;
            color: #000000;
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Tambah Kota</h2>
        <p class="text-center">Halo, <?= $_SESSION["username"]; ?></p>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="nama_kota" class="form-label">Nama Kota</label>
                <input type="text" name="nama_kota" id="nama_kota" class="form-control" required>
            </div>
            <button type="submit" name="tambah" class="btn btn-primary w-100">Tambah</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
