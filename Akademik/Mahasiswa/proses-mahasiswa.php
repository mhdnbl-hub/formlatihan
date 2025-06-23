<?php
// cek login
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
include '../koneksi.php';

// INSERT
if (isset($_POST['insert'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $prodi = $_POST['prodi'];

    $sql_cek = "SELECT * FROM tabel_mahasiswa WHERE nim='$nim' OR email='$email'";
    $query_cek = $koneksi->query($sql_cek);

    if ($query_cek->num_rows > 0) {
        echo "<script>
            alert('NIM atau Email sudah terdaftar!');
            window.location.href = '../index.php?folder=mahasiswa&page=form-mahasiswa';
        </script>";
        exit;
    }

    $sql = "INSERT INTO tabel_mahasiswa(nim, nama, prodi_id, email, alamat)
            VALUES ('$nim', '$nama', '$prodi', '$email', '$alamat')";
    $query = $koneksi->query($sql);

    if ($query === TRUE) {
        echo "<script>
            alert('Data Mahasiswa berhasil disimpan');
            window.location.href = '../index.php?folder=mahasiswa&page=data-mahasiswa';
        </script>";
    } else {
        echo "Data gagal disimpan!";
    }
}

// UPDATE
elseif (isset($_POST['update'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $prodi = $_POST['prodi'];
    $id = $_POST['id'];

    $sql = "UPDATE tabel_mahasiswa 
            SET nim='$nim', nama='$nama', prodi_id='$prodi', email='$email', alamat='$alamat' 
            WHERE id='$id'";
    $query = $koneksi->query($sql);

    if ($query === TRUE) {
        echo "<script>
            alert('Data Mahasiswa berhasil di update');
            window.location.href = '../index.php?folder=mahasiswa&page=data-mahasiswa';
        </script>";
    } else {
        echo "Data gagal di update!";
    }
}

// DELETE
elseif (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $query = $koneksi->query("DELETE FROM tabel_mahasiswa WHERE id='$id'");

    if ($query === TRUE) {
        echo "<script>
            alert('Data Mahasiswa berhasil dihapus');
            window.location.href = '../index.php?folder=mahasiswa&page=data-mahasiswa';
        </script>";
    } else {
        echo "Data gagal dihapus!";
    }
}

else {
    echo "Tidak ada form terkirim";
}
?>
