<?php
include 'koneksi.php';

$password = password_hash("admin123", PASSWORD_DEFAULT);

mysqli_query($conn, "DELETE FROM akun WHERE email = 'admin@ukmate.com'");

mysqli_query($conn, "INSERT INTO akun (nama, email, password, role) VALUES (
  'Admin UKMate',
  'admin@ukmate.com',
  '$password',
  'admin'
)");

echo "✅ Akun admin berhasil dibuat ulang dengan password: admin123";
?>