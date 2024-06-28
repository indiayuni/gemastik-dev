<?php 

require 'functions.php';


if ( isset($_POST["register"]) ) {

    if( tambahUser($_POST) > 0 ) {
        echo "<script>
            alert('berhasil daftar!');
        </script>";
    } else {
        $error = "masukkan data dengan benar";
        // echo mysqli_affected_rows($conn);
        echo $error;
    }
}


?>


<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
    <link rel="stylesheet" href="css/style.css">  
     <!-- <script src="https://cdn.tailwindcss.com"></script> -->
</head>
<body class="w-[900px] mx-auto">

<div class="bg-gray-400 border-2 border-gray-400">
    <h1 class="flex items-center justify-center text-white uppercase h-16 tracking-[.25em]">Sign In</h1>
    <form action="" method="post" enctype="multipart/form-data">
    <div class="grid md:grid-cols-2 gap-2 bg-white">
        <div class="flex justify-center">
            <div>
                <table class="mt-10 text-left">
                    <tr>
                        <th>
                            <label class="text-gray-600" for="nmLengkap">Nama Lengkap</label>:
                        </th>
                        <td>
                            <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72 ml-2 my-5" type="text" id="nmLengkap" name="nmLengkap" placeholder="nama lengkap" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label class="text-gray-600" for="umur">Umur</label>:
                        </th>
                        <td>
                            <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72 ml-2" type="number" id="umur" name="umur" placeholder="umur" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label class="text-gray-600" for="jk">Jenis Kelamin</label>:
                        </th>
                        <td>
                            <select name="jk" id="jk" class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72 ml-2 my-5">
                                <option value="">--Pilih--</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label class="text-gray-600" for="pekerjaan">Pekerjaan</label>:
                        </th>
                        <td>
                            <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72 ml-2" type="text" id="pekerjaan" name="pekerjaan" placeholder="pekerjaan" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label class="text-gray-600" for="alamat">Alamat</label>:
                        </th>
                        <td>
                            <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72 ml-2 my-5" type="text" id="alamat" name="alamat" placeholder="alamat" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label class="text-gray-600" for="foto">Foto</label>:
                        </th>
                        <td>
                            <input type="file" id="foto" name="foto" class="pl-2">
                        </td>
                    </tr>
                </table>
            </div>
            <!-- </form> -->
        </div>
        <div class="flex justify-center mt-8 ml-2">
            <div>
            <!-- <form action="" method="post"> -->
                    <label class="block text-gray-600 my-3" for="username">Username</label>
                    <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72" type="text" id="username" name="username" placeholder="username" required>
                    <label class="block text-gray-600 my-3 " for="password">Password</label>
                    <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72" type="password" id="password" name="password" placeholder="password" required>
                    <label class="block text-gray-600 my-3 " for="password2">Confirm Password</label>
                    <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72" type="password" id="password2" name="password2" placeholder="confirm password" required>
                    <label class="block text-gray-600 my-3 " for="role">Daftar sebagai:</label>
                    <select name="role" id="role" class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72">
                                <option value="">--Pilih--</option>
                                <option value="user">Pelapor</option>
                    </select>
                    <div class="flex justify-center mt-6">
                        <button class="bg-gray-500 m-4 w-20 rounded-md py-1 text-white md:w-20" type="submit" name="register">Register</button>
                    </div>
            </div>
        </div>
    </div>
</form>
    <section class="flex justify-center bg-white">
        <p class="my-10 text-slate-800">Already have account? <a class="text-gray-500 hover:text-slate-900" href="login.php">Login</a></p>
    </section>
</div>

</body>
</html>