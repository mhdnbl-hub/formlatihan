<?php
session_start();

if (isset($_SESSION['role'])) {
  if ($_SESSION['role'] === 'admin') {
    header("Location: admin_dashboard.php");
    exit;
  } elseif ($_SESSION['role'] === 'user') {
    header("Location: user_dashboard.php");
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>UKMate – Portal Pendaftaran UKM</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(to bottom right, #fff3e0, #ffe082);
      font-family: 'Poppins', sans-serif;
      padding-top: 80px;
      min-height: 100vh;
    }

    .landing-box {
      background-color: #fff;
      padding: 48px 36px;
      border-radius: 16px;
      box-shadow: 0 8px 28px rgba(0, 0, 0, 0.08);
      text-align: center;
      max-width: 480px;
      margin: 0 auto;
      animation: fadeIn 0.8s ease-out;
    }

    .logo {
      width: 72px;
      margin-bottom: 20px;
      animation: pulse 1.2s infinite ease-in-out;
    }

    h3 {
      font-size: 1.7rem;
      font-weight: 700;
      color: #ff8800;
    }

    p {
      color: #666;
      margin-bottom: 24px;
    }

    .btn-orange {
      background-color: #ff8800;
      color: white;
      border: none;
      transition: all 0.3s;
    }

    .btn-orange:hover {
      background-color: #e67600;
      transform: scale(1.02);
    }

    .btn-outline-orange {
      border: 1px solid #ff8800;
      color: #ff8800;
      transition: all 0.3s;
    }

    .btn-outline-orange:hover {
      background-color: #ff8800;
      color: white;
      transform: scale(1.02);
    }

    .btn-group-custom {
      display: flex;
      justify-content: center;
      gap: 16px;
      flex-wrap: wrap;
    }

    .footer {
      margin-top: 40px;
      text-align: center;
      font-size: 0.85rem;
      color: #777;
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(20px);}
      to {opacity: 1; transform: translateY(0);}
    }

    @keyframes pulse {
      0%   { transform: scale(1); }
      50%  { transform: scale(1.05); }
      100% { transform: scale(1); }
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="landing-box">
      <img src="https://cdn-icons-png.flaticon.com/512/1055/1055672.png" alt="UKMate Logo" class="logo" />
      <h3>Selamat Datang di UKMate</h3>
      <p>Platform digital pendaftaran Unit Kegiatan Mahasiswa. Yuk bergabung!</p>
      <div class="btn-group-custom mt-3">
        <a href="login.php" class="btn btn-orange px-4">Login</a>
        <a href="register.php" class="btn btn-outline-orange px-4">Daftar Akun</a>
      </div>
    </div>

    <div class="footer">
      &copy; <?= date('Y') ?> UKMate. Dibuat oleh Muhammad Nabil al-Hafiz.
    </div>
  </div>

</body>
</html>