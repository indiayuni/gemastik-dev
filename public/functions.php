<?php 
// koneksi ke db
$conn = mysqli_connect("localhost", "root", "", "devspark");


function query ($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}



function tambahUser($data){
    global $conn;

    // ambil data dari tiap elemen dari form
    // htmlspecialchars() digunakan untuk menghindari user yang iseng dalam memasuki data
    $nmLengkap = htmlspecialchars($data["nmLengkap"]);
    $umur = ($data["umur"]);
    $jnsKelamin = ($data["jk"]);
    $pekerjaan = htmlspecialchars($data["pekerjaan"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $foto = $_FILES['foto'];
    $username = strtolower( stripslashes($data["username"]) );
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $role = ($data["role"]);

    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    if( mysqli_fetch_assoc($result) ) {
        echo "<script>
                alert('username sudah terdaftar!');
            </script>";
        return false;
    } 
    

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('password tidak sama');
            </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);


    // upload gambar
    $foto = upload();
    if ( !$foto ) {
        return false;
    }
    
    // query insert data
    $query = "INSERT INTO users VALUES ('', '$nmLengkap','$umur', '$jnsKelamin', '$pekerjaan', '$alamat', '$foto', '$username', '$password', '$role')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}



function pengaduan($data){
    global $conn;

    $jnsLaporan = htmlspecialchars($data["jenisLaporan"]);
    $judul = htmlspecialchars($data["judul"]);
    $isi = htmlspecialchars($data["isi"]);
    $lokasi = htmlspecialchars($data["lokasi"]);
    $tglKejadian = htmlspecialchars($data["tglKejadian"]);
    $tanggal_pelaporan = date("Y-m-d H:i:s");


    // Ambil user_id dari session
    // session_start();
    $username = $_SESSION["username"];
    $pelapor = query("SELECT user_id FROM users WHERE username = '$username'");
    $user_id = $pelapor[0]['user_id'];

    // Query insert data ke tabel laporan
    $query = "INSERT INTO laporan VALUES ('', '$user_id', '$jnsLaporan', '$judul', '$isi', '$tglKejadian', '$lokasi', '$tanggal_pelaporan')";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function saran($data){
    global $conn;

    $rating = $data["rating"];
    $saran = htmlspecialchars($data["saran"]);
    $tanggal_saran = date("Y-m-d H:i:s");

    
    $username = $_SESSION["username"];
    $pelapor = query("SELECT user_id FROM users WHERE username = '$username'");
    $user_id = $pelapor[0]['user_id'];

    // Query insert data ke tabel laporan
    $query = "INSERT INTO saran VALUES ('', '$user_id', '$rating', '$saran', '$tanggal_saran')";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function upload() {
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar2 = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar2, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
            </script>";
        return false;
    }

    if ($ukuranFile > 1000000) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
            </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar2;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}


function ubah ($data) {
    global $conn;

    $id = $data["id"];

    $nrp = htmlspecialchars($data["nrp"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar']['error'] === 4 ){
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
    
    
    // query update data
    $query = "UPDATE mahasiswa SET 
        nrp = '$nrp', nama = '$nama', email = '$email', jurusan = '$jurusan', gambar = '$gambar'
        WHERE id = $id
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword){
    $query = "SELECT * FROM mahasiswa 
                WHERE
            nama LIKE '%$keyword%' OR
            nrp LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%' OR
            email LIKE '%$keyword%' 
            ";
    
    return query($query);
}

function registrasi($data) {
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $role = htmlspecialchars($data["role"]);
    $username = strtolower( stripslashes($data["username"]) );
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM admin WHERE username = '$username'");

    if( mysqli_fetch_assoc($result) ) {
        echo "<script>
                alert('username sudah terdaftar!');
            </script>";
        return false;
    } 
    

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('password tidak sama');
            </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO admin VALUE('', '$nama', '$username', '$password', '$role')");
    return mysqli_affected_rows($conn);

}



?>