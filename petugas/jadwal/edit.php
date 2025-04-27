<?php

session_start();
require 'functions.php';

// Check if the user is logged in
if(!isset($_SESSION["username"])){
    echo "
    <script type='text/javascript'>
        alert('Silahkan login terlebih dahulu, ya!');
        window.location = '../../auth/login/index.php';
    </script>
    ";
    exit;
}

// Get the id from URL
$id = $_GET["id"];

// Fetch the data for the selected flight schedule
$jadwal = query("SELECT * FROM jadwal_penerbangan 
                 INNER JOIN rute ON rute.id_rute = jadwal_penerbangan.id_rute 
                 INNER JOIN maskapai ON rute.id_maskapai = maskapai.id_maskapai 
                 WHERE id_jadwal = '$id'")[0];

// Fetch all routes
$rute = query("SELECT * FROM rute INNER JOIN maskapai ON maskapai.id_maskapai = rute.id_maskapai");

// Check if the form is submitted
if(isset($_POST["edit"])){
    if(edit($_POST) > 0 ){
        echo "
            <script type='text/javascript'>
                alert('Yay! Data jadwal penerbangan berhasil diedit!')
                window.location = 'index.php'
            </script>
        ";
    }else{
        echo "
            <script type='text/javascript'>
                alert('Yhaa .. Data jadwal penerbangan gagal diedit :(')
                window.location = 'index.php'
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal Penerbangan</title>
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

        label {
            color: #ffffff;
            margin-bottom: 0.5rem;
        }

        input[type="time"], input[type="number"], select {
            background: #ffffff;
            color: #000;
        }

        .btn-custom {
            background-color: #0d6efd;
            border: none;
        }

        .btn-custom:hover {
            background-color: #0b5ed7;
        }

    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Edit Jadwal Penerbangan</h2>
        <form action="" method="POST">
            <!-- Hidden input to pass the ID of the selected schedule -->
            <input type="hidden" name="id_jadwal" value="<?= htmlspecialchars($jadwal["id_jadwal"]); ?>">

            <!-- Select Route Dropdown -->
            <div class="mb-3">
                <label for="id_rute" class="form-label">Pilih Rute</label>
                <select name="id_rute" id="id_rute" class="form-control" required>
                    <!-- Display current selected route -->
                    <option value="<?= htmlspecialchars($jadwal["id_rute"]); ?>">
                        <?= htmlspecialchars($jadwal["nama_maskapai"] . " - " . $jadwal["rute_asal"] . " - " . $jadwal["rute_tujuan"]); ?>
                    </option>
                    <!-- Display all available routes -->
                    <?php foreach($rute as $data) : ?>
                    <option value="<?= htmlspecialchars($data["id_rute"]); ?>">
                        <?= htmlspecialchars($data["nama_maskapai"] . " - " . $data["rute_asal"] . " - " . $data["rute_tujuan"]); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Departure Time Input -->
            <div class="mb-3">
                <label for="waktu_berangkat" class="form-label">Waktu Berangkat</label>
                <input type="time" name="waktu_berangkat" id="waktu_berangkat" value="<?= htmlspecialchars($jadwal["waktu_berangkat"]); ?>" class="form-control" required>
            </div>

            <!-- Arrival Time Input -->
            <div class="mb-3">
                <label for="waktu_tiba" class="form-label">Waktu Tiba</label>
                <input type="time" name="waktu_tiba" id="waktu_tiba" value="<?= htmlspecialchars($jadwal["waktu_tiba"]); ?>" class="form-control" required>
            </div>

            <!-- Price Input -->
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" name="harga" id="harga" value="<?= htmlspecialchars($jadwal["harga"]); ?>" class="form-control" placeholder="Masukkan harga tiket" required>
            </div>

            <!-- Seat Capacity Input -->
            <div class="mb-3">
                <label for="kapasitas_kursi" class="form-label">Kapasitas Kursi</label>
                <input type="number" name="kapasitas_kursi" id="kapasitas_kursi" value="<?= htmlspecialchars($jadwal["kapasitas_kursi"]); ?>" class="form-control" placeholder="Masukkan Kapasitas Kursi" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" name="edit" class="btn btn-primary w-100">Edit</button>
        </form>
    </div>
</body>
</html>
                        