<?php
session_start();
if (!isset($_SESSION['user_level']) || $_SESSION['user_level'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "ppdb_igasar");
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

// Ambil data pendaftar (hanya nama dan email)
$pendaftar = [];
$result = $conn->query("SELECT id, nama, email FROM peserta ORDER BY id DESC");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pendaftar[] = $row;
    }
}

include 'header.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pendaftar PPDB</title>
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
            max-width: 600px;
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
        @media (max-width: 700px) {
            .container { padding: 1rem; }
            table, th, td { font-size: 13px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Pendaftar PPDB</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pendaftar)): ?>
                    <tr><td colspan="3" style="color:#888;">Belum ada data pendaftar.</td></tr>
                <?php else: $no=1; foreach ($pendaftar as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>