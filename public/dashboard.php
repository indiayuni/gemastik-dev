<?php
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== 'user') {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$username = $_SESSION["username"];

$pelapor = query("SELECT * FROM users WHERE username = '$username'");

?>

<!doctype html>
<html class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"
/>
   <link rel="stylesheet" href="css/final.css">
   <!-- <script src="https://cdn.tailwindcss.com"></script> -->
</head>
<body class="lg:h-full relative">
<nav class="fixed bg-gray-400 w-64 left-0 top-0 h-full p-4 z-50 sidebar-menu lg:block transition-transform hidden">
    <div class="flex items-center mt-5 pb-4 border-b border-b-gray-300">
        <img src="img/profil.png" class="w-20 bg-cover rounded-full">
        <span class="text-white text-center text-lg ml-3 font-bold"><?= $username; ?></span>


    </div>

    <ul class="mt-4">
        <li class="mb-1 group active">
            <a href="#" class="text-white flex items-center py-2 px-4 hover:bg-gray-500 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class="ri-user-line mr-3"></i>
                <span class="text-sm">profil</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="pengaduan.php" class="text-white flex items-center py-2 px-4 hover:bg-gray-500 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class="ri-sticky-note-add-line mr-3"></i>
                <span class="text-sm">Pengaduan</span>
                <!-- <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i> -->
            </a>
            <!-- <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                <li class="mb-4">
                    <a href="#" class="text-sm text-white flex items-center hover:text-gray-600 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Buat Pengaduan</a>
                </li>
                <li class="mb-4">
                    <a href="#" class="text-sm text-white flex items-center hover:text-gray-600 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Daftar Pengaduan</a>
                </li>
            </ul> -->
        </li>
        <li class="mb-1 group">
            <a href="riwayat.php" class="text-white flex items-center py-2 px-4 hover:bg-gray-500 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class="ri-file-list-3-line mr-3"></i>
                <span class="text-sm">Riwayat Pengaduan</span>
            </a>
        </li>
        <li class="mb-1">
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

    <div class="grid place-items-center lg:grid-cols-2 lg:pr-10">
        <div class="lg:w-52">
            <img src="img/profil.png" alt="" class="lg:w-40 w-64 bg-cover lg:rounded-full">
        </div>
        <div class="lg:ml-5">
            <div class="my-2 ml-4 flex lg:justify-end">
                <a href="#" class="bg-gray-600 text-white px-2 py-1 rounded-lg mr-4">Edit</a>
            </div>

            <table class="text-left ml-4 lg:ml-0">
                <tr>
                    <th>
                        <label class="text-gray-600" for="nmLengkap">Nama Lengkap</label>:
                    </th>
                    <td>
                        <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72 ml-2 my-5" type="text" id="nmLengkap" name="nmLengkap" value="<?= $pelapor[0]["nama_lengkap"];?>" required disabled>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label class="text-gray-600" for="umur">Umur</label>:
                    </th>
                    <td>
                        <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72 ml-2" type="number" id="umur" name="umur" value="<?= $pelapor[0]["umur"];?>" required disabled>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label class="text-gray-600" for="jk">Jenis Kelamin</label>:
                    </th>
                    <td>
                        <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72 ml-2 my-5" type="text" id="jk" name="jk" value="<?= $pelapor[0]["jenis_kelamin"];?>" required disabled>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label class="text-gray-600" for="pekerjaan">Pekerjaan</label>:
                    </th>
                    <td>
                        <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72 ml-2" type="text" id="pekerjaan" name="pekerjaan" value="<?= $pelapor[0]["pekerjaan"];?>" required disabled>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label class="text-gray-600" for="alamat">Alamat</label>:
                    </th>
                    <td>
                        <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72 ml-2 my-5" type="text" id="alamat" name="alamat" value="<?= $pelapor[0]["alamat"];?>" required disabled>
                    </td>
                </tr>
            </table>
            
        </div>
    </div>

     <div class="grid place-items-center lg:grid-cols-2 gap-10 mt-20 lg:ml-6 p-4">
        <table class="text-left pr-4 text-gray-600">
            <tr>
                <th>
                    <label for="total">Total Pengaduan</label>:
                </th>
               <td>
                    <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72 ml-2 my-5" type="text" id="total" name="total" required disabled>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="diterima">Jumlah Laporan Diterima</label>:
                </th>
                <td>
                    <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72 ml-2" type="number" id="diterima" name="diterima" required disabled>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="ditolak">Jumlah Laporan Ditolak</label>:
                </th>
                <td>
                    <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72 ml-2 my-5" type="text" id="ditolak" name="ditolak" required disabled>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="status">Status</label>:
                </th>
                <td>
                    <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72 ml-2" type="text" id="status" name="status" required disabled>
                </td>
            </tr>
        </table>
        <div>
            <h1 class="font-semibold text-lg mb-3">Keterangan</h1>
            <ul class="font-normal space-y-4">
                <li>Aktif:<span class="text-gray-500"> Jumlah pengaduan > 10, perbulan</span></li>
                <li>Pasif:<span class="text-gray-500"> Jumlah pengaduan < 10, perbulan</span></li>
                <li>1 - 3 bulan:<span class="text-gray-500"> Anggota yang tidak menyampaikan pengaduan < 3 bulan</span></li>
                <li>1 bulan:<span class="text-gray-500"> Anggota yang tidak menyampaikan pengaduan > 1 bulan</span></li>
            </ul>
        </div>
     </div>
</main>



<script src="../script.js"></script>
</body>
</html>