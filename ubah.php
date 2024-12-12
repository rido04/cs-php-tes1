<?php  
session_start();

if ( !isset($_SESSION["login"])) {
    # code...
    header("Location: index.php");
    exit;
}
require 'functions.php';

// Ambil data di URL
$id = $_GET["id"];

// Query data pelayanan berdasarkan ID
$pelayanan = query("SELECT * FROM pelayanan WHERE id = $id")[0];

// Cek apakah tombol submit ditekan
if (isset($_POST["submit"])) {
    // Validasi data apakah sudah diubah
    if (ubah($_POST) > 0) {
        echo "
        <script>
        alert('Data berhasil diubah');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo "
        <script>
        alert('Data gagal diubah');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data</title>
</head>
<body>
    <h1>Ubah Data Pelayanan</h1>

    <form action="" method="post">
        <!-- Input ID (hidden) -->
        <input type="hidden" name="id" id="id" value="<?= $pelayanan['id']; ?>">

        <ul>
            <!-- Jenis Pelayanan -->
            <li>
                <label for="pelayanan">Jenis Pelayanan</label>
                <input type="text" name="pelayanan" id="pelayanan" required 
                       value="<?= $pelayanan['jenis_pelayanan']; ?>">
            </li>
            
            <!-- Tanggal -->
            <li>
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" required 
                       value="<?= $pelayanan['tanggal']; ?>">
            </li>
            
            <!-- Jam -->
            <li>
                <label for="jam">Jam</label>
                <input type="time" name="jam" id="jam" required 
                       value="<?= $pelayanan['jam']; ?>">
            </li>
            
            <!-- Tombol Submit -->
            <li>
                <button type="submit" name="submit">Ubah Data</button>
            </li>
        </ul>
    </form>
</body>
</html>
