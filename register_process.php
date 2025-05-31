<?php
session_start();
// Proses pendaftaran user baru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("localhost", "root", "", "ppdb_igasar");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $nama = $conn->real_escape_string($_POST['nama']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; // Ambil password apa adanya (plain text)

    // Simpan password tanpa hash (plain text)
    $sql = "INSERT INTO peserta (nama, email, password) VALUES ('$nama', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registrasi berhasil! Silakan login.');window.location='login.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal: " . $conn->error . "');window.location='register.php';</script>";
    }
    $conn->close();
} else {
    header("Location: register.php");
    exit;
}
?>