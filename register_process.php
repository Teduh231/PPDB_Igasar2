<?php
// Proses pendaftaran user baru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("localhost", "root", "", "ppdb_igasar");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $nama = $conn->real_escape_string($_POST['nama']);
    $email = $conn->real_escape_string($_POST['email']);
    $no_telp = $conn->real_escape_string($_POST['no_telp']);

    // Cek apakah email sudah terdaftar
    $cek = $conn->query("SELECT id FROM peserta WHERE email='$email'");
    if ($cek && $cek->num_rows > 0) {
        echo "<script>alert('Email sudah terdaftar!');window.location='register.php';</script>";
        exit;
    }

    $sql = "INSERT INTO peserta (nama, email, no_telp) VALUES ('$nama', '$email', '$no_telp')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pendaftaran berhasil! Silakan login.');window.location='login.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan.');window.location='register.php';</script>";
    }
    $conn->close();
} else {
    header("Location: register.php");
    exit;
}

?>