<?php require 'layouts/navbar.php'; ?>

<div class="list-tiket-pesawat container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold text-center mb-6">List Pemesanan Tiket</h1>
    <?php if(empty($_SESSION["cart"])){ ?>
            <h1 class="text-xl text-center text-gray-600">Belum ada tiket yang kamu pesan!</h1>
    <?php } else { ?>
        <div class="overflow-x-auto">
            <form action="" method="POST">
                <label for="nama_lengkap">Nama Pemesan</label><br /> <br />
                <?php if(!isset($_SESSION["id_user"])): ?>
                    <div class="text-red-500">Error: User ID not found in session!</div>
                <?php endif; ?>
                <input type="hidden" name="id_user" value="<?= $_SESSION["id_user"] ?? ''; ?>">
                <input type="text" value="<?= $_SESSION["nama_lengkap"] ?? ''; ?>" disabled>
                
                <table border="1" cellpadding="10" cellspacing="0" class="min-w-full bg-white shadow-md rounded-lg">
                    <tr class="bg-gray-200">
                        <th class="py-3 px-4 text-left">No</th>
                        <th class="py-3 px-4 text-left">Nama Maskapai</th>
                        <th class="py-3 px-4 text-left">Rute</th>
                        <th class="py-3 px-4 text-left">Tanggal Berangkat</th>
                        <th class="py-3 px-4 text-left">Waktu Keberangkatan</th>
                        <th class="py-3 px-4 text-right">Harga</th>
                        <th class="py-3 px-4 text-center">Kuantitas</th>
                        <th class="py-3 px-4 text-right">Total Harga</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>

                    <?php 
                    $no = 1; 
                    $grandTotal = 0;
                    foreach($_SESSION["cart"] as $id_jadwal => $kuantitas) : 
                        $jadwalPenerbangan = query("SELECT * FROM jadwal_penerbangan 
                            INNER JOIN rute ON rute.id_rute = jadwal_penerbangan.id_rute 
                            INNER JOIN maskapai ON rute.id_maskapai = maskapai.id_maskapai 
                            WHERE id_jadwal = '$id_jadwal'")[0];
                        
                        if (!$jadwalPenerbangan) {
                            echo "<div class='text-red-500'>Error: Flight schedule not found for ID: $id_jadwal</div>";
                            continue;
                        }
                        
                        $totalHarga = $jadwalPenerbangan["harga"] * $kuantitas;
                        $grandTotal += $totalHarga;         
                    ?>
                        <tr class="border-b">
                            <td class="py-3 px-4"><?= $no; ?></td>
                            <td class="py-3 px-4"><?= $jadwalPenerbangan["nama_maskapai"]; ?></td>
                            <td class="py-3 px-4"><?= $jadwalPenerbangan["rute_asal"]; ?> - <?= $jadwalPenerbangan["rute_tujuan"]; ?></td>
                            <td class="py-3 px-4"><?= $jadwalPenerbangan["tanggal_pergi"]; ?></td>
                            <td class="py-3 px-4"><?= $jadwalPenerbangan["waktu_berangkat"]; ?> - <?= $jadwalPenerbangan["waktu_tiba"]; ?></td>
                            <td class="py-3 px-4 text-right">Rp <?= number_format($jadwalPenerbangan["harga"]); ?></td>
                            <td class="py-3 px-4 text-center"><?= $kuantitas; ?></td>
                            <td class="py-3 px-4 text-right">Rp <?= number_format($totalHarga); ?></td>
                            <td class="py-3 px-4 text-center">
                            <a href="cart_edit.php?id=<?= $id_jadwal; ?>" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-700 transition">Edit</a>
                            <a href="cart_delete.php?id=<?= $id_jadwal; ?>" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                    <tr class="bg-gray-100">
                        <td class="py-3 px-4 font-semibold" colspan="7">Grand Total</td>
                        <td class="py-3 px-4 text-right font-semibold">Rp <?= number_format($grandTotal); ?></td>
                        <td class="py-3 px-4"></td>
                    </tr>
                    <tr>
                        <td class="py-3 px-4" colspan="9">
                            <div class="text-right">
                                <button type="submit" name="checkout" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition-colors duration-300">Checkout</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    <?php } ?>
</div>

<?php
if (isset($_POST['checkout'])) {
    error_log("Checkout process started");
    error_log("POST data: " . print_r($_POST, true));
    error_log("Session cart data: " . print_r($_SESSION["cart"], true));
    
    if (!isset($_POST['id_user']) || empty($_POST['id_user'])) {
        echo "<script>alert('Error: User ID is missing!');</script>";
        error_log("Error: User ID is missing in POST data");
        exit;
    }
    
    $result = checkout($_POST);
    if ($result === true) {
        echo "
        <script type='text/javascript'>
            alert('Checkout berhasil!');
            window.location = 'index.php';
        </script>";
    } else {
        error_log("Checkout failed");
        echo "
        <script type='text/javascript'>
            alert('Checkout gagal! Silakan coba lagi.');
        </script>";
}
}
?>