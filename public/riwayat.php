<?php
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== 'user') {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$username = $_SESSION["username"];
$pelapor = query("SELECT user_id FROM users WHERE username = '$username'");
$user_id = $pelapor[0]['user_id'];

$riwayat = query("SELECT * FROM laporan WHERE user_id = '$user_id'");

?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riwayat Pengaduan</title>
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"
  />
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
  <link rel="stylesheet" href="css/final.css">
</head>
<body class="h-screen">
<nav class="fixed bg-gray-400 w-64 left-0 top-0 h-full p-4 z-50 sidebar-menu lg:block transition-transform hidden">
    <div class="flex items-center mt-5 pb-4 border-b border-b-gray-300">
        <img src="img/profil.png" class="w-20 bg-cover rounded-full">
        <span class="text-white text-center text-lg ml-3 font-bold"><?=  $_SESSION["username"]; ?></span>

    </div>

    <ul class="mt-4">
        <li class="mb-1 group">
            <a href="dashboard.php" class="text-white flex items-center py-2 px-4 hover:bg-gray-500 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class="ri-user-line mr-3"></i>
                <span class="text-sm">Profil</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="pengaduan.php" class="text-white flex items-center py-2 px-4 hover:bg-gray-500 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class="ri-sticky-note-add-line mr-3"></i>
                <span class="text-sm">Pengaduan</span>
            </a>
        </li>
        <li class="mb-1 group active">
            <a href="#" class="text-white flex items-center py-2 px-4 hover:bg-gray-500 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
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
    <div class="flex flex-col justify-center items-center mt-20">
        <div class="bg-gray-50 border lg:w-full md:w-[600px] p-4 w-[300px] grid grid-cols-1 place-items-center">
            <h1 class="uppercase lg:mt-10">Riwayat Laporan Pengaduan</h1>
            <table class="table-fixed w-full text-left text-sm my-4 text-gray-600 border border-collapse border-slate-800">
                <thead>
                    <tr>
                        <th class="p-2 border border-slate-800 w-10">
                            No.
                        </th>
                        <th class="p-2 border border-slate-800 w-10">
                            Tgl
                        </th>
                        <th class="p-2 border border-slate-800 w-12">
                            Jenis
                        </th>
                        <th class="p-2 border border-slate-800 md:w-24 w-14">
                            Judul
                        </th>
                        <th class="p-2 border border-slate-800 w-14">
                            Ket.
                        </th>
                    </tr>            
                </thead>
                <tbody>
                    <?php foreach ($riwayat as $index => $laporan) : ?>
                        <tr>
                            <td class="p-2 border border-slate-800 truncate"><?= $index + 1 ?></td>
                            <td class="p-2 border border-slate-800 truncate"><?= $laporan['tanggal_laporan'] ?></td>
                            <td class="p-2 border border-slate-800 truncate"><?= $laporan['jenis_laporan'] ?></td>
                            <td class="p-2 border border-slate-800 truncate"><?= $laporan['judul_laporan'] ?></td>
                            <td class="p-2 border border-slate-800 truncate"><a href="detail.php?id=<?= $laporan['laporan_id'] ?>" class="text-zinc-900 hover:text-slate-500">details</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
</main>

<script src="../script.js"></script>
</body>
</html>
