<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi PPDB</title>
  <style>
    /* Ambil style utama dari content.php */
    .container-form {
      max-width: 400px;
      margin: 40px auto;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      padding: 32px 24px;
      font-family: 'Segoe UI', Arial, sans-serif;
    }
    .container-form h2 {
      text-align: center;
      margin-bottom: 24px;
      color: #333;
      font-weight: 600;
    }
    .container-form label {
      display: block;
      margin-bottom: 6px;
      color: #444;
      font-size: 15px;
    }
    .container-form input[type="text"],
    .container-form input[type="email"],
    .container-form input[type="password"] {
      width: 100%;
      padding: 10px 12px;
      margin-bottom: 18px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 15px;
      background: #fafbfc;
      transition: border-color 0.2s;
    }
    .container-form input:focus {
      border-color: #007bff;
      outline: none;
    }
    .container-form button[type="submit"] {
      width: 100%;
      padding: 10px 0;
      background: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s;
    }
    .container-form button[type="submit"]:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container-form">
    <h2>Formulir Pendaftaran</h2>
    <form action="register_process.php" method="POST">
      <label>Nama:</label>
      <input type="text" name="nama" required>
      <label>Email:</label>
      <input type="email" name="email" required>
      <label>Password:</label>
      <input type="password" name="password" required>
      <button type="submit">Daftar</button>
    </form>
  </div>
</body>
</html>