<?php
// tambah_order.php
session_start();
require 'functions.php';

if (!isset($_SESSION["username"])) {
    echo "
    <script type='text/javascript'>
        alert('Silahkan login terlebih dahulu, ya!');
        window.location = '../../auth/login/index.php';
    </script>
    ";
    exit();
}

if (isset($_POST["tambah"])) {
    if (addOrder($_POST) > 0) {
        echo "
        <script type='text/javascript'>
            alert('Yay! Data order berhasil ditambahkan!');
            window.location = 'index.php';
        </script>
        ";
    } else {
        echo "
        <script type='text/javascript'>
            alert('Yhaa.. Data order gagal ditambahkan :(');
            window.location = 'index.php';
        </script>
        ";
    }
}
?>



<div class="container">
    <h1>Halo, <?= htmlspecialchars($_SESSION["username"]); ?></h1>
    <h2>Tambah Order</h2>

    <form action="" method="POST">
        <!-- ID Order -->
        <div class="form-group">
            <label for="id_order">ID Order</label>
            <input type="text" name="id_order" id="id_order" class="form-control" required>
        </div>

        <!-- Tanggal Transaksi -->
        <div class="form-group">
            <label for="tanggal_transaksi">Tanggal Transaksi</label>
            <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" required>
        </div>

        <!-- Struk -->
        <div class="form-group">
            <label for="struk">Struk</label>
            <input type="text" name="struk" id="struk" class="form-control" required>
        </div>

        <!-- Button Tambah -->
        <button type="submit" name="tambah" class="btn">Tambah</button>
    </form>
</div>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .container {
        width: 100%;
        max-width: 600px;
        padding: 30px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        text-align: center;
    }

    h1, h2 {
        color: #333;
        margin-bottom: 20px;
    }

    h1 {
        font-size: 24px;
    }

    h2 {
        font-size: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 16px;
        align-items: center;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        width: 100%;
        align-items: center;
    }

    label {
        font-size: 14px;
        color: #555;
        margin-bottom: 6px;
    }

    select, input {
        padding: 10px;
        font-size: 16px;
        border: 2px solid #ccc;
        border-radius: 6px;
        width: 100%;
        max-width: 400px;
    }

    select:focus, input:focus {
        outline-color: #4c9aff;
        border-color: #4c9aff;
    }

    .btn {
        padding: 12px;
        font-size: 16px;
        background-color: #4c9aff;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s;
        width: 100%;
        max-width: 400px;
    }

    .btn:hover {
        background-color: #0066cc;
    }

    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        h1 {
            font-size: 20px;
        }

        h2 {
            font-size: 16px;
        }

        label {
            font-size: 12px;
        }

        select, input, .btn {
            font-size: 14px;
        }
    }
</style>