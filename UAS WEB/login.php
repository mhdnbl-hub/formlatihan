<?php
session_start();
include 'koneksi.php';

$notif = "";
if (isset($_GET['registered']) && $_GET['registered'] === 'true') {
  $notif = "✅ Akun berhasil dibuat. Silakan login.";
}

$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
  $pass  = $_POST['password'];

  $query = mysqli_query($conn, "SELECT * FROM akun WHERE email = '$email'");
  $data  = mysqli_fetch_assoc($query);

  if ($data && password_verify($pass, $data['password'])) {
    $_SESSION['id_user'] = $data['id'];
    $_SESSION['nama']    = $data['nama'];
    $_SESSION['role']    = $data['role'];

    if ($data['role'] === 'admin') {
      header("Location: admin_dashboard.php");
    } else {
      header("Location: user_dashboard.php");
    }
    exit;
  } else {
    $msg = "Email atau password salah.";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Login UKMate</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(135deg, #fff3e0, #ffe0b2);
      font-family: 'Poppins', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .login-box {
      background-color: #fff;
      padding: 36px;
      border-radius: 16px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
      width: 100%;
      max-width: 420px;
      text-align: center;
    }

    .login-box img {
      width: 80px;
      margin-bottom: 16px;
      animation: float 3s ease-in-out infinite;
    }

    h4 {
      color: #ff8800;
      font-weight: 700;
      margin-bottom: 16px;
    }

    .btn-orange {
      background-color: #ff8800;
      color: white;
      border: none;
      transition: all 0.3s;
    }

    .btn-orange:hover {
      background-color: #e67600;
      transform: translateY(-1px);
      box-shadow: 0 6px 14px rgba(255, 136, 0, 0.2);
    }

    .form-control:focus {
      border-color: #ff8800;
      box-shadow: 0 0 0 0.2rem rgba(255, 136, 0, 0.25);
    }

    @keyframes float {
      0%   { transform: translateY(0); }
      50%  { transform: translateY(-6px); }
      100% { transform: translateY(0); }
    }
  </style>
</head>
<body>

<div class="login-box">
  <img src="https://cdn-icons-png.flaticon.com/512/1055/1055672.png" alt="UKMate Logo" />
  <h4>🔐 Login ke UKMate</h4>

  <?php if ($notif): ?>
    <div class="alert alert-success"><?= htmlspecialchars($notif) ?></div>
  <?php endif; ?>

  <?php if ($msg): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($msg) ?></div>
  <?php endif; ?>

  <form method="post" autocomplete="off">
    <div class="mb-3 text-start">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" placeholder="" required />
    </div>
    <div class="mb-3 text-start">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" placeholder="" required />
    </div>
    <button type="submit" class="btn btn-orange w-100">Masuk</button>
    <div class="mt-3">
      <small>Belum punya akun? <a href="register.php">Daftar di sini</a></small>
    </div>
  </form>
</div>

</body>
</html>