<?php
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== 'admin') {
    header("Location: login.php");
    exit;
}
require 'functions.php';

$username = $_SESSION["username"];

$pelapor = query("SELECT * FROM users WHERE username = '$username'");


?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="css/final.css">
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
</head>
<body class="h-screen">
<nav class="fixed bg-gray-400 w-64 left-0 top-0 h-full p-4 z-50 sidebar-menu lg:block transition-transform hidden">
    <div class="flex mt-5 pb-4 border-b border-b-gray-300">
        <span class="text-white text-lg md:text-xl ml-3 font-bold">Admin</span>
    </div>

    <ul class="mt-4">
        <li class="mb-1 group">
            <a href="admin.php" class="text-white flex items-center py-2 px-4 hover:bg-gray-500 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class="ri-user-line mr-3"></i>
                <span class="text-sm">Pengguna</span>
            </a>
        </li>
        <li class="mb-1 group active">
            <a href="#" class="text-white flex items-center py-2 px-4 hover:bg-gray-500 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class="ri-shield-check-line mr-3"></i>
                <span class="text-sm">Verifikasi Pengaduan</span>
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

        
    <div class="flex flex-col justify-center items-center">
        <div class="bg-gray-50 border md:w-full p-4 w-[350px] grid grid-cols-1 place-items-center ml-2">
            <h1 class="uppercase tracking-[.25em] md:text-2xl lg:mt-10">Laporan Pengaduan</h1>
            <table class="table-fixed w-full text-left text-sm my-4 text-gray-600 border border-collapse border-slate-800">
                <thead>
                    <tr class="md:text-center">
                        <th class="p-2 border border-slate-800 w-6">
                            No.
                        </th>
                        <th class="p-2 border border-slate-800 w-8">
                            Nama
                        </th>
                        <th class="p-2 border border-slate-800 w-16">
                            Judul
                        </th>
                        <th class="p-2 border border-slate-800 md:w-24 w-10">
                            Isi
                        </th>
                        <th class="p-2 border border-slate-800 w-10">
                            do
                        </th>
                    </tr>            
                </thead>
                <tbody>
                    <tr>
                        <td class="p-2 border border-slate-800 truncate text-center">1</td>
                        <td class="p-2 border border-slate-800 truncate">12/10/22</td>
                        <td class="p-2 border border-slate-800 truncate">kekerasan</td>
                        <td class="p-2 border border-slate-800 truncate">melapri dvvvvvvvvvvvvvllddd ffggg fkf</td>
                        <td class="p-2 border border-slate-800 truncate text-center"><a href="edit.html" class="text-zinc-900 hover:text-slate-500">edit</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script src="../script.js"></script>
</body>
</html>
