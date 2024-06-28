<?php

require 'functions.php';

session_start();

// if (isset($_SESSION["login"])) {
//     header("Location: index.html");
//     exit;
// // }
// if (isset($_SESSION["login"])) {
//     header("Location: dashboard.php");
//     exit;
// }

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    if($role == "admin"){
        $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");

        // cek username
        if ( mysqli_num_rows($result) === 1 ) {


            // cek password
            $row = mysqli_fetch_assoc($result);

            if(password_verify($password, $row["password"])) {

                // set session

                $_SESSION["login"] = true;
                $_SESSION["role"] = "admin";
                $_SESSION["username"] = $row["username"];

                header("Location: admin.php");
                exit;
            }
        }
    
        $error = true;
    } else {
        $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

        // cek username
        if ( mysqli_num_rows($result) === 1 ) {


            // cek password
            $row = mysqli_fetch_assoc($result);

            if(password_verify($password, $row["password"])) {

                // set session

                $_SESSION["login"] = true;
                $_SESSION["role"] = "user";
                $_SESSION["username"] = $row["username"];

                header("Location: dashboard.php");
                exit;
            }
        }
    
        $error = true;
    }

   
}

?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/final.css">
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
</head>
<body class="mx-auto mt-28 w-96">

<div class="container bg-gray-400 border-2 border-gray-400">
    <div class="flex justify-end pr-2 pt-2">
        <button class="w-8 h-8 rounded-full text-center text-xl text-white">x</button>
    </div>
    <h1 class="text-center text-white uppercase h-8 tracking-[.25em]">Login</h1>
    <div class="flex justify-center bg-white">
        <form action="" method="post">
                <label class="block text-gray-600 my-5" for="username">Username</label>
                <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72" type="text" id="username" name="username" placeholder="username" required>
                <label class="block text-gray-600 my-5 " for="password">Password</label>
                <input class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72" type="password" id="password" name="password" placeholder="password" required>
                <label class="block text-gray-600 my-5" for="password">Masuk sebagai</label>
                <select name="role" id="role" class="outline-gray-500 outline pl-3 pb-1 rounded-sm w-72">
                                <option value="">--Pilih--</option>
                                <option value="user">Pelapor</option>
                                <option value="admin">Admin</option>
                    </select>
                <div class="flex justify-center mt-6">
                    <button class="bg-gray-500 m-4 w-16 rounded-md py-1 text-white md:w-20" type="submit" name="login">Login</button>
                </div>
        </form>
    </div>
    <section class="flex justify-center bg-white">
        <p class="my-10 text-slate-800">Don't have account? <a class="text-gray-500 hover:text-slate-900" href="register.php">Register</a></p>
    </section>
</div>

</body>
</html>
