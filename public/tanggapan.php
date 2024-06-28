<?php
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== 'user') {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$username = $_SESSION[ "username" ];

if ( isset($_POST["kirim"]) ) {

    if( saran($_POST) > 0 ) {
        echo "<script>
            alert('berhasil mengirim saran');
        </script>";
    } else {
        echo mysqli_affected_rows($conn);
    }
}

$user_id = query("SELECT user_id FROM users WHERE username = '$username'")[0]['user_id'];
$saran_list = query("SELECT * FROM saran WHERE user_id = '$user_id'");

?>


<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tanggapan dan Saran</title>
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
        <span class="text-white text-center text-lg ml-3 font-bold"><?=  $username; ?></span>

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
        <li class="mb-1 group">
            <a href="riwayat.php" class="text-white flex items-center py-2 px-4 hover:bg-gray-500 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class="ri-file-list-3-line mr-3"></i>
                <span class="text-sm">Riwayat Pengaduan</span>
            </a>
        </li>
        <li class="mb-1 group active">
            <a href="#" class="text-white flex items-center py-2 px-4 hover:bg-gray-500 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
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
    <form action="#" method="post" class="flex flex-col items-center w-full">
        <div class="flex flex-col items-center lg:mt-10">
            <ul>
                <li class="w-full">
                    <span for="rating" class="block text-center">Penilaian Anda Terhadap Sistem Kami</span>
                </li>
                <div class="text-center rating mb-5">
                    <input type="radio" name="rating" id="1" class="hidden"><label for="1" value="1"><i class="ri-star-line star hover:text-xl cursor-pointer"></i></label>
                    <input type="radio" name="rating" id="2" class="hidden"><label for="2" value="2"><i class="ri-star-line star hover:text-xl cursor-pointer"></i></label>
                    <input type="radio" name="rating" id="3" class="hidden"><label for="3" value="3"><i class="ri-star-line star hover:text-xl cursor-pointer"></i></label>
                    <input type="radio" name="rating" id="4" class="hidden"><label for="4" value="4"><i class="ri-star-line star hover:text-xl cursor-pointer"></i></label>
                    <input type="radio" name="rating" id="5" class="hidden"><label for="5" value="5"><i class="ri-star-line star hover:text-xl cursor-pointer"></i></label>
                </div>
            </ul>
            <ul>
                <li >
                    <label for="saran" class="block mb-4">Berikan Saran Anda</label>
                    <textarea name="saran" id="saran" class="rounded-md md:w-[600px] resize-none p-2 outline outline-slate-600" cols="30" rows="5" placeholder="Your Opinion..."></textarea>
                </li>
            </ul>
            <div class="flex justify-center mb-6">
                    <button class="bg-gray-500 m-4 w-20 rounded-md py-1 md:text-xl text-white md:w-24" type="submit" name="kirim">Kirim</button>
            </div>
        </div>
    </form>
    <div class="flex flex-col items-center">
            <table class="border-collapse border border-slate-500 md:w-[600px] w-64 mb-10">
                <thead>
                    <tr class="border-collapse border border-slate-500">
                        <th class="p-1 border border-slate-800">No</th>
                        <th class="p-1 border border-slate-800 text-center">Riwayat Saran Anda</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                <?php foreach ($saran_list as $saran): ?>
                <tr>
                    <td class="p-1"><?= $i; ?></td>
                    <td class="p-1"><?= htmlspecialchars($saran['isi_saran']); ?></td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
    </div>
</main>

<script src="../script.js"></script>
</body>
</html>
