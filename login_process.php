<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("localhost", "root", "", "ppdb_igasar");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $user = $conn->real_escape_string($_POST['user']);
    $pass = $conn->real_escape_string($_POST['pass']);

    // Cek admin dulu
    $sql_admin = "SELECT id, nama_admin, password FROM admin WHERE username='$user' LIMIT 1";
    $result_admin = $conn->query($sql_admin);
    if ($result_admin && $result_admin->num_rows === 1) {
        $admin = $result_admin->fetch_assoc();
        // Jika password sudah di-hash, gunakan password_verify
        if ($pass === $admin['password']) { // Ganti dengan password_verify jika sudah hash
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

    // Jika bukan admin, cek peserta
    $sql_peserta = "SELECT id, nama FROM peserta WHERE email='$user' AND no_telp='$pass' LIMIT 1";
    $result_peserta = $conn->query($sql_peserta);
    if ($result_peserta && $result_peserta->num_rows === 1) {
        $peserta = $result_peserta->fetch_assoc();
        $_SESSION['user_id'] = $peserta['id'];
        $_SESSION['user_nama'] = $peserta['nama'];
        $_SESSION['user_level'] = 'peserta';
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('Login gagal! Data tidak ditemukan.');window.location='login.php';</script>";
        exit;
    }
    $conn->close();
} else {
    header("Location: login.php");
    exit;
}
?>