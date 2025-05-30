<?php include 'header.php'; ?>
<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "ppdb_igasar");
$images = [];
if (!$conn->connect_error) {
  $sql = "SELECT id_image, image FROM image_rpl";
  $result = $conn->query($sql);
  if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $images[] = $row;
    }
  }
  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rekayasa Perangkat Lunak</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f8f8;
      margin: 0;
      padding: 0;
    }

    .main-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
      margin-top: 40px;
    }

    .intro {
      text-align: center;
      margin-bottom: 40px;
    }

    .intro h2 {
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .intro p {
      font-size: 16px;
      color: #555;
      line-height: 1.6;
    }

    .intro p span {
      display: block;
      margin-bottom: 20px;
      font-size: 16px;
      color: #555;
      line-height: 1.6;
    }

    .guru-section {
      text-align: center;
      margin-bottom: 40px;
    }

    .section-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .guru-container {
      display: flex;
      justify-content: center;
      gap: 20px;
      align-items: flex-start;
    }

    .guru-card {
      text-align: center;
      width: 120px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .guru-img img {
      width: 100%;
      border-radius: 10%;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .guru-name {
      margin-top: 10px;
      font-size: 14px;
      font-weight: bold;
      text-align: center;
    }

    .foto-section {
      text-align: center;
      margin-bottom: 40px;
    }

    .gallery-container {
      position: relative;
      max-width: 800px;
      margin: 0 auto;
      overflow: hidden;
    }

    .gallery-item {
      display: none;
      width: 100%;
    }

    .gallery-item img {
      width: 10;
      height: 20rem;
      border-radius: 12px;
    }

    .gallery-item.active {
      display: block;
    }

    .carousel-controls {
      display: flex;
      justify-content: space-between;
      position: absolute;
      top: 50%;
      width: 100%;
      transform: translateY(-50%);
    }

    .carousel-controls button {
      background-color: rgba(0, 0, 0, 0.5);
      color: white;
      border: none;
      padding: 10px;
      cursor: pointer;
      border-radius: 50%;
    }

    .carousel-controls button:hover {
      background-color: rgba(0, 0, 0, 0.8);
    }
  </style>
</head>

<body style="padding-top : 40px;">
  <div class="main-container">
    <div class="container_jurusan">
      <section class="intro">
        <h2>Rekayasa Perangkat Lunak</h2>
        <p>
          <span>Jurusan Rekayasa Perangkat Lunak (RPL) di Sekolah Menengah Kejuruan (SMK) merupakan salah satu program
            keahlian dalam bidang Teknologi Informasi dan Komunikasi yang dirancang untuk membekali peserta didik dengan
            pengetahuan, keterampilan, dan sikap profesional dalam pengembangan perangkat lunak (software development).</span>
          <span>Program ini mencakup berbagai aspek teknis dan teoritis yang meliputi analisis kebutuhan sistem, perancangan
            sistem informasi, pemrograman aplikasi berbasis desktop, web, dan mobile, pengujian dan debugging, hingga
            implementasi dan pemeliharaan perangkat lunak. Selain itu, siswa juga dibekali dengan kemampuan dalam
            mengelola basis data (database), memahami sistem operasi, jaringan komputer, serta prinsip-prinsip keamanan
            dan etika dalam penggunaan teknologi informasi.</span>
          <span>Melalui kurikulum yang berbasis kompetensi dan praktik langsung di dunia industri, siswa di jurusan RPL
            diajarkan menggunakan berbagai bahasa pemrograman populer seperti Java, Python, PHP, JavaScript, dan lainnya,
            serta diperkenalkan pada framework dan tools pengembangan yang digunakan di dunia kerja saat ini.</span>
          <span>Tak hanya aspek teknis, jurusan ini juga mendorong pengembangan soft skills seperti kemampuan berpikir logis
            dan analitis, kerja tim, manajemen proyek, serta komunikasi profesional yang dibutuhkan dalam dunia kerja
            berbasis teknologi.</span>
          <span>Lulusan dari jurusan RPL memiliki peluang karier yang luas, seperti menjadi programmer, software developer,
            web developer, mobile app developer, database administrator, hingga IT support, atau bahkan melanjutkan
            pendidikan ke jenjang yang lebih tinggi dalam bidang informatika, sistem informasi, atau teknik komputer.</span>
          <span>Dengan perkembangan teknologi digital yang sangat pesat, jurusan Rekayasa Perangkat Lunak menjadi pilihan
            strategis bagi siswa yang ingin memiliki keterampilan relevan dan siap kerja di era industri 4.0 dan
            transformasi digital.</span>
        </p>
      </section>
      <section class="guru-section">
        <h3 class="section-title">Guru Produktif</h3>
        <div class="guru-container">
          <div class="guru-card">
            <div class="guru-img"><img src="img/guru/rpl/bu-winny.png" alt=""></div>
            <div class="guru-name">Winny Febrianty R</div>
          </div>
          <div class="guru-card">
            <div class="guru-img"><img src="img/guru/rpl/pak-bani.png" alt=""></div>
            <div class="guru-name">E.M.Rizki Bani Asmara</div>
          </div>
          <div class="guru-card">
            <div class="guru-img"><img src="img/guru/rpl/bu-novi.png" alt=""></div>
            <div class="guru-name">Noviana Sabilla</div>
          </div>
        </div>
      </section>
      <section class="foto-section">
        <h3 class="section-title">Galeri Kegiatan</h3>
        <div class="gallery-container">
          <?php foreach ($images as $index => $image): ?>
            <div class="gallery-item <?php echo $index === 0 ? 'active' : ''; ?>">
              <img src="data:image/jpeg;base64,<?php echo base64_encode($image['image']); ?>"
                alt="Kegiatan <?php echo $image['id_image']; ?>">
            </div>
          <?php endforeach; ?>
          <div class="carousel-controls">
            <button id="prev-btn">&lt;</button>
            <button id="next-btn">&gt;</button>
          </div>
        </div>
      </section>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const items = document.querySelectorAll(".gallery-item");
      const prevBtn = document.getElementById("prev-btn");
      const nextBtn = document.getElementById("next-btn");
      let currentIndex = 0;

      function showItem(index) {
        items.forEach((item, i) => {
          item.classList.toggle("active", i === index);
        });
      }

      prevBtn.addEventListener("click", function () {
        currentIndex = (currentIndex - 1 + items.length) % items.length;
        showItem(currentIndex);
      });

      nextBtn.addEventListener("click", function () {
        currentIndex = (currentIndex + 1) % items.length;
        showItem(currentIndex);
      });
    });
  </script>
</body>

</html>