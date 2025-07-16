<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: index.php");
  exit;
}

$nama_admin = $_SESSION['nama'] ?? 'Admin';
$ukm_filter = $_GET['ukm_id'] ?? '';

$whereClause = '';
if (!empty($ukm_filter)) {
  $ukm_id = intval($ukm_filter);
  $whereClause = "WHERE p.id_ukm = $ukm_id";
}

$query = "
  SELECT p.id, a.email, u.nama_ukm, p.nama_lengkap, p.nim, p.prodi, p.tanggal_daftar
  FROM pendaftaran p
  JOIN akun a ON p.id_user = a.id
  JOIN ukm u ON p.id_ukm = u.id
  $whereClause
  ORDER BY p.tanggal_daftar DESC
";
$result = mysqli_query($conn, $query);

// Ambil list UKM untuk dropdown
$ukmList = mysqli_query($conn, "SELECT * FROM ukm ORDER BY nama_ukm ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Data Pendaftar UKM</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body { background-color: #f9f9f9; font-family: 'Poppins', sans-serif; }
    .navbar-dark { background-color: #343a40; }
    .text-orange { color: #ff8800; }
    .table thead th { background-color: #ff8800; color: white; }
    .badge-date { background-color: #ffe5cc; color: #ff8800; font-weight: 500; }
    footer { border-top: 1px solid #ddd; background-color: #fff; }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="admin_dashboard.php">
      <span class="text-orange">UKMate</span> Admin
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarAdmin">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="tambah_ukm.php">Tambah UKM</a></li>
        <li class="nav-item"><a class="nav-link active" href="lihat_pendaftar.php">Pendaftar</a></li>
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

<div class="container py-5">
  <h4 class="mb-4 fw-semibold text-orange">📋 Daftar Pendaftar UKM</h4>

  <form method="get" class="mb-3">
    <div class="row g-2">
      <div class="col-md-4">
        <select name="ukm_id" class="form-select" onchange="this.form.submit()">
          <option value="">-- Tampilkan Semua UKM --</option>
          <?php while ($ukm = mysqli_fetch_assoc($ukmList)) {
            $selected = ($ukm_filter == $ukm['id']) ? 'selected' : '';
            echo "<option value='{$ukm['id']}' $selected>" . htmlspecialchars($ukm['nama_ukm']) . "</option>";
          } ?>
        </select>
      </div>
    </div>
  </form>

  <div class="table-responsive shadow-sm rounded bg-white mt-3">
    <?php if (mysqli_num_rows($result) > 0): ?>
      <table class="table table-striped table-hover mb-0">
        <thead>
          <tr>
            <th>#</th>
            <th>Email</th>
            <th>UKM</th>
            <th>Nama Lengkap</th>
            <th>NIM</th>
            <th>Prodi</th>
            <th>Tgl Daftar</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><strong><?= htmlspecialchars($row['nama_ukm']) ?></strong></td>
              <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
              <td><?= htmlspecialchars($row['nim']) ?></td>
              <td><?= htmlspecialchars($row['prodi']) ?></td>
              <td><span class="badge badge-date"><?= date('d M Y', strtotime($row['tanggal_daftar'])) ?></span></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php else: ?>
      <div class="alert alert-info">Tidak ada pendaftar untuk UKM ini.</div>
    <?php endif; ?>
  </div>
</div>

<footer class="py-4 mt-5">
  <div class="container text-center">
    <p class="mb-1 fw-semibold text-orange">© <?= date('Y') ?> UKMate • Admin Panel</p>
    <small class="text-muted">Dibuat oleh Muhammad Nabil al-Hafiz</small>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>