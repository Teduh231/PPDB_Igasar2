<?php
// Mulai session jika ingin menampilkan pesan sukses/gagal
session_start();

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "ppdb_igasar");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nis      = isset($_POST['nis']) ? trim($_POST['nis']) : '';
$nama     = isset($_POST['nama']) ? trim($_POST['nama']) : '';
$email    = isset($_POST['email']) ? trim($_POST['email']) : '';
$telepon  = isset($_POST['telepon']) ? trim($_POST['telepon']) : '';
$rata     = isset($_POST['rata']) ? trim($_POST['rata']) : '';
$jurusan  = isset($_POST['jurusan']) ? trim($_POST['jurusan']) : '';

// Validasi sederhana
if ($nama == '' || $email == '' || $nis == '' || $telepon == '' || $rata == '' || $jurusan == '') {
    echo "<script>alert('Semua field wajib diisi!');window.history.back();</script>";
    exit;
}

// Proses upload surat kelulusan (opsional, bisa disimpan di folder atau database)
$surat_kelulusan = null;
if (isset($_FILES['surat_kelulusan']) && $_FILES['surat_kelulusan']['error'] == UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['surat_kelulusan']['tmp_name'];
    $file_type = mime_content_type($file_tmp);
    $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
    if (in_array($file_type, $allowed_types)) {
        $surat_kelulusan = file_get_contents($file_tmp);
    } else {
        echo "<script>alert('File surat kelulusan harus berupa gambar (jpg/png)!');window.history.back();</script>";
        exit;
    }
}

// Simpan ke database
$stmt = $conn->prepare("INSERT INTO pendaftaran (nis, nama, email, telepon, rata, jurusan, surat_kelulusan) VALUES (?, ?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}
$stmt->bind_param("sssssss", $nis, $nama, $email, $telepon, $rata, $jurusan, $surat_kelulusan);

if ($stmt->execute()) {
    echo "<script>alert('Pendaftaran berhasil!');window.location='pendaftaran.php';</script>";
} else {
    echo "<script>alert('Pendaftaran gagal!');window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>