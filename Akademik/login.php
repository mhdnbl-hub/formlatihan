<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Monochrome</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: #e0e0e0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: Arial, sans-serif;
    }
    .login-card {
      background: #1e1e1e;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.6);
      width: 100%;
      max-width: 400px;
    }
    .login-card .logo {
      width: 70px;
      margin: 0 auto 20px;
      display: block;
      filter: invert(100%);
    }
    .form-control {
      background-color: #2a2a2a;
      border: 1px solid #444;
      color: #e0e0e0;
    }
    .form-control:focus {
      background-color: #2a2a2a;
      color: #ffffff;
      border-color: #555;
      box-shadow: none;
    }
    .btn-login {
      background-color: #444;
      color: #fff;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }
    .btn-login:hover {
      background-color: #666;
    }
  </style>
</head>
<body>

<div class="login-card">
  <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="Logo" class="logo">
  <h4 class="text-center mb-4">Login Akun</h4>
  <form action="" method="POST">
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="d-grid">
      <button type="submit" class="btn btn-login" name="login">LOGIN</button>
    </div>
  </form>

  <?php
  if (isset($_POST['login'])) {
    include 'koneksi.php';

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
      $email = $_POST['email'];
      $password = md5($_POST['password']);

      $cek_login = $koneksi->query("SELECT * FROM tabel_user WHERE email ='$email' AND password='$password'");

      if ($cek_login->num_rows == 1) {
        $user = $cek_login->fetch_assoc();
        $_SESSION['login'] = TRUE;
        $_SESSION['email'] = $email;
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['level'] = $user['level'];
        header("Location: index.php");
        exit();
      } else {
        echo "<div class='mt-3 text-center text-danger fw-bold'>Email atau Password tidak valid!</div>";
      }
    }
  }
  ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
