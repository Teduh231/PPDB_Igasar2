<?php
session_start();
if (!isset($_SESSION['user_level']) || $_SESSION['user_level'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "ppdb_igasar");
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

// Ambil data pendaftar (tampilkan semua kolom yang ada)
$pendaftar = [];
$result = $conn->query("SELECT * FROM pendaftaran ORDER BY id_pendaftar DESC");
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
    <title>Data Lengkap Pendaftar PPDB</title>
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
            max-width: 1000px;
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
            th, td { padding: 6px 4px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Lengkap Pendaftar PPDB</h2>
        <table>
            <thead>
                <tr>
                    <?php if (!empty($pendaftar)): ?>
                        <?php foreach (array_keys($pendaftar[0]) as $col): ?>
                            <th><?= htmlspecialchars(ucwords(str_replace('_',' ',$col))) ?></th>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <th>Data</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pendaftar)): ?>
                    <tr><td colspan="99" style="color:#888;">Belum ada data pendaftar.</td></tr>
                <?php else: foreach ($pendaftar as $row): ?>
                    <tr>
                        <?php foreach ($row as $col => $val): ?>
                            <?php if ($col === 'surat_kelulusan' && !empty($val)): ?>
                                <td>
                                    <img src="data:image/jpeg;base64,<?= base64_encode($val) ?>" alt="Surat Kelulusan" style="max-width:80px;max-height:80px;border-radius:6px;">
                                </td>
                            <?php else: ?>
                                <td><?= htmlspecialchars($val) ?></td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>