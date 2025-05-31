<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ppdb_igasar");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tambah panitia
if (isset($_POST['tambah_panitia'])) {
    $nama = $conn->real_escape_string($_POST['nama_panitia']);
    $foto = null;
    if (isset($_FILES['foto_panitia']) && $_FILES['foto_panitia']['error'] === UPLOAD_ERR_OK) {
        $foto = file_get_contents($_FILES['foto_panitia']['tmp_name']);
        $foto = $conn->real_escape_string($foto);
    }
    $conn->query("INSERT INTO panitia_ppdb (nama_panitia, foto, aktif) VALUES ('$nama', '$foto', 0)");
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

// Tambah pengumuman
if (isset($_POST['tambah_pengumuman'])) {
    $judul = $conn->real_escape_string($_POST['judul_pengumuman']);
    $isi = $conn->real_escape_string($_POST['isi_pengumuman']);
    $foto = null;
    if (isset($_FILES['foto_pengumuman']) && $_FILES['foto_pengumuman']['error'] === UPLOAD_ERR_OK) {
        $foto = file_get_contents($_FILES['foto_pengumuman']['tmp_name']);
        $foto = $conn->real_escape_string($foto);
    }
    $conn->query("INSERT INTO pengumuman (judul, isi, tanggal, foto) VALUES ('$judul', '$isi', NOW(), '$foto')");
    header("Location: admin_panel.php");
    exit;
}

// Hapus pengumuman
if (isset($_GET['hapus_pengumuman'])) {
    $id = intval($_GET['hapus_pengumuman']);
    $conn->query("DELETE FROM pengumuman WHERE id=$id");
    header("Location: admin_panel.php");
    exit;
}

// Edit pengumuman
if (isset($_POST['edit_pengumuman'])) {
    $id = intval($_POST['id_pengumuman']);
    $judul = $conn->real_escape_string($_POST['judul_pengumuman']);
    $isi = $conn->real_escape_string($_POST['isi_pengumuman']);
    // Cek jika ada upload foto baru
    if (isset($_FILES['foto_pengumuman']) && $_FILES['foto_pengumuman']['error'] === UPLOAD_ERR_OK) {
        $foto = file_get_contents($_FILES['foto_pengumuman']['tmp_name']);
        $foto = $conn->real_escape_string($foto);
        $conn->query("UPDATE pengumuman SET judul='$judul', isi='$isi', foto='$foto' WHERE id=$id");
    } else {
        $conn->query("UPDATE pengumuman SET judul='$judul', isi='$isi' WHERE id=$id");
    }
    header("Location: admin_panel.php");
    exit;
}

// Hapus foto pengumuman
if (isset($_GET['hapus_foto_pengumuman'])) {
    $id = intval($_GET['hapus_foto_pengumuman']);
    $conn->query("UPDATE pengumuman SET foto=NULL WHERE id=$id");
    header("Location: admin_panel.php?edit_pengumuman=$id");
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

// Ambil data pengumuman
$pengumuman = [];
$result = $conn->query("SELECT * FROM pengumuman ORDER BY tanggal DESC");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pengumuman[] = $row;
    }
}

// Untuk form edit pengumuman
$edit_pengumuman = null;
if (isset($_GET['edit_pengumuman'])) {
    $id = intval($_GET['edit_pengumuman']);
    $result = $conn->query("SELECT * FROM pengumuman WHERE id=$id");
    if ($result && $result->num_rows === 1) {
        $edit_pengumuman = $result->fetch_assoc();
    }
}

include 'header.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Panitia & Pengumuman PPDB</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            margin-top: 60px;
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
        input[type="file"],
        textarea {
            width: calc(100% - 100px);
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        textarea {
            width: 100%;
            min-height: 60px;
            resize: vertical;
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

        /* Pengumuman style mirip content.php */
        .announcement-section {
            margin-top: 40px;
        }

        .announcement-card {
            background: #f5f7fa;
            border-radius: 10px;
            padding: 18px 20px;
            margin-bottom: 18px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
            position: relative;
        }

        .announcement-title {
            font-size: 18px;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 6px;
        }

        .announcement-date {
            font-size: 12px;
            color: #888;
            margin-bottom: 10px;
        }

        .announcement-actions {
            position: absolute;
            top: 18px;
            right: 20px;
        }

        .announcement-actions button {
            background: #e2e8f0;
            color: #333;
            border: none;
            border-radius: 4px;
            padding: 4px 10px;
            margin-left: 4px;
            font-size: 12px;
            cursor: pointer;
        }

        .announcement-actions button:hover {
            background: #cbd5e1;
        }

        .announcement-content {
            font-size: 15px;
            color: #444;
        }

        .form-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .foto-pengumuman {
            display: block;
            max-width: 180px;
            max-height: 180px;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .hapus-foto-btn {
            background: #f44336;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 4px 10px;
            font-size: 12px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .hapus-foto-btn:hover {
            background: #b71c1c;
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

        <!-- Pengumuman Section -->
        <div class="announcement-section">
            <div class="form-title"><?= $edit_pengumuman ? 'Edit Pengumuman' : 'Tambah Pengumuman' ?></div>
            <form method="POST" enctype="multipart/form-data">
                <?php if ($edit_pengumuman): ?>
                    <input type="hidden" name="id_pengumuman" value="<?= $edit_pengumuman['id'] ?>">
                <?php endif; ?>
                <input type="text" name="judul_pengumuman" placeholder="Judul Pengumuman" required value="<?= $edit_pengumuman ? htmlspecialchars($edit_pengumuman['judul']) : '' ?>">
                <textarea name="isi_pengumuman" placeholder="Isi pengumuman..." required><?= $edit_pengumuman ? htmlspecialchars($edit_pengumuman['isi']) : '' ?></textarea>
                <?php if ($edit_pengumuman && !empty($edit_pengumuman['foto'])): ?>
                    <img class="foto-pengumuman" src="data:image/jpeg;base64,<?= base64_encode($edit_pengumuman['foto']) ?>" alt="Foto Pengumuman">
                    <a href="?hapus_foto_pengumuman=<?= $edit_pengumuman['id'] ?>" onclick="return confirm('Hapus foto ini?');">
                        <button type="button" class="hapus-foto-btn">Hapus Foto</button>
                    </a>
                <?php endif; ?>
                <input type="file" name="foto_pengumuman" accept="image/*">
                <button type="submit" name="<?= $edit_pengumuman ? 'edit_pengumuman' : 'tambah_pengumuman' ?>">
                    <?= $edit_pengumuman ? 'Simpan Perubahan' : 'Tambah Pengumuman' ?>
                </button>
                <?php if ($edit_pengumuman): ?>
                    <a href="admin_panel.php"><button type="button">Batal</button></a>
                <?php endif; ?>
            </form>

            <?php foreach ($pengumuman as $p): ?>
                <div class="announcement-card">
                    <div class="announcement-title"><?= htmlspecialchars($p['judul']) ?></div>
                    <div class="announcement-date"><i class="fas fa-calendar"></i> <?= date('d M Y H:i', strtotime($p['tanggal'])) ?></div>
                    <?php if (!empty($p['foto'])): ?>
                        <img class="foto-pengumuman" src="data:image/jpeg;base64,<?= base64_encode($p['foto']) ?>" alt="Foto Pengumuman">
                    <?php endif; ?>
                    <div class="announcement-content"><?= nl2br(htmlspecialchars($p['isi'])) ?></div>
                    <div class="announcement-actions">
                        <form method="GET" style="display:inline;">
                            <input type="hidden" name="edit_pengumuman" value="<?= $p['id'] ?>">
                            <button type="submit"><i class="fas fa-edit"></i> Edit</button>
                        </form>
                        <form method="GET" style="display:inline;" onsubmit="return confirm('Hapus pengumuman ini?');">
                            <input type="hidden" name="hapus_pengumuman" value="<?= $p['id'] ?>">
                            <button type="submit"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>