<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ppdb_igasar");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tambah panitia
if (isset($_POST['tambah_panitia'])) {
    $nama = $conn->real_escape_string($_POST['nama_panitia']);
    if (isset($_FILES['foto_panitia']) && $_FILES['foto_panitia']['error'] === UPLOAD_ERR_OK) {
        $foto = file_get_contents($_FILES['foto_panitia']['tmp_name']);
        $foto = $conn->real_escape_string($foto);
        $conn->query("INSERT INTO panitia_ppdb (nama_panitia, foto, aktif) VALUES ('$nama', '$foto', 0)");
    }
    header("Location: admin_panel.php");
    exit;
}

// Hapus panitia
if (isset($_GET['hapus_panitia'])) {
    $id = intval($_GET['hapus_panitia']);
    $conn->query("DELETE FROM panitia_ppdb WHERE id=$id");
    header("Location: admin_panel.php");
    exit;
}

// Toggle aktif/nonaktif panitia
if (isset($_GET['toggle_panitia'])) {
    $id = intval($_GET['toggle_panitia']);
    $result = $conn->query("SELECT aktif FROM panitia_ppdb WHERE id=$id");
    if ($result && $row = $result->fetch_assoc()) {
        $statusBaru = $row['aktif'] ? 0 : 1;
        $conn->query("UPDATE panitia_ppdb SET aktif=$statusBaru WHERE id=$id");
    }
    header("Location: admin_panel.php");
    exit;
}

// Ambil data panitia
$panitia = [];
$result = $conn->query("SELECT id, nama_panitia, foto, aktif FROM panitia_ppdb");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $panitia[] = $row;
    }
}

// Setelah SEMUA proses di atas, baru tampilkan header dan HTML
include 'header.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Panitia PPDB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="file"] {
            width: calc(100% - 100px);
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .panitia-container {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            justify-content: center;
        }

        .panitia-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 16px;
            width: 150px;
            text-align: center;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .panitia-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .panitia-card img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 12px;
        }

        .panitia-name {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
        }

        .toggle-button {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 25px;
            background-color: #f44336;
            border-radius: 25px;
            cursor: pointer;
            margin: 0 auto;
            position: relative;
            transition: background-color 0.3s ease;
        }

        .toggle-button.active {
            background-color: #4caf50;
        }

        .toggle-button::before {
            content: '';
            width: 20px;
            height: 20px;
            background-color: #ffffff;
            border-radius: 50%;
            position: absolute;
            left: 3px;
            transition: transform 0.3s ease;
        }

        .toggle-button.active::before {
            transform: translateX(25px);
        }

        .delete-button {
            margin-top: 10px;
            color: red;
            cursor: pointer;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Kelola Panitia PPDB</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="nama_panitia" placeholder="Nama Panitia" required>
            <input type="file" name="foto_panitia" accept="image/*" required>
            <button type="submit" name="tambah_panitia">Tambah Panitia</button>
        </form>

        <div class="panitia-container">
            <?php foreach ($panitia as $p): ?>
                <div class="panitia-card">
                    <?php if (!empty($p['foto'])): ?>
                        <img src="data:image/jpeg;base64,<?= base64_encode($p['foto']) ?>" alt="Foto Panitia">
                    <?php else: ?>
                        <img src="https://via.placeholder.com/80" alt="Foto Panitia">
                    <?php endif; ?>
                    <div class="panitia-name"><?= htmlspecialchars($p['nama_panitia']) ?></div>
                    <div class="toggle-button <?= $p['aktif'] ? 'active' : '' ?>"
                        onclick="window.location.href='?toggle_panitia=<?= $p['id'] ?>'">
                    </div>
                    <div class="delete-button"
                        onclick="if(confirm('Hapus panitia ini?')) window.location.href='?hapus_panitia=<?= $p['id'] ?>';">
                        Hapus
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>