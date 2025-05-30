<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informasi Jurusan</title>
</head>

<body>
<style>
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background-color: #f8f8f8;
  padding-top: 40px;
  text-align: center;
}

.main-content {
  padding: 40px 20px;
  text-align: center;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.info-text {
  animation: fadeIn 0.3s ease-out; /* Faster animation (0.3s) */
}

.info-text h1 {
  margin-bottom: 10px;
  font-size: 24px;
}

.info-text p {
  margin-bottom: 40px;
  color: #666;
}

.jurusan-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 30px;
  justify-items: center;
  align-items: center;
}

.jurusan-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  border-radius: 25px;
  text-decoration: none;
  color: white;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  width: 200px;
  height: 240px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.jurusan-card img {
  width: 100px;
  height: 100px;
  transition: transform 0.3s ease;
}

.jurusan-card span {
  margin-top: 15px;
  font-weight: bold;
  font-size: 14px;
}

.jurusan-card:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.jurusan-card:hover img {
  transform: scale(1.2);
}

/* Color Classes */
.merah {
  background-color: #e74c3c;
}
.oranye {
  background-color: #e67e22;
}
.hijau {
  background-color: #27ae60;
}
.biru {
  background-color: #09035e;
}
.biru-muda {
  background-color: #3498db;
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

.jurusan-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  border-radius: 25px;
  text-decoration: none;
  color: white;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  width: 200px;
  height: 240px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  animation: fadeInUp 0.6s ease-out; /* Apply the animation */
}
.jurusan-card:nth-child(1) {
  animation-delay: 0.1s;
}
.jurusan-card:nth-child(2) {
  animation-delay: 0.2s;
}
.jurusan-card:nth-child(3) {
  animation-delay: 0.3s;
}
.jurusan-card:nth-child(4) {
  animation-delay: 0.4s;
}
.jurusan-card:nth-child(5) {
  animation-delay: 0.5s;
}
</style>
  <div class="main-content">
    <div class="info-text">
      <h1>SELAMAT DATANG DI INFORMASI JURUSAN</h1>
      <p>Silakan pilih jurusan yang Anda ingin ketahui</p>
    </div>

    <div class="jurusan-grid">
      <a href="tkr.php" class="jurusan-card merah">
        <img src="img/tkr.png" alt="TKR">
        <span>Teknik Kendaraan Ringan</span>
      </a>
      <a href="tbsm.php" class="jurusan-card oranye">
        <img src="img/tsm.png" alt="TBSM">
        <span>Teknik Bisnis Sepeda Motor</span>
      </a>
      <a href="tp.php" class="jurusan-card hijau">
        <img src="img/tp.png" alt="TP">
        <span>Teknik Permesinan</span>
      </a>
      <a href="tkj.php" class="jurusan-card biru">
        <img src="img/tkj.png" alt="TKJ">
        <span>Teknik Komputer Jaringan</span>
      </a>
      <a href="rpl.php" class="jurusan-card biru-muda">
        <img src="img/rpl.png" alt="RPL">
        <span>Rekayasa Perangkat Lunak</span>
      </a>
    </div>
  </div>

</body>

</html>