<?php
$koneksi = new mysqli("localhost", "root", "", "ppdb_igasar");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
$nis = $_POST['nis'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$telepon = $_POST['telepon'];
$rata = $_POST['rata'];
$jurusan = $_POST['jurusan'];


$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true); 
}

$foto_name = $_FILES["foto"]["name"];
$foto_tmp = $_FILES["foto"]["tmp_name"];
$foto_path = $target_dir . basename($foto_name);

if (move_uploaded_file($foto_tmp, $foto_path)) {
    $sql = "INSERT INTO pendafaran (NIS, nama, email, telepon, rata, jurusan, foto)
            VALUES ('$nis','$nama', '$email', '$telepon', '$rata', '$jurusan', '$foto_name')";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Pendaftaran berhasil!'); window.location.href='dashboard.php';</script>";
        header("Location: berhasil.php");
        exit;
    } else {
        echo "Error saat menyimpan data: " . $koneksi->error;
    }
} else {
    echo "Gagal upload foto.";
}

$koneksi->close();
?>