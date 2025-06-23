// search.php
include 'koneksi.php';

$search = $_GET['search'] ?? '';

// Cari di semua tabel yang relevan
$results = [
    'mahasiswa' => [],
    'prodi' => [],
    // tambahkan tabel lain jika perlu
];

if (!empty($search)) {
    // Cari di tabel mahasiswa
    $stmt = mysqli_prepare($koneksi, "SELECT * FROM mahasiswa WHERE nama LIKE ? OR nim LIKE ? OR email LIKE ?");
    $searchTerm = "%$search%";
    mysqli_stmt_bind_param($stmt, "sss", $searchTerm, $searchTerm, $searchTerm);
    mysqli_stmt_execute($stmt);
    $results['mahasiswa'] = mysqli_stmt_get_result($stmt)->fetch_all(MYSQLI_ASSOC);
    
    // Cari di tabel prodi
    $stmt = mysqli_prepare($koneksi, "SELECT * FROM prodi WHERE nama_prodi LIKE ? OR kode_prodi LIKE ?");
    mysqli_stmt_bind_param($stmt, "ss", $searchTerm, $searchTerm);
    mysqli_stmt_execute($stmt);
    $results['prodi'] = mysqli_stmt_get_result($stmt)->fetch_all(MYSQLI_ASSOC);
}

// Tampilkan hasil
foreach ($results as $table => $items) {
    if (!empty($items)) {
        echo "<h3>" . ucfirst($table) . "</h3>";
        // Tampilkan hasil dalam tabel
    }
}