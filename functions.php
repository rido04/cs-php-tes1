<?php 
$conn = mysqli_connect("localhost", "root", "12345", "staffcs");


function query ($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    // $result = mysqli_query($conn, $query);
    $rows=[];
    
    while($row = mysqli_fetch_assoc($result)){
        $rows[]=$row;
    }
    return $rows;
}



function tambah($data){
    global $conn;

     // ambil data dari tiap elemen form dengan menyimpan ke dalam variabel terlebih dahulu
     $pelayanan = htmlspecialchars($data["pelayanan"]);
     $tanggal = htmlspecialchars($data["tanggal"]);
     $jam = htmlspecialchars($data["jam"]);

     // query buat insert data
    $query = "INSERT INTO pelayanan (jenis_pelayanan, tanggal, jam)
    VALUES
    ('$pelayanan', '$tanggal', '$jam')
    ";
mysqli_query($conn, $query); 
 
return mysqli_affected_rows($conn);
}

//  function buat hapus data
function hapus($id){
    global $conn;                                                      
    mysqli_query($conn, "DELETE FROM pelayanan WHERE id=$id");

    return mysqli_affected_rows($conn); 
}

function Ubah($data){
    global $conn;

    if (!isset($data['id'], $data['pelayanan'], $data['tanggal'], $data['jam'])) {
        echo "Data tidak lengkap!";
        return false; // Hentikan eksekusi jika data tidak lengkap
    }

    // ambil data dari tiap elemen form dengan menyimpan ke dalam variabel terlebih dahulu
    $id = htmlspecialchars($data["id"]);
    $pelayanan = htmlspecialchars($data["pelayanan"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    $jam = htmlspecialchars($data["jam"]);

    // query buat insert data
   $query = "UPDATE pelayanan 
          SET jenis_pelayanan = '$pelayanan', 
              tanggal = '$tanggal', 
              jam = '$jam' 
          WHERE id = $id";
mysqli_query($conn, $query); 

return mysqli_affected_rows($conn);

}

// Function untuk sistem pencarian database
function cari($data) {
    global $conn;

    // Deklarasi variabel untuk setiap field pencarian
    $jenis = isset($data['jenis']) ? htmlspecialchars($data['jenis']) : '';
    $tanggal = isset($data['tanggal']) ? htmlspecialchars($data['tanggal']) : '';
    $jam = isset($data['jam']) ? htmlspecialchars($data['jam']) : '';

    // Query pencarian
    $query = "SELECT * FROM pelayanan WHERE 
              jenis_pelayanan LIKE '%$jenis%' AND
              tanggal LIKE '%$tanggal%' AND
              jam LIKE '%$jam%'";

    return query($query);
}


function registrasi($data){
    global $conn;

    // ambil data dari form
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // Cek apakah username sudah terdaftar
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)){
        echo "<script> alert('Username Sudah Terdaftar') </script>";
        return false;  // Hentikan eksekusi kalau username sudah ada
    }

    // Cek password dan konfirmasi password cocok
    if ($password !== $password2){
        echo "<script> alert('Password Tidak Sesuai') </script>";
        return false;  // Hentikan eksekusi jika password tidak cocok
    }

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data users baru ke database
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    mysqli_query($conn, $query);

    // Cek apakah data berhasil disimpan
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script> alert('User Baru Berhasil ditambahkan') </script>";
    } else {
        echo "<script> alert('Gagal menambahkan users baru') </script>";
    }

    return mysqli_affected_rows($conn); // Mengembalikan hasil eksekusi query
}

?>