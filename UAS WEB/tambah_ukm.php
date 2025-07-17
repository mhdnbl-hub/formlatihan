<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: index.php");
  exit;
}

$nama_admin = $_SESSION['nama'] ?? 'Admin';
$msg = "";

// Hapus UKM
if (isset($_GET['hapus'])) {
  $id = intval($_GET['hapus']);
  mysqli_query($conn, "DELETE FROM ukm WHERE id = $id");
  header("Location: tambah_ukm.php");
  exit;
}

// Edit UKM
$edit_mode = false;
$edit_data = null;
if (isset($_GET['edit'])) {
  $edit_mode = true;
  $id_edit = intval($_GET['edit']);
  $result = mysqli_query($conn, "SELECT * FROM ukm WHERE id = $id_edit");
  $edit_data = mysqli_fetch_assoc($result);
}

// Tambah atau Perbarui UKM
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nama = trim(mysqli_real_escape_string($conn, $_POST['nama_ukm']));
  $deskripsi = trim(mysqli_real_escape_string($conn, $_POST['deskripsi']));

  if ($edit_mode) {
    $update = mysqli_query($conn, "UPDATE ukm SET nama_ukm='$nama', deskripsi='$deskripsi' WHERE id = $id_edit");
    $msg = $update ? "✅ UKM berhasil diperbarui." : "❌ Gagal memperbarui UKM.";
  } else {
    $cek = mysqli_query($conn, "SELECT * FROM ukm WHERE nama_ukm = '$nama'");
    if (mysqli_num_rows($cek) > 0) {
      $msg = "❌ UKM dengan nama yang sama sudah ada.";
    } else {
      $query = mysqli_query($conn, "INSERT INTO ukm (nama_ukm, deskripsi) VALUES ('$nama', '$deskripsi')");
      $msg = $query ? "✅ UKM berhasil ditambahkan." : "❌ Gagal menambahkan UKM.";
    }
  }

  header("Location: tambah_ukm.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Kelola UKM</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body { background-color: #fff8f0; font-family: 'Poppins', sans-serif; }
    .navbar-dark { background-color: #343a40; }
    .btn-orange { background-color: #ff8800; color: white; border: none; }
    .btn-orange:hover { background-color: #e67600; }
    .text-orange { color: #ff8800; }
    footer { border-top: 1px solid #dee2e6; background-color: #fff; }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="admin_dashboard.php">
      <span style="color: #ff8800;">UKMate</span> Admin
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarAdmin">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link active" href="tambah_ukm.php">Kelola UKM</a></li>
        <li class="nav-item"><a class="nav-link" href="lihat_pendaftar.php">Pendaftar</a></li>
      </ul>
      <div class="dropdown">
        <button class="btn btn-outline-light btn-sm dropdown-toggle" data-bs-toggle="dropdown">
          👤 <?= htmlspecialchars($nama_admin) ?>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<div class="container my-5" style="max-width: 720px;">
  <h4 class="mb-4 fw-semibold text-orange"><?= $edit_mode ? 'Edit UKM' : 'Tambah UKM Baru' ?></h4>

  <?php if ($msg): ?>
    <div class="alert alert-info shadow-sm"><?= $msg ?></div>
  <?php endif; ?>

  <form method="post" class="mb-5">
    <div class="mb-3">
      <label class="form-label">Nama UKM</label>
      <input type="text" name="nama_ukm" class="form-control" required
        value="<?= htmlspecialchars($edit_data['nama_ukm'] ?? '') ?>" />
    </div>
    <div class="mb-3">
      <label class="form-label">Deskripsi UKM</label>
      <textarea name="deskripsi" rows="4" class="form-control" required><?= htmlspecialchars($edit_data['deskripsi'] ?? '') ?></textarea>
    </div>
    <button type="submit" class="btn btn-orange"><?= $edit_mode ? 'Perbarui' : 'Simpan' ?></button>
    <?php if ($edit_mode): ?>
      <a href="tambah_ukm.php" class="btn btn-secondary ms-2">Batal Edit</a>
    <?php endif; ?>
  </form>

  <h5 class="fw-semibold text-orange">📋 Daftar UKM Terdaftar</h5>
  <div class="table-responsive mt-3">
    <table class="table table-bordered table-striped">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Nama UKM</th>
          <th>Deskripsi</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $result = mysqli_query($conn, "SELECT * FROM ukm ORDER BY id DESC");
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>{$no}</td>";
          echo "<td>" . htmlspecialchars($row['nama_ukm']) . "</td>";
          echo "<td>" . nl2br(htmlspecialchars($row['deskripsi'])) . "</td>";
          echo "<td>
                  <a href='tambah_ukm.php?edit={$row['id']}' class='btn btn-sm btn-warning me-1'>Edit</a>
                  <a href='tambah_ukm.php?hapus={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin hapus UKM ini?')\">Hapus</a>
                </td>";
          echo "</tr>";
          $no++;
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<footer class="py-4">
  <div class="container text-center">
    <p class="mb-1 fw-semibold text-orange">© <?= date('Y') ?> UKMate • Admin Panel</p>
    <small class="text-muted">Dibuat oleh Muhammad Nabil al-Hafiz</small>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
