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
                alert('Yay! Data pengguna berhasil ditambahkan!');
                window.location = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script type='text/javascript'>
                alert('Yhaa .. data pengguna gagal ditambahkan :(');
                window.location = 'index.php';
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
    <title>Tambah Pengguna</title>
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
        }

        label {
            font-weight: bold;
            color: #2c3e50;
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 2px solid #2980b9;
            border-radius: 8px;
            font-size: 16px;
        }

        select {
            width: 100%;
            padding: 12px;
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
        <h1>Tambah Pengguna</h1>
        <form action="" method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required>

            <label for="nama_lengkap">Email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Masukkan email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>

            <label for="roles">Roles</label>
            <select name="roles" id="roles" required>
                <option value="Petugas">Petugas</option>
                <option value="Penumpang">Penumpang</option>
            </select>

            <br><br>
            <button type="submit" name="tambah">Tambah</button>
        </form>
    </div>

</body>
</html>
