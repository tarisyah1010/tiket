<?php
require '../../koneksi.php';

function getOrders() {
    global $conn;
    $query = "SELECT * FROM order_tiket";
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function addOrder($data) {
    global $conn;
    $id_order = mysqli_real_escape_string($conn, $data["id_order"]);
    $tanggal_transaksi = mysqli_real_escape_string($conn, $data["tanggal_transaksi"]);
    $struk = mysqli_real_escape_string($conn, $data["struk"]);

    $query = "INSERT INTO order_tiket (id_order, tanggal_transaksi, struk) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $id_order, $tanggal_transaksi, $struk);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_affected_rows($stmt);
}

function getOrderById($id) {
    global $conn;
    $query = "SELECT * FROM order_tiket WHERE id_order = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}


function updateOrder($data) {
    global $conn;
    $id_order_lama = mysqli_real_escape_string($conn, $data["id_order_lama"]);
    $id_order_baru = mysqli_real_escape_string($conn, $data["id_order"]);
    $tanggal_transaksi = mysqli_real_escape_string($conn, $data["tanggal_transaksi"]);
    $struk = mysqli_real_escape_string($conn, $data["struk"]);

    if ($id_order_lama !== $id_order_baru) {
        // Cek apakah ID Order baru sudah ada
        $check = mysqli_query($conn, "SELECT id_order FROM order_tiket WHERE id_order = '$id_order_baru'");
        if (mysqli_num_rows($check) > 0) {
            echo "<script>alert('ID Order sudah digunakan! Silakan pilih ID lain.');</script>";
            return 0;
        }
    }
    
    $query = "UPDATE order_tiket SET id_order = ?, tanggal_transaksi = ?, struk = ? WHERE id_order = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $id_order_baru, $tanggal_transaksi, $struk, $id_order_lama);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_affected_rows($stmt);
}

function deleteOrder($id) {
    global $conn;
    $query = "DELETE FROM order_tiket WHERE id_order = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt === false) {
        die("Error preparing query: " . mysqli_error($conn));  // Jika terjadi error pada query
    }

    mysqli_stmt_bind_param($stmt, "s", $id);
    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
        die("Error executing query: " . mysqli_stmt_error($stmt));  // Jika terjadi error saat eksekusi
    }

    return mysqli_stmt_affected_rows($stmt);  // Mengembalikan jumlah baris yang terpengaruh
}

?>