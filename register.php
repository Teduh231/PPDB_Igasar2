<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi PPDB</title>
  <link rel="stylesheet" href="css/global.css">
</head>
<body>
  <div class="container-form">
    <h2>Formulir Pendaftaran</h2>
    <form action="register_process.php" method="POST">
      <label>Nama:</label><br>
      <input type="text" name="nama" required><br><br>
      <label>Email:</label><br>
      <input type="email" name="email" required><br><br>
      <label>No. Telepon:</label><br>
      <input type="text" name="no_telp" required><br><br>
      <button type="submit">Daftar</button>
    </form>
  </div>
</body>
</html>