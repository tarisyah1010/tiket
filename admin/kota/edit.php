<?php
session_start();
require 'functions.php';

if (!isset($_SESSION["username"])) {
    echo "<script>alert('Silahkan login terlebih dahulu!'); window.location = '../../auth/login/index.php';</script>";
    exit;
}

$id = $_GET["id"];
$kota = query("SELECT * FROM kota WHERE id_kota = '$id'")[0];

if (isset($_POST["edit"])) {
    if (edit($_POST) > 0) {
        echo "<script>alert('Data kota berhasil diedit!'); window.location = 'index.php';</script>";
    } else {
        echo "<script>alert('Data kota gagal diedit!'); window.location = 'index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kota</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #1e3a5f;
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
        <h2 class="text-center">Edit Kota</h2>
        <p class="text-center">Halo, <?= $_SESSION["username"]; ?></p>
        <form action="" method="POST">
            <input type="hidden" name="id_kota" value="<?= $kota["id_kota"]; ?>">
            <div class="mb-3">
                <label for="nama_kota" class="form-label">Nama Kota</label>
                <input type="text" name="nama_kota" id="nama_kota" class="form-control" value="<?= $kota["nama_kota"]; ?>" required>
            </div>
            <button type="submit" name="edit" class="btn btn-primary w-100">Edit</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
