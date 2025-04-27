<?php 
require 'petugas/index.php';

// Check if user is logged in
if (!isset($_SESSION['id_user'])) {
    header("Location: auth/login/");
    exit;
}

$id_user = $_SESSION['id_user'];

// Get all transactions for the current user
$transactions = query("SELECT 
    ot.id_order,
    ot.tanggal_transaksi,
    ot.struk,
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
WHERE od.id_user = '$id_user'
ORDER BY ot.tanggal_transaksi DESC");
?>

<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold text-center mb-6">Riwayat Transaksi</h1>

    <?php if (empty($transactions)): ?>
        <div class="text-center text-gray-600">
            <p>Belum ada riwayat transaksi.</p>
        </div>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-3 px-4 text-left">No</th>
                        <th class="py-3 px-4 text-left">ID Order</th>
                        <th class="py-3 px-4 text-left">Tanggal Transaksi</th>
                        <th class="py-3 px-4 text-left">Maskapai</th>
                        <th class="py-3 px-4 text-left">Rute</th>
                        <th class="py-3 px-4 text-left">Tanggal Pergi</th>
                        <th class="py-3 px-4 text-left">Waktu</th>
                        <th class="py-3 px-4 text-center">Jumlah Tiket</th>
                        <th class="py-3 px-4 text-right">Total Harga</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($transactions as $transaction): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4"><?= $no++; ?></td>
                            <td class="py-3 px-4"><?= $transaction['id_order']; ?></td>
                            <td class="py-3 px-4"><?= date('d/m/Y', strtotime($transaction['tanggal_transaksi'])); ?></td>
                            <td class="py-3 px-4"><?= $transaction['nama_maskapai']; ?></td>
                            <td class="py-3 px-4"><?= $transaction['rute_asal']; ?> - <?= $transaction['rute_tujuan']; ?></td>
                            <td class="py-3 px-4"><?= date('d/m/Y', strtotime($transaction['tanggal_pergi'])); ?></td>
                            <td class="py-3 px-4">
                                <?= date('H:i', strtotime($transaction['waktu_berangkat'])); ?> - 
                                <?= date('H:i', strtotime($transaction['waktu_tiba'])); ?>
                            </td>
                            <td class="py-3 px-4 text-center"><?= $transaction['jumlah_tiket']; ?></td>
                            <td class="py-3 px-4 text-right">Rp <?= number_format($transaction['total_harga']); ?></td>
                            <td class="py-3 px-4 text-center">
                                <?php if ($transaction['status'] === 'proses'): ?>
                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-sm">
                                        Sedang Diverifikasi
                                    </span>
                                <?php elseif ($transaction['status'] === 'verifikasi'): ?>
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">
                                        Terverifikasi
                                    </span>
                                <?php endif; ?>
                                
                            </td>
                            <td class="py-3 px-4 text-center">
                                <?php if ($transaction['status'] === 'verifikasi'): ?>
                                    <a href="cetak_tiket.php?id_order=<?= $transaction['id_order']; ?>" target="_blank" 
            class="bg-blue-500 text-white px-3 py-1 rounded-md text-sm">
            Cetak Tiket
        </a>
                                <?php else: ?>
                                    <!-- No action if not verified yet -->
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>