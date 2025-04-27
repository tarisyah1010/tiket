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

if (isset($_POST["tambah"])) {
    if (tambah($_POST) > 0) {
        echo "
            <script type='text/javascript'>
                alert('Yay! Data rute berhasil ditambahkan!');
                window.location = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script type='text/javascript'>
                alert('Yhaa .. Data rute gagal ditambahkan :(');
                window.location = 'index.php';
            </script>
        ";
    }
}

$maskapai = query("SELECT * FROM maskapai");
$kota = query("SELECT * FROM kota");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Rute</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f5f7fa;
        }

        /* Form Container */
        .form-container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            border: 3px solid #2980b9;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
            text-align: center;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 22px;
        }

        label {
            font-weight: bold;
            color: #2c3e50;
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        .form-control, select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 2px solid #2980b9;
            border-radius: 8px;
            font-size: 16px;
            background-color: white;
        }

        button {
            width: 100%;
            background-color: #2980b9;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #1f6690;
        }

        /* Responsif */
        @media (max-width: 576px) {
            .form-container {
                width: 95%;
                padding: 20px;
            }

            .form-control, select {
                font-size: 14px;
                padding: 10px;
            }

            button {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Tambah Rute</h1>
        <form action="" method="POST">
            <label for="id_maskapai">Nama Maskapai</label>
            <select name="id_maskapai" id="id_maskapai" class="form-control" required>
                <?php foreach ($maskapai as $data) : ?>
                <option value="<?= htmlspecialchars($data["id_maskapai"]); ?>"><?= htmlspecialchars($data["nama_maskapai"]); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="rute_asal">Rute Asal</label>
            <select name="rute_asal" id="rute_asal" class="form-control" required>
                <?php foreach ($kota as $data) : ?>
                <option value="<?= htmlspecialchars($data["nama_kota"]); ?>"><?= htmlspecialchars($data["nama_kota"]); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="rute_tujuan">Rute Tujuan</label>
            <select name="rute_tujuan" id="rute_tujuan" class="form-control" required>
                <?php foreach ($kota as $data) : ?>
                <option value="<?= htmlspecialchars($data["nama_kota"]); ?>"><?= htmlspecialchars($data["nama_kota"]); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="tanggal_pergi">Tanggal Pergi</label>
            <input type="date" name="tanggal_pergi" id="tanggal_pergi" class="form-control" required>

            <br><br>
            <button type="submit" name="tambah">Tambah</button>
        </form>
    </div>

</body>
</html>
