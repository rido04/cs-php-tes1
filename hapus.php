<?php 
session_start();

if ( !isset($_SESSION["login"])) {
    # code...
    header("Location: index.php");
    exit;
}
require 'functions.php';
$id = $_GET["id"];


if( hapus($id) > 0) {
    echo "
        <script>
        alert('Data berhasil di hapus');
        document.location.href ='index.php';
        </script>";
        exit;
}else{
    echo "
        <script>
        alert('Data berhasil di hapus');
        document.location.href ='index.php';
        </script>";
        exit;      
}
?>