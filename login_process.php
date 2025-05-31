<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("localhost", "root", "", "ppdb_igasar");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $user = $conn->real_escape_string($_POST['user']);
    $pass = $_POST['pass'];

    // Cek admin dulu
    $sql_admin = "SELECT id, nama_admin, password FROM admin WHERE username='$user' LIMIT 1";
    $result_admin = $conn->query($sql_admin);
    if ($result_admin && $result_admin->num_rows === 1) {
        $admin = $result_admin->fetch_assoc();
        // Password admin tanpa hash
        if ($pass === $admin['password']) {
            $_SESSION['user_id'] = $admin['id'];
            $_SESSION['user_nama'] = $admin['nama_admin'];
            $_SESSION['user_level'] = 'admin';
            header("Location: dashboard.php");
            exit;
        } else {
            echo "<script>alert('Password admin salah!');window.location='login.php';</script>";
            exit;
        }
    }

    // Proses login peserta (password biasa, bukan hash)
    $sql_peserta = "SELECT id, nama, password FROM peserta WHERE email='$user' LIMIT 1";
    $result_peserta = $conn->query($sql_peserta);
    if ($result_peserta && $result_peserta->num_rows === 1) {
        $peserta = $result_peserta->fetch_assoc();
        if ($pass === $peserta['password']) {
            $_SESSION['user_id'] = $peserta['id'];
            $_SESSION['user_nama'] = $peserta['nama'];
            $_SESSION['user_level'] = 'peserta';
            header("Location: dashboard.php");
            exit;
        } else {
            echo "<script>alert('Password peserta salah!');window.location='login.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Email peserta tidak ditemukan!');window.location='login.php';</script>";
        exit;
    }
    $conn->close();
} else {
    header("Location: login.php");
    exit;
}
?>