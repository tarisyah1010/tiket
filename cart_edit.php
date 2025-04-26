

<?php
require 'layouts/navbar.php';

// Cek apakah user sudah login
if (!isset($_SESSION["id_user"])) {
    header("Location: login.php");
    exit;
}

// Ambil id_jadwal dari URL
$id_jadwal = $_GET['id'] ?? '';
if (!$id_jadwal || !isset($_SESSION["cart"][$id_jadwal])) {
    echo "<script>
        alert('Item tidak ditemukan dalam keranjang!');
        window.location.href='cart.php';
    </script>";
    exit;
}

// Ambil data jadwal penerbangan
$jadwal = query("SELECT * FROM jadwal_penerbangan 
    INNER JOIN rute ON rute.id_rute = jadwal_penerbangan.id_rute 
    INNER JOIN maskapai ON rute.id_maskapai = maskapai.id_maskapai 
    WHERE id_jadwal = '$id_jadwal'")[0];

if (!$jadwal) {
    echo "<script>
        alert('Data penerbangan tidak ditemukan!');
        window.location.href='cart.php';
    </script>";
    exit;
}

// Proses update kuantitas
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kuantitas_baru = (int)$_POST['kuantitas'];
    
    // Validasi kuantitas
    if ($kuantitas_baru > 0) {
        $_SESSION["cart"][$id_jadwal] = $kuantitas_baru;
        $_SESSION['success'] = 'Kuantitas berhasil diupdate!';
        header("Location: cart.php");
        exit;
    } else {
        $error = "Kuantitas harus minimal 1";
    }
}

$kuantitas= $_SESSION["cart"][$id_jadwal];
?>

<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold mb-6">Edit Kuantitas Tiket</h1>
    
    <div class="bg-white shadow-md rounded-lg p-6 mx-auto">
        <a href="cart.php" class="text-blue-500 hover:underline mb-4 inline-block">← Kembali ke Keranjang</a>
        
        <div class="mb-4">
            <p class="font-semibold">Maskapai:</p>
            <p><?= $jadwal['nama_maskapai']; ?></p>
        </div>
        
        <div class="mb-4">
            <p class="font-semibold">Rute:</p>
            <p><?= $jadwal['rute_asal']; ?> → <?= $jadwal['rute_tujuan']; ?></p>
        </div>
        
        <form method="POST" action="">
            <div class="mb-4">
                <label class="block font-semibold mb-2">Kuantitas:</label>
                <input type="number" name="kuantitas" 
                    value="<?= $kuantitas ?>"
                    class="w-80 px-3 py-2 border rounded">
                <?php if(isset($error)): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $error; ?></p>
                <?php endif; ?>
            </div>
            
            <button type="submit" 
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition-colors duration-300">
                Update Kuantitas
            </button>
        </form>
    </div>
</div>