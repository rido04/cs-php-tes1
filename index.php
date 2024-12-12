<?php 
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

// pagination
// konfigurasi
$jumlahDataPerHalaman = 5 ;
$jumlahData = count(query("SELECT*FROM pelayanan"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"]) ? $_GET["halaman"] : 1 );
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


$pelayanan = query("SELECT*FROM pelayanan LIMIT $awalData, $jumlahDataPerHalaman");

// tombol cari ditekan
if (isset($_POST["cari"])) {
    $pelayanan = cari($_POST);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel</title>
</head>
<body>
<a href="logout.php">Log out</a>
<h1>Daftar Pelayanan</h1>

<a href="tambah.php">Tambah data pelayanan</a>
<br><br>
<form action="" method="post">
    <label for="jenis">Cari Berdasarkan Jenis Pelayanan</label>
    <input type="text" name="jenis" id="jenis" autofocus placeholder="Masukkan Jenis Pelayanan..." autocomplete="off">
    
    <label for="tanggal">Cari Berdasarkan Tanggal</label>
    <input type="date" name="tanggal" id="tanggal">
    
    <label for="jam">Cari Berdasarkan Jam</label>
    <input type="time" name="jam" id="jam">
    
    <button type="submit" name="cari">Cari</button>
</form>
<br>
<!-- Navigasi Halaman -->
 <!-- untuk tanda "<" -->
<?php if($halamanAktif > 1):?>
<a href="?halaman=<?= $halamanAktif - 1;?>">&lt;</a>
<?php endif;?>

<!-- menampilkan halaman terkini dengan style bold red -->
 <?php for($i= 1; $i <= $jumlahHalaman; $i++) :?>
    <?php if( $i == $halamanAktif ):?>
    <a href="?halaman=<?= $i;?>" style="font-weight: bold; color: red;"><?= $i;?></a>
    <?php else:?>
        <a href="?halaman=<?= $i;?>"><?= $i; ?></a>
    <?php endif;?>
<?php endfor; ?>

<!-- untuk tanda ">" -->
<?php if($halamanAktif < $jumlahHalaman):?>
<a href="?halaman=<?= $halamanAktif + 1; ?>">&gt;</a>
<?php endif;?>
<br><br>
<table border="1" cellpadding="10" cellspacing="1">
    <tr>
        <th>No</th>
        <th>Aksi</th>
        <th>Pelayanan</th>
        <th>Tanggal</th>
        <th>Jam</th>
    </tr>
    <?php $i=1;?>
    <?php foreach($pelayanan as $row):?>
    <tr>
        <td><?= $i;?></td>
        <td> <a href="ubah.php?id=<?=$row["id"]; ?>">Ubah</a>|
        <a href="hapus.php?id=<?=$row["id"]; ?>">Hapus</a> </td>
        <td><?=$row["jenis_pelayanan"];?></td>
        <td><?= $row["tanggal"];?></td>
        <td><?=$row["jam"]; ?></td>
    </tr>
    <?php $i++;?>
    <?php endforeach;?> 
</table>
    
</body>
</html>