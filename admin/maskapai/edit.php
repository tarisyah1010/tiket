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

$id = $_GET["id"];
$maskapai = query("SELECT * FROM maskapai WHERE id_maskapai = '$id'")[0];

if (isset($_POST["edit"])) {
    if (edit($_POST) > 0) {
        echo "
            <script type='text/javascript'>
                alert('Yay! Data maskapai berhasil diedit!');
                window.location = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script type='text/javascript'>
                alert('Yhaa .. Data maskapai gagal diedit :(');
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
    <title>Edit Maskapai</title>
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

        .form-control {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 2px solid #2980b9;
            border-radius: 8px;
            font-size: 16px;
        }

        input[type="file"] {
            padding: 5px;
            border: none;
            background-color: #f1f1f1;
        }

        .preview-logo {
            margin-bottom: 10px;
        }

        .preview-logo img {
            width: 100px;
            height: auto;
            border-radius: 5px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
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

            .form-control {
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
        <h1>Edit Maskapai</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_maskapai" value="<?= htmlspecialchars($maskapai["id_maskapai"]); ?>">

            <label for="logo_maskapai">Logo Maskapai</label>
            <div class="preview-logo">
                <img src="../../assets/images/<?= htmlspecialchars($maskapai["logo_maskapai"]); ?>" alt="Logo <?= htmlspecialchars($maskapai["nama_maskapai"]); ?>">
            </div>
            <input type="file" name="logo_maskapai" id="logo_maskapai" class="form-control">

            <label for="nama_maskapai">Nama Maskapai</label>
            <input type="text" name="nama_maskapai" id="nama_maskapai" class="form-control" value="<?= htmlspecialchars($maskapai["nama_maskapai"]); ?>" required>

            <br><br>
            <button type="submit" name="edit">Edit</button>
        </form>
    </div>

</body>
</html>
