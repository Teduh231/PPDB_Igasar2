<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("localhost", "root", "", "ppdb_igasar");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Pastikan ada tabel admin dengan kolom username dan password (hash lebih baik)
    $sql = "SELECT id, nama_admin, password FROM admin WHERE username='$username' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        // Jika password sudah di-hash, gunakan password_verify
        if ($password === $admin['password']) { // Ganti jadi password_verify jika sudah hash
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_nama'] = $admin['nama_admin'];
            $_SESSION['user_level'] = 'admin';
            header("Location: admin_panel.php");
            exit;
        } else {
            echo "<script>alert('Password salah!');window.location='login.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Akun admin tidak ditemukan!');window.location='login.php';</script>";
        exit;
    }
    $conn->close();
} else {
    header("Location: login.php");
    exit;
}
?>