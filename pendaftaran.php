<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Pendaftaran Siswa Baru</title>
</head>

<body style="font-family: 'Arial', sans-serif; background-color: #f9f9f9; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0;">
  <div style="background: #ffffff; border-radius: 12px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); width: 100%; max-width: 700px; overflow: hidden; border: 1px solid #e5e7eb; margin-top: 60px;">
    <div style="text-align: center; padding: 24px 32px 16px; border-bottom: 1px solid #ddd;">
      <h2 style="font-size: 22px; margin-bottom: 6px; font-weight: 600; color: #222;">Peserta PPDB</h2>
      <p style="font-size: 14px; color: #666; margin: 0;">Tolong isi data diri peserta</p>
    </div>
    <form method="POST" action="proses_pendaftaran.php" enctype="multipart/form-data">
      <div style="padding: 24px 32px;">
        <div style="margin-bottom: 16px;">
          <label for="nis" style="font-size: 14px; color: #444; margin-bottom: 6px; display: block;">NIS</label>
          <input type="text" id="nis" name="nis" placeholder="NIS Peserta" style="width: 90%; padding: 10px 14px; font-size: 14px; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); outline: none;" />
        </div>
        <div style="margin-bottom: 16px;">
          <label for="nama" style="font-size: 14px; color: #444; margin-bottom: 6px; display: block;">Nama Peserta</label>
          <input type="text" id="nama" name="nama" placeholder="Nama" style="width: 90%; padding: 10px 14px; font-size: 14px; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); outline: none;" />
        </div>
        <div style="margin-bottom: 16px;">
          <label for="email" style="font-size: 14px; color: #444; margin-bottom: 6px; display: block;">Email</label>
          <input type="email" id="email" name="email" placeholder="Email" style="width: 90%; padding: 10px 14px; font-size: 14px; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); outline: none;" />
        </div>
        <div style="margin-bottom: 16px;">
          <label for="telepon" style="font-size: 14px; color: #444; margin-bottom: 6px; display: block;">No-Telepon</label>
          <input type="text" id="telepon" name="telepon" placeholder="No-Telepon" style="width: 90%; padding: 10px 14px; font-size: 14px; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); outline: none;" />
        </div>
        <div style="margin-bottom: 16px;">
          <label for="rata" style="font-size: 14px; color: #444; margin-bottom: 6px; display: block;">Rata-Rata</label>
          <input type="text" id="rata" name="rata" placeholder="Rata-Rata" style="width: 90%; padding: 10px 14px; font-size: 14px; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); outline: none;" />
        </div>
        <div style="margin-bottom: 16px;">
          <label for="jurusan" style="font-size: 14px; color: #444; margin-bottom: 6px; display: block;">Pilihan Jurusan</label>
          <select id="jurusan" name="jurusan" style="width: 50%; padding: 10px 14px; font-size: 14px; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); outline: none;">
            <option value="TKR">Teknik Kendaraan Ringan</option>
            <option value="TBSM">Teknik Bisnis Sepeda Motor</option>
            <option value="TP">Teknik Permesinan</option>
            <option value="TKJ">Teknik Komputer dan Jaringan</option>
            <option value="RPL">Rekayasa Perangkat Lunak</option>
          </select>
        </div>
        <div style="margin-bottom: 16px;">
          <label style="font-size: 14px; color: #444; margin-bottom: 6px; display: block;">Surat Kelulusan</label>
          <div id="upload-container" style="text-align: center; border: 2px dashed #ccc; border-radius: 8px; padding: 24px; background-color: #fefefe; position: relative;">
            <i class="fa fa-cloud-upload" style="font-size: 40px; color: #888;"></i>
            <p style="font-size: 14px; color: #666; margin: 10px 0;">Upload atau drop<br />Foto Surat Kelulusan</p>
            <input type="file" id="upload-file" name="surat_kelulusan" accept="image/*" style="display: none;" />
            <label for="upload-file" id="upload-label" style="display: inline-block; padding: 6px 16px; margin-top: 10px; background-color: #007bff; color: white; border-radius: 6px; cursor: pointer; font-size: 14px;">Upload</label>
            <img id="preview-image" src="" alt="Preview" style="display: none; margin-top: 16px; max-width: 100%; border-radius: 8px;" />
          </div>
        </div>
        <button type="submit" style="display: block; width: 100%; padding: 14px; margin-top: 20px; background-color: #007bff; color: #fff; font-size: 16px; font-weight: bold; border: none; border-radius: 8px; cursor: pointer;">KIRIM</button>
      </div>
    </form>
  </div>

  <script>
    const uploadContainer = document.getElementById('upload-container');
    const fileInput = document.getElementById('upload-file');
    const uploadLabel = document.getElementById('upload-label');
    const previewImage = document.getElementById('preview-image');

    // Event listener untuk drag-and-drop
    uploadContainer.addEventListener('dragover', (e) => {
      e.preventDefault();
      uploadContainer.style.borderColor = '#007bff';
      uploadContainer.style.backgroundColor = '#eaf4ff';
    });

    uploadContainer.addEventListener('dragleave', () => {
      uploadContainer.style.borderColor = '#ccc';
      uploadContainer.style.backgroundColor = '#fefefe';
    });

    uploadContainer.addEventListener('drop', (e) => {
      e.preventDefault();
      uploadContainer.style.borderColor = '#ccc';
      uploadContainer.style.backgroundColor = '#fefefe';

      const files = e.dataTransfer.files;
      if (files.length > 0) {
        const file = files[0];
        if (file.type.startsWith('image/')) {
          displayImage(file);
        } else {
          alert('Harap unggah file gambar!');
        }
      }
    });

    // Event listener untuk input file
    fileInput.addEventListener('change', (e) => {
      const file = e.target.files[0];
      if (file) {
        displayImage(file);
      }
    });

    // Fungsi untuk menampilkan gambar
    function displayImage(file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        previewImage.src = e.target.result;
        previewImage.style.display = 'block';
        fileInput.style.display = 'none'; // Sembunyikan input file
        uploadLabel.style.display = 'none'; // Sembunyikan label upload
      };
      reader.readAsDataURL(file);
    }
  </script>
</body>

</html>