<?php

require '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $roles = 'Penumpang';

    // Cek apakah username sudah digunakan
    $cek_user = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($cek_user) > 0) {
        echo "<script>alert('Username sudah digunakan!'); window.location = 'index.php';</script>";
    } else {
        // Hash password sebelum disimpan agar ia tidak terlihat password nya
        
        // Simpan ke database
        $query = "INSERT INTO user (username, password, email, roles) VALUES ('$username', '$password', '$email', '$roles')";
        
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location = '../login/index.php';</script>";
        } else {
            echo "<script>alert('Registrasi gagal!'); window.location = 'index.php';</script>";
        }
    } 
}
?>
