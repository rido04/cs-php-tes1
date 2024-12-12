<?php  
session_start();

if ( !isset($_SESSION["login"])) {
    # code...
    header("Location: index.php");
    exit;
}
require 'functions.php';
if(isset($_POST["submit"])){
   
    // validasi data masuk atau tidak
    
    if (tambah ($_POST) > 0){
        echo "
        <script>
        alert('Data berhasil di tambah');
        document.location.href ='index.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal di tambah')
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data</title>
</head>
<body>
    <h1>Tambah data pelayanan</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label for="pelayanan">Jenis Pelayanan</label>
                <input type="text" name="pelayanan" id="pelayanan" required autofocus autocomplete="off" placeholder="Masukkan Data Baru...">
            </li>
            <li>
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" required autocomplete="">
            </li>
            <li>
                <label for="jam">jam</label>
                <input type="time" name="jam" id="jam" required>
            </li>
            <li>
                <button type="submit" name="submit">Tambah Data</button>
            </li>
        </ul>
    </form>
</body>
</html>