<?php
session_start();
include 'koneksi.php';

$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = mysqli_real_escape_string($conn, $_POST['nama']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password_raw = $_POST['password'];

  if (strlen($password_raw) < 6) {
    $msg = "Password minimal 6 karakter.";
  } else {
    $cek = mysqli_query($conn, "SELECT * FROM akun WHERE email = '$email'");
    if (mysqli_num_rows($cek) > 0) {
      $msg = "Email sudah terdaftar.";
    } else {
      $password_hash = password_hash($password_raw, PASSWORD_DEFAULT);
      $insert = mysqli_query($conn, "INSERT INTO akun (nama, email, password) VALUES ('$nama', '$email', '$password_hash')");
      if ($insert) {
        header("Location: login.php?registered=true");
        exit;
      } else {
        $msg = "Gagal registrasi. Coba lagi nanti.";
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi UKMate</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body { background-color: #fff8f0; font-family: 'Poppins', sans-serif; }
    .register-box { max-width: 420px; margin: 60px auto; background: #fff; border-radius: 12px; padding: 28px; box-shadow: 0 2px 20px rgba(0,0,0,0.07); }
    .text-orange { color: #ff8800; }
    .btn-orange { background-color: #ff8800; color: white; border: none; }
    .btn-orange:hover { background-color: #e67600; }
  </style>
</head>
<body>

<div class="register-box">
  <h4 class="text-orange text-center fw-semibold mb-4">📝 Daftar Akun UKMate</h4>
  <?php if ($msg): ?><div class="alert alert-warning"><?= $msg ?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Nama Lengkap</label>
      <input type="text" name="nama" class="form-control" required />
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required />
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required />
      <small class="text-muted">Minimal 6 karakter</small>
    </div>
    <button type="submit" class="btn btn-orange w-100">Daftar Sekarang</button>
    <div class="mt-3 text-center">
      <small>Sudah punya akun? <a href="login.php">Login di sini</a></small>
    </div>
  </form>
</div>

</body>
</html>