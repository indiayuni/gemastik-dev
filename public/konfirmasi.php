<?php
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== 'user') {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$pelapor = query("SELECT * FROM users");

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

<main class="lg:ml-64">
    <button type="button" class="text-lg text-gray-600 sidebar-toggle lg:hidden pl-4 pt-2">
        <i class="ri-menu-line"></i>
    </button>

    <div class="flex flex-col justify-center items-center mt-20">
        <div class="bg-gray-50 border md:w-[600px] p-4 w-[300px] grid grid-cols-1 place-items-center">
            <h1 class="uppercase lg:mt-10">Judul Laporan Pengaduan</h1>
            <table class="text-left md:text-base text-sm my-4 text-gray-600">
                <tr>
                    <th>
                        <label for="pengirim">Pengirim:</label>
                    </th>
                    <td>
                        <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-52 md:w-72 md:ml-2 my-5" type="text" id="pengirim" name="pengirim" required disabled>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="jenis">Jenis:</label>
                    </th>
                    <td>
                        <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-52 md:w-72 md:ml-2" type="text" id="jenis" name="jenis" required disabled>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="isi">Isi:</label>
                    </th>
                    <td>
                        <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-52 md:w-72 md:ml-2 my-5" type="text" id="isi" name="isi" required disabled>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="bukti">Bukti:</label>
                    </th>
                    <td>
                        <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-52 md:w-72 md:ml-2 mb-5" type="text" id="bukti" name="bukti" required disabled>
                    </td>
                </tr>
            </table>
            <div class="flex justify-between w-80 md:w-96">
                <button class="bg-gray-500 m-4 md:w-20 rounded-md py-1 w-14 text-white" type="submit" name="batal">Batal</button>
                <button class="bg-gray-500 m-4 md:w-20 rounded-md py-1 w-14 text-white" type="submit" name="kirim">Kirim</button>
            </div>
        </div>
    </div>
    
</main>

<script src="../script.js"></script>
</body>
</html>
