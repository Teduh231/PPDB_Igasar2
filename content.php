<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "ppdb_igasar");
$panitia = [];
$pengumuman = [];
if (!$conn->connect_error) {
    // Ambil panitia
    $sql = "SELECT nama_panitia, foto FROM panitia_ppdb WHERE aktif=1";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $panitia[] = $row;
        }
    }
    // Ambil pengumuman
    $sql_pengumuman = "SELECT * FROM pengumuman ORDER BY tanggal DESC";
    $result_pengumuman = $conn->query($sql_pengumuman);
    if ($result_pengumuman && $result_pengumuman->num_rows > 0) {
        while ($row = $result_pengumuman->fetch_assoc()) {
            $pengumuman[] = $row;
        }
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB Igasar Pindad Bandung</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <!-- Hero Section -->
        <div class="hero-section">
            <h1 class="hero-title">
                Selamat Datang di <span class="accent-gradient">PPDB</span><br>
                SMK Igasar Pindad Bandung
            </h1>
            <p class="hero-subtitle">Penerimaan Peserta Didik Baru Tahun Ajaran 2025/2026</p>
        </div>
        <div class="top-section">
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="register.php"><button class="main-btn">Registrasi</button></a>
                <a href="login.php"><button class="main-btn">Login</button></a>
            <?php endif; ?>
        </div>
        <!-- Main Content Grid -->
        <div class="content-grid">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Kontak Sekolah -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-phone card-icon"></i>
                        <h3 class="card-title">Kontak Sekolah</h3>
                    </div>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-school"></i>
                            <div>
                                <div class="contact-label">Nama Sekolah</div>
                                <div class="contact-value">SMK Igasar Pindad Bandung</div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <div class="contact-label">Telepon</div>
                                <div class="contact-value">0227800587</div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <div class="contact-label">Email</div>
                                <div class="contact-value">smkigasarpindadbandung@gmail.com</div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <div class="contact-label">Alamat</div>
                                <div class="contact-value">Jl. Cisaranten Kulon No.17 Bandung</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Panitia PPDB -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-users card-icon"></i>
                        <h3 class="card-title">Panitia PPDB</h3>
                    </div>
                    <div class="panitia-grid">
                        <?php foreach ($panitia as $p): ?>
                            <div class="panitia-item">
                                <?php if (!empty($p['foto'])): ?>
                                    <img src="data:image/jpeg;base64,<?= base64_encode($p['foto']) ?>"
                                         alt="<?= htmlspecialchars($p['nama_panitia']) ?>" class="panitia-foto">
                                <?php else: ?>
                                    <div class="panitia-foto"
                                         style="background: #e2e8f0; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-user" style="color: #94a3b8;"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="panitia-nama"><?= htmlspecialchars($p['nama_panitia']) ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Pengumuman -->
            <div class="pengumuman-card">
                <div class="card-header">
                    <i class="fas fa-bullhorn card-icon"></i>
                    <h3 class="card-title">Pengumuman PPDB</h3>
                </div>
                <div class="pengumuman-content">
                    <?php if (count($pengumuman) > 0): ?>
                        <?php foreach ($pengumuman as $p): ?>
                            <div class="announcement-card" style="margin-bottom: 1.5rem;">
                                <div class="announcement-title" style="font-weight:bold;"><?= htmlspecialchars($p['judul']) ?></div>
                                <div class="announcement-date" style="font-size:12px;color:#888;margin-bottom:6px;">
                                    <i class="fas fa-calendar"></i> <?= date('d M Y H:i', strtotime($p['tanggal'])) ?>
                                </div>
                                <?php if (!empty($p['foto'])): ?>
                                    <img class="foto-pengumuman" src="data:image/jpeg;base64,<?= base64_encode($p['foto']) ?>" alt="Foto Pengumuman" style="max-width:180px;max-height:180px;border-radius:8px;margin-bottom:10px;">
                                <?php endif; ?>
                                <div class="announcement-content"><?= nl2br(htmlspecialchars($p['isi'])) ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        color: #334155;
        line-height: 1.6;
        min-height: 100vh;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .hero-section {
        text-align: center;
        margin-bottom: 3rem;
        padding: 2rem 0;
    }

    .hero-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .hero-subtitle {
        font-size: 1.2rem;
        color: #64748b;
        font-weight: 300;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #e2e8f0;
    }

    .card-icon {
        width: 24px;
        height: 24px;
        color: #3b82f6;
    }

    .card-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1e293b;
    }

    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.5rem 0;
    }

    .contact-item i {
        width: 20px;
        color: #3b82f6;
        margin-top: 0.2rem;
        flex-shrink: 0;
    }

    .contact-label {
        font-weight: 600;
        color: #374151;
        min-width: 80px;
    }

    .contact-value {
        color: #6b7280;
        flex: 1;
    }

    .panitia-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 1rem;
    }

    .panitia-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 12px;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }

    .panitia-item:hover {
        background: #f1f5f9;
        transform: translateY(-2px);
    }

    .panitia-foto {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 0.75rem;
        border: 3px solid #3b82f6;
        transition: all 0.3s ease;
    }

    .panitia-foto:hover {
        transform: scale(1.05);
    }

    .panitia-nama {
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        line-height: 1.3;
    }

    .pengumuman-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border: 1px solid #e2e8f0;
    }

    .pengumuman-content {
        text-align: center;
        padding: 1rem;
    }

    .announcement-card {
        margin-bottom: 2.5rem !important;
    }

    .foto-pengumuman {
        max-width: 350px !important;
        max-height: 350px !important;
        border-radius: 12px !important;
        margin-bottom: 18px !important;
        box-shadow: 0 6px 18px rgba(0,0,0,0.10);
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .announcement-title {
        font-size: 2rem !important;
        font-weight: bold;
        color: #1e293b;
        margin-bottom: 10px;
    }

    .announcement-date {
        font-size: 1.1rem !important;
        color: #64748b !important;
        margin-bottom: 12px !important;
    }

    .announcement-content {
        font-size: 1.25rem !important;
        color: #334155;
        margin-top: 10px;
        line-height: 1.7;
    }

    .accent-gradient {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .main-btn {
  background-color: #1d4ed8; 
  color: white; 
  border: none;
  padding: 10px 20px; 
  font-size: 16px; 
  font-weight: bold; 
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  margin-bottom: 40px;
  gap: 10px;
}

.main-btn:hover {
  background-color: #3b82f6;
  transform: translateY(-2px);
  box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
}

.main-btn:active {
  transform: translateY(0);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }

        .hero-title {
            font-size: 2rem;
        }

        .content-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .panitia-grid {
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        }

        .card {
            padding: 1.25rem;
        }

        .contact-item {
            flex-direction: column;
            gap: 0.5rem;
        }

        .contact-label {
            min-width: auto;
            font-size: 0.9rem;
        }
    }

    @media (max-width: 480px) {
        .hero-title {
            font-size: 1.75rem;
        }

        .panitia-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .panitia-foto {
            width: 50px;
            height: 50px;
        }
    }

    /* Smooth fade-in animation */
    .card {
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-section {
        animation: fadeIn 0.8s ease-out;
    }
        }
    }
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
</style>