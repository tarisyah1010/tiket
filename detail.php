<?php
require 'layouts/navbar.php';

$id = $_GET['id'];

$jadwal = query("SELECT * FROM jadwal_penerbangan 
INNER JOIN rute ON rute.id_rute = jadwal_penerbangan.id_rute 
INNER JOIN maskapai ON rute.id_maskapai = maskapai.id_maskapai 
WHERE id_jadwal='$id'")[0];
?>

<div class="container mx-auto px-5 py-10">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6">
            <!-- Informasi Maskapai -->
            <div class="flex items-center space-x-6">
                <img src="assets/images/<?= $jadwal['logo_maskapai']; ?>" alt="<?= $jadwal['nama_maskapai']; ?>" class="w-20 h-20 object-contain">
                <div>
                    <h2 class="text-2xl font-semibold text-blue-900"><?= $jadwal['nama_maskapai']; ?></h2>
                    <p class="text-gray-500"><?= date('d M Y', strtotime($jadwal['tanggal_pergi'])); ?></p>
                </div>
            </div>

            <!-- Informasi Penerbangan -->
            <div class="mt-6 border-t pt-4">
                <p class="text-xl font-medium text-gray-800"><?= $jadwal['rute_asal']; ?> → <?= $jadwal['rute_tujuan']; ?></p>
                <p class="text-gray-600"><?= $jadwal['waktu_berangkat']; ?> - <?= $jadwal['waktu_tiba']; ?></p>
                <p class="mt-2 text-gray-700"><strong>Kapasitas Kursi:</strong> <?= $jadwal['kapasitas_kursi']; ?> Kursi</p>
                <p class="mt-2 text-green-600 text-2xl font-bold">Rp <?= number_format($jadwal['harga']); ?></p>
            </div>

            <!-- Form Pembelian Tiket -->
            <form action="proses_pemesanan.php" method="POST" class="mt-6">
            <input type="hidden" name="id_jadwal" value="<?= $jadwal['id_jadwal']; ?>">

            <label for="qty" class="block text-gray-700 font-medium">Jumlah Tiket</label>
            <input type="number" id="qty" name="qty" min="1" max="<?= $jadwal['kapasitas_kursi']; ?>" required
                class="w-full mt-2 px-4 py-2 border rounded focus:ring focus:ring-blue-300 outline-none">

            <button type="submit" name="pesan" class="w-full bg-blue-500 text-white px-4 py-2 mt-4 rounded hover:bg-blue-600 transition">
                Beli Tiket
            </button>
        </form>
            
            <!-- Tombol Kembali -->
            <div class="mt-4">
                <a href="index.php" class="text-blue-600 hover:underline">&larr; Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>

<?php

if(isset($_POST['pesan'])){
if($POST['qty'] > $jadwal['kapasitas_kursi']){
    echo "
    <script type='text/javascript'>
        alert('Mohon maaf kuantitas yang kamu pesan melebihi kuantitas yang tersedia!');
        window.location = 'index.php'
    </script>    
    ";
}else if($_POST['qty'] <= 0) {
    echo "
    <script type='text/javascript'>
        alert('Beli setidak-nya 1 tiket, ya!');
        window.location = 'index.php'
    </script>    
    ";
}else{
    $qty = $_POST['qty'];
    $_SESSION['cart']['$id'] = $qty;
    echo "<script type='text/javascript'>window.location = 'cart.php </script>";
}}

?>
