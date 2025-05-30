<?php
session_start();
if (!isset($_SESSION['user_level']) || $_SESSION['user_level'] !== 'admin') {
    // Redirect non-admin user to dashboard or show forbidden message
    header("Location: dashboard.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "ppdb_igasar");
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

// DELETE
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $conn->query("DELETE FROM peserta WHERE id=$id");
    header("Location: data_peserta.php");
    exit;
}

// UPDATE
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $nis = $conn->real_escape_string($_POST['nis']);
    $nama = $conn->real_escape_string($_POST['nama']);
    $email = $conn->real_escape_string($_POST['email']);
    $telepon = $conn->real_escape_string($_POST['telepon']);
    $rata = $conn->real_escape_string($_POST['rata']);
    $jurusan = $conn->real_escape_string($_POST['jurusan']);
    $conn->query("UPDATE peserta SET nis='$nis', nama='$nama', email='$email', telepon='$telepon', rata='$rata', jurusan='$jurusan' WHERE id=$id");
    header("Location: data_peserta.php");
    exit;
}

// READ
$peserta = [];
$result = $conn->query("SELECT * FROM peserta ORDER BY id DESC");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $peserta[] = $row;
    }
}

// Untuk edit
$edit = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $res = $conn->query("SELECT * FROM peserta WHERE id=$id");
    if ($res && $row = $res->fetch_assoc()) {
        $edit = $row;
    }
}

include 'header.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Peserta PPDB</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: #334155;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1100px;
            margin: 40px auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            padding: 2rem 2.5rem;
        }
        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #1e293b;
        }
        .crud-form {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
            align-items: flex-end;
            justify-content: center;
        }
        .crud-form input, .crud-form select {
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            background: #f8fafc;
            box-shadow: 0 2px 5px rgba(0,0,0,0.03);
        }
        .crud-form button {
            padding: 10px 24px;
            background: #1d4ed8;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .crud-form button:hover {
            background: #3b82f6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
            background: #fff;
        }
        th, td {
            padding: 12px 10px;
            border-bottom: 1px solid #e2e8f0;
            text-align: center;
        }
        th {
            background: #f1f5f9;
            color: #1e293b;
            font-weight: 600;
        }
        tr:hover {
            background: #f8fafc;
        }
        .action-btn {
            background: #1d4ed8;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 6px 14px;
            margin: 0 2px;
            cursor: pointer;
            font-size: 13px;
            transition: background 0.2s;
        }
        .action-btn.edit { background: #f59e42; }
        .action-btn.delete { background: #ef4444; }
        .action-btn.edit:hover { background: #fbbf24; }
        .action-btn.delete:hover { background: #dc2626; }
        @media (max-width: 900px) {
            .container { padding: 1rem; }
            table, th, td { font-size: 13px; }
            .crud-form { flex-direction: column; align-items: stretch; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Pendaftaran Peserta PPDB</h2>
        <!-- Form Edit -->
        <?php if ($edit): ?>
        <form class="crud-form" method="post" autocomplete="off">
            <input type="hidden" name="id" value="<?= $edit['id'] ?>">
            <input type="text" name="nis" placeholder="NIS" required value="<?= htmlspecialchars($edit['nis']) ?>">
            <input type="text" name="nama" placeholder="Nama Peserta" required value="<?= htmlspecialchars($edit['nama']) ?>">
            <input type="email" name="email" placeholder="Email" required value="<?= htmlspecialchars($edit['email']) ?>">
            <input type="text" name="telepon" placeholder="No Telepon" required value="<?= htmlspecialchars($edit['telepon']) ?>">
            <input type="text" name="rata" placeholder="Rata-Rata" required value="<?= htmlspecialchars($edit['rata']) ?>">
            <select name="jurusan" required>
                <option value="">Pilih Jurusan</option>
                <option value="TKR" <?= $edit['jurusan']=='TKR'?'selected':''; ?>>Teknik Kendaraan Ringan</option>
                <option value="TBSM" <?= $edit['jurusan']=='TBSM'?'selected':''; ?>>Teknik Bisnis Sepeda Motor</option>
                <option value="TP" <?= $edit['jurusan']=='TP'?'selected':''; ?>>Teknik Permesinan</option>
                <option value="TKJ" <?= $edit['jurusan']=='TKJ'?'selected':''; ?>>Teknik Komputer dan Jaringan</option>
                <option value="RPL" <?= $edit['jurusan']=='RPL'?'selected':''; ?>>Rekayasa Perangkat Lunak</option>
            </select>
            <button type="submit" name="update" class="action-btn edit"><i class="fas fa-save"></i> Simpan</button>
            <a href="data_peserta.php" class="action-btn" style="background:#64748b;">Batal</a>
        </form>
        <?php endif; ?>
        <!-- Tabel Data Peserta -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No Telepon</th>
                    <th>Rata-Rata</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($peserta)): ?>
                    <tr><td colspan="8" style="color:#888;">Belum ada data peserta.</td></tr>
                <?php else: $no=1; foreach ($peserta as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nis']) ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['telepon']) ?></td>
                        <td><?= htmlspecialchars($row['rata']) ?></td>
                        <td><?= htmlspecialchars($row['jurusan']) ?></td>
                        <td>
                            <a href="data_peserta.php?edit=<?= $row['id'] ?>" class="action-btn edit"><i class="fas fa-edit"></i></a>
                            <a href="data_peserta.php?hapus=<?= $row['id'] ?>" class="action-btn delete" onclick="return confirm('Hapus data ini?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>