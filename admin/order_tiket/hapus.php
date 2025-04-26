<?php
require '../../koneksi.php';
require 'functions.php';

// Mengecek apakah id ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];


    // Memanggil fungsi untuk menghapus data berdasarkan id_order
    $result = deleteOrder($id);

    // Mengecek apakah penghapusan berhasil
    if ($result > 0) {
        echo "<script>
                alert('Data berhasil dihapus!');
                window.location.href = 'index.php';  // Arahkan kembali ke halaman utama
              </script>";
    } else {
        echo "<script>
                alert('Data gagal dihapus!');
                window.location.href = 'index.php';  // Arahkan kembali ke halaman utama
              </script>";
    }
}
    
?>