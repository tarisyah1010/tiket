<?php
require 'layouts/navbar.php';

// Cek apakah ada pencarian
$where = "";
if (isset($_GET['search'])) {
    $keyword = $_GET['keyword'] ?? '';
    $tanggal = $_GET['tanggal'] ?? '';

    $whereConditions = [];
    if (!empty($keyword)) {
        $whereConditions[] = "nama_maskapai LIKE '%$keyword%'";
    }
    if (!empty($tanggal)) {
        $whereConditions[] = "tanggal_pergi = '$tanggal'";
    }
    if (!empty($whereConditions)) {
        $where = "WHERE " . implode(" AND ", $whereConditions);
    }
}

// Query data
$jadwal = query("SELECT * FROM jadwal_penerbangan 
INNER JOIN rute ON rute.id_rute = jadwal_penerbangan.id_rute 
INNER JOIN maskapai ON rute.id_maskapai = maskapai.id_maskapai 
$where
ORDER BY tanggal_pergi, waktu_berangkat");
?>
<!-- Banner Slide Full Layar -->
<div class="relative w-full h-[500px] overflow-hidden animate-fadeIn">
    <div class="absolute inset-0 flex items-center justify-center">
        <div id="slider" class="flex w-full h-full transition-transform duration-500">
            <!-- Slide 1 -->
            <div class="w-full flex-shrink-0 min-w-full relative">
                <img src="/e-ticketing/assets/images/foto1.jpeg" class="w-full h-full object-cover animate-fadeInUp" alt="Batik Air">
                <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center bg-black bg-opacity-50 p-6 rounded-lg animate-fadeInDelay">

                </div>
            </div>

            <!-- Slide 2 -->
            <div class="w-full flex-shrink-0 min-w-full relative">
                <img src="/e-ticketing/assets/images/foto1.jpeg" class="w-full h-full object-cover animate-fadeInUp" alt="Garuda Indonesia">
                <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center bg-black bg-opacity-50 p-6 rounded-lg animate-fadeInDelay">

                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Navigasi -->
    <button id="prev" class="absolute left-6 top-1/2 transform -translate-y-1/2 bg-gray-200 text-blue-900 p-3 rounded-full shadow-lg">❮</button>
    <button id="next" class="absolute right-6 top-1/2 transform -translate-y-1/2 bg-gray-200 text-blue-900 p-3 rounded-full shadow-lg">❯</button>

    <!-- Indikator Slide -->
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2">
        <div class="dot w-3 h-3 bg-white rounded-full cursor-pointer"></div>
        <div class="dot w-3 h-3 bg-gray-400 rounded-full cursor-pointer"></div>
    </div>
</div>

<div class="container mx-auto px-5 py-10">
    <div class="text-center">
        <h1 class="text-3xl font-bold text-blue-800">Jadwal Penerbangan</h1>
        <hr class="border-blue-400 w-1/4 mx-auto mt-2">
    </div>

    <!-- Form Search -->
    <div class="mt-8 flex flex-col md:flex-row items-center justify-center gap-4">
        <form action="" method="GET" class="flex flex-col md:flex-row items-center gap-4">
            <input type="text" name="keyword" placeholder="Cari Maskapai" value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>" class="border border-gray-300 rounded px-4 py-2 w-64">
            <input type="date" name="tanggal" value="<?= htmlspecialchars($_GET['tanggal'] ?? '') ?>" class="border border-gray-300 rounded px-4 py-2">
            <button type="submit" name="search" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cari</button>
            <a href="index.php" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-600">Reset</a>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
        <?php foreach($jadwal as $data) : ?>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden transform transition hover:scale-105">
            <div class="p-5">
                <div class="flex items-center space-x-4">
                    <img src="assets/images/<?= $data['logo_maskapai']; ?>" alt="<?= $data['nama_maskapai']; ?>" class="w-16 h-16 object-contain">
                    <div>
                        <h2 class="text-xl font-semibold text-blue-900"><?= $data['nama_maskapai']; ?></h2>
                        <p class="text-sm text-gray-500"><?= date('d M Y', strtotime($data['tanggal_pergi'])); ?></p>
                    </div>
                </div>

                <div class="mt-4">
                    <p class="text-lg font-medium text-gray-800">
                        <?= $data['rute_asal']; ?> → <?= $data['rute_tujuan']; ?>
                    </p>
                    <p class="text-gray-600"><?= $data['waktu_berangkat']; ?> - <?= $data['waktu_tiba']; ?></p>
                </div>

                <div class="mt-4 flex justify-between items-center">
                    <p class="text-lg font-bold text-green-600">Rp <?= number_format($data['harga']); ?></p>
                    <a href="detail.php?id=<?= $data['id_jadwal']; ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- Script untuk Auto-Slide -->
<script>
    let currentIndex = 0;
    const slides = document.querySelectorAll("#slider > div");
    const dots = document.querySelectorAll(".dot");
    const totalSlides = slides.length;
    const slider = document.getElementById("slider");

    function updateSlide(index) {
        slider.style.transform = `translateX(-${index * 100}%)`;
        dots.forEach(dot => dot.classList.replace("bg-white", "bg-gray-400"));
        dots[index].classList.replace("bg-gray-400", "bg-white");
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlide(currentIndex);
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateSlide(currentIndex);
    }

    document.getElementById("next").addEventListener("click", nextSlide);
    document.getElementById("prev").addEventListener("click", prevSlide);

    // Auto Slide setiap 5 detik
    setInterval(nextSlide, 1000);
</script>
