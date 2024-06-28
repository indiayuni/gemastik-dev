<?php
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== 'user') {
    header("Location: login.php");
    exit;
}

require 'functions.php';

// Pastikan id laporan sudah diterima dari parameter GET
if (!isset($_GET['id'])) {
    header("Location: riwayat.php"); // Redirect jika id tidak ada
    exit;
}

$id_laporan = $_GET['id'];
$laporan = query("SELECT * FROM laporan WHERE laporan_id = '$id_laporan'");

// Pastikan laporan dengan id yang diberikan ada di database
if (!$laporan) {
    header("Location: riwayat.php"); // Redirect jika id tidak ditemukan
    exit;
}

// Ambil data laporan dari hasil query
$detail_laporan = $laporan[0]; // Ambil data pertama, asumsi id unik

?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Konfirmasi Pengaduan</title>
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
        <span class="text-white text-center text-lg ml-3 font-bold"><?=  $_SESSION["username"] ?></span>

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
    <div class="flex flex-col justify-center items-center mt-20">
        <div class="bg-gray-50 border lg:w-full md:w-[600px] p-4 w-[300px] grid grid-cols-1 place-items-center">
            <h1 class="uppercase lg:mt-10">Detail Laporan Pengaduan</h1>
            <table class="table-fixed w-full text-left text-sm my-4 text-gray-600 border border-collapse border-slate-800">
                <tr>
                    <th class="p-2 border border-slate-800 w-24">
                        Pengirim
                    </th>
                    <td class="p-2 border border-slate-800">
                        <?= $_SESSION['username']; ?>
                    </td>
                </tr>
                <tr>
                    <th class="p-2 border border-slate-800">
                        Tanggal Laporan
                    </th>
                    <td class="p-2 border border-slate-800">
                        <?= htmlspecialchars($detail_laporan['tanggal_laporan']) ?>
                    </td>
                </tr>
                <tr>
                    <th class="p-2 border border-slate-800">
                        Jenis Laporan
                    </th>
                    <td class="p-2 border border-slate-800">
                        <?= htmlspecialchars($detail_laporan['jenis_laporan']) ?>
                    </td>
                </tr>
                <tr>
                    <th class="p-2 border border-slate-800">
                        Judul
                    </th>
                    <td class="p-2 border border-slate-800">
                        <?= htmlspecialchars($detail_laporan['judul_laporan']) ?>
                    </td>
                </tr>
                <tr>
                    <th class="p-2 border border-slate-800">
                        Isi Laporan
                    </th>
                    <td class="p-2 border border-slate-800">
                        <?= htmlspecialchars($detail_laporan['isi_laporan']) ?>
                    </td>
                </tr>
                <tr>
                    <th class="p-2 border border-slate-800">
                        Status
                    </th>
                    <!-- <td class="p-2 border border-slate-800">
                        <?= htmlspecialchars($detail_laporan['status']) ?>
                    </td> -->
                </tr>
            </table>
            <div class="flex justify-start bg-slate-500 rounded-full py-1 px-2 w-8"><a href="riwayat.php"><i class="ri-arrow-left-line text-white"></i></a></div>
        </div>
    </div>
</main>

<script src="../script.js"></script>
</body>
</html>
