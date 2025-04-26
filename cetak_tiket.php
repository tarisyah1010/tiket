<?php
require 'functions.php';

// Pastikan pengguna masuk
if (!isset($_SESSION['id_user'])) {
    header("Location: auth/login/");
    exit;
}

if (!isset($_GET['id_order'])) {
    die("ID order tidak ditemukan.");
}

$id_order = $_GET['id_order'];

// Ambil detail transaksi
$transaction = query("SELECT 
    ot.id_order,
    ot.tanggal_transaksi,
    ot.status,
    od.jumlah_tiket,
    od.total_harga,
    jp.waktu_berangkat,
    jp.waktu_tiba,
    r.rute_asal,
    r.rute_tujuan,
    r.tanggal_pergi,
    m.nama_maskapai,
    m.logo_maskapai
FROM order_tiket ot
INNER JOIN order_detail od ON ot.id_order = od.id_order
INNER JOIN jadwal_penerbangan jp ON od.id_penerbangan = jp.id_jadwal
INNER JOIN rute r ON jp.id_rute = r.id_rute
INNER JOIN maskapai m ON r.id_maskapai = m.id_maskapai
WHERE ot.id_order = '$id_order'
LIMIT 1")[0];

if (!$transaction) {
    die("Transaksi tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="id"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boarding Pass</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        @media print {
            .no-print { display: none; }
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body class="d-flex flex-column justify-content-center align-items-center min-vh-100 bg-light p-4">
    
    <div id="ticket" class="border border-primary rounded-3 shadow-lg bg-white p-4 w-100" style="max-width: 600px;">
        <div class="text-center mb-3">
        </div>
        
        <h2 class="text-center text-primary fw-bold">SKYTRIP</h2>
        
        <div class="border p-3 rounded bg-light">
            <p><strong>ID Order:</strong> <?= $transaction['id_order']; ?></p>
            <p><strong>Nama Penumpang:</strong> <?= $_SESSION['username']; ?></p>
            <p><strong>Maskapai:</strong> <?= $transaction['nama_maskapai']; ?></p>
            <p><strong>Rute:</strong> <?= $transaction['rute_asal']; ?> - <?= $transaction['rute_tujuan']; ?></p>
            <p><strong>Tanggal Pergi:</strong> <?= date('d/m/Y', strtotime($transaction['tanggal_pergi'])); ?></p>
            <p><strong>Waktu:</strong> <?= date('H:i', strtotime($transaction['waktu_berangkat'])); ?> - <?= date('H:i', strtotime($transaction['waktu_tiba'])); ?></p>
            <p><strong>Jumlah Tiket:</strong> <?= $transaction['jumlah_tiket']; ?></p>
            <p><strong>Total Harga:</strong> Rp <?= number_format($transaction['total_harga']); ?></p>
        </div>
        
        <div class="text-center mt-3">
            <img src="/e-ticketing/assets/images/code.png" alt="Barcode" class="img-fluid" style="max-width: 150px;">
        </div>
    </div>
    
    <div class="mt-4 d-flex gap-3">
        <button onclick="window.print()" class="no-print btn btn-primary px-4">Cetak Tiket</button>
        <button onclick="downloadTicket()" class="no-print btn btn-success px-4">Simpan sebagai Gambar</button>
    </div>

    <script>
        function downloadTicket() {
            const ticketElement = document.getElementById("ticket");
            html2canvas(ticketElement, { scale: 2 }).then(canvas => {
                let link = document.createElement("a");
                link.href = canvas.toDataURL("image/png");
                link.download = "boarding-pass.png";
                link.click();
            });
        }
    </script>
</body>
</html>