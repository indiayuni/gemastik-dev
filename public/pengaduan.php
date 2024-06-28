<?php
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== 'user') {
    header("Location: login.php");
    exit;
}

require 'functions.php';
$username = $_SESSION[ "username" ];

if ( isset($_POST["kirim"]) ) {

    if( pengaduan($_POST) > 0 ) {
        echo "<script>
            alert('berhasil mengirim pengaduan');
        </script>";
    } else {
        echo mysqli_affected_rows($conn);
    }
}

// $pelapor = query("SELECT user_id FROM users WHERE username = '$username'");
// $user_id = $pelapor[0]['user_id'];

?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pengaduan</title>
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="css/final.css">
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
</head>
<body class="h-screen">
<nav class="fixed bg-gray-400 w-64 left-0 top-0 h-full p-4 z-50 sidebar-menu lg:block transition-transform hidden">
    <div class="flex items-center mt-5 pb-4 border-b border-b-gray-300">
        <img src="img/profil.png" class="w-20 bg-cover rounded-full">
        <span class="text-white text-center text-lg ml-3 font-bold"><?= $username; ?></span>

    </div>

    <ul class="mt-4">
        <li class="mb-1 group">
            <a href="dashboard.php" class="text-white flex items-center py-2 px-4 hover:bg-gray-500 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class="ri-user-line mr-3"></i>
                <span class="text-sm">Profil</span>
            </a>
        </li>
        <li class="mb-1 group active">
            <a href="#" class="text-white flex items-center py-2 px-4 hover:bg-gray-500 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class="ri-sticky-note-add-line mr-3"></i>
                <span class="text-sm">Pengaduan</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="riwayat.php" class="text-white flex items-center py-2 px-4 hover:bg-gray-500 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class="ri-file-list-3-line mr-3"></i>
                <span class="text-sm">Riwayat Pengaduan</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="tanggapan.php" class="text-white flex items-center py-2 px-4 hover:bg-gray-500 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class="ri-chat-1-line mr-3"></i>
                <span class="text-sm">Tanggapan & Saran</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="index.html" class="text-white flex items-center py-2 px-4 hover:bg-gray-500 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class="ri-logout-box-r-line mr-3"></i>
                <span class="text-sm">Log out</span>
            </a>
        </li>
    </ul>
</nav>

<main class="lg:ml-64 bg-gray-50">
    <button type="button" class="text-lg text-gray-600 sidebar-toggle lg:hidden pl-4 pt-2">
        <i class="ri-menu-line"></i>
    </button>

    <div class="text-center">
        <h1 class="uppercase tracking-[.25em] md:text-2xl lg:mt-10">Laporan Pengaduan</h1>
    </div>
    <div class="flex justify-center w-full bg-white">
        <form action="" method="post" enctype="multipart/form-data">
                <h1 class="mt-10 my-3">Jenis Laporan:</h1>
                <div class="grid grid-cols-2 place-items-center md:w-[480px] w-72">
                    <ul>
                        <li>
                            <input type="radio" name="jenisLaporan" id="bencana" value="Bencana">
                            <label for="bencana">Bencana</label>                            
                        </li>
                        <li>
                            <input type="radio" name="jenisLaporan" id="ketidakpuasan" value="Ketidak puasan">
                            <label for="ketidakpuasan">Ketidakpuasan</label>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <input type="radio" name="jenisLaporan" id="kekerasan" value="Kekerasan">
                            <label for="kekerasan">Kekerasan</label>                            
                        </li>
                        <li>
                            <input type="radio" name="jenisLaporan" id="kehilangan" value="Kehilangan">
                            <label for="kehilangan">Kehilangan</label>
                        </li>
                    </ul>
                </div>
                
                    
                <label class="block text-gray-600 my-3" for="judul">Judul Laporan:</label>
                <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm md:w-[480px] w-72" type="text" id="judul" name="judul" required>
                <label for="isi" class="block text-gray-600 my-3">Isi Laporan:</label>
                <textarea name="isi" id="isi" class="outline-gray-500 outline pl-3 pb-1 rounded-sm md:w-[480px] w-72" rows="5"></textarea>
                <label class="block text-gray-600 my-3 " for="foto">Bukti</label>
                <input class="rounded-sm" type="file" id="foto" name="foto">
                <label class="block text-gray-600 my-3 " for="lokasi">Lokasi Kejadian</label>
                <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm md:w-[480px] w-72" type="text" id="lokasi" name="lokasi" required>
                <label class="block text-gray-600 my-3 " for="tglKejadian">Tanggal Kejadian</label>
                <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm md:w-[480px] w-72" type="date" id="tglKejadian" name="tglKejadian" required>
                <div class="flex justify-center mt-6">
                    <button class="bg-gray-500 m-4 w-20 rounded-md py-1 md:text-xl text-white md:w-24" type="submit" name="kirim">Kirim</button>
                </div>
        </form>
    </div>
</main>

<script src="../script.js"></script>
</body>
</html>
