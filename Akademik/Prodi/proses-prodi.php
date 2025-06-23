<?php
// cek login atau belom
session_start(); //pastikan ini selalu ada setiap fungsi session
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
include '../koneksi.php';

if (isset($_POST['insert'])) {
    $kode_prodi = $_POST['kode_prodi'];
    $nama_prodi = $_POST['nama_prodi'];
    $keterangan = $_POST['keterangan'];
    // cek apakah nim dan email sudah ada

    $sql_cek = "SELECT * FROM tabel_prodi WHERE kode_prodi='$kode_prodi' OR nama_prodi='$nama_prodi'";
    $query_cek = $koneksi->query($sql_cek);

    if ($query_cek->num_rows > 0) {
         echo "<script>
            alert('kode prodi atau nama prodi sudah terdaftar!!');
            window.location.href = '../index.php?folder=prodi&page=form-prodi';
        </script>";
        exit;
    }

    $sql = "INSERT INTO tabel_prodi(kode_prodi, nama_prodi, keterangan)
            VALUES ('$kode_prodi', '$nama_prodi', '$keterangan')";
    //eksekusi query sql
    $query = $koneksi->query($sql);
    if ($query === TRUE) {
        // echo "DATA MAHASIGMA BERHASIL DISIMPAN";
        echo "<script>
            alert('DATA PRODI BERHASIL DI SIMPAN');
            window.location.href = '../index.php?folder=prodi&page=data-prodi';
        </script>";
    }
    else {
        echo "DATA GAGAL, GET OUT!!!!!!";
    }
}
elseif (isset($_POST['update'])) {
    $kode_prodi = $_POST['kode_prodi'];
    $nama_prodi = $_POST['nama_prodi'];
    $keterangan = $_POST['keterangan'];
    $id = $_POST['id'];

    $sql = "UPDATE tabel_prodi SET kode_prodi='$kode_prodi', nama_prodi='$nama_prodi', keterangan='$keterangan' WHERE id='$id'";
    //eksekusi query sql
    $query = $koneksi->query($sql);
    if ($query === TRUE) {
        echo "<script>
            alert('DATA MAHASISWA BERHASIL DIUPDATE');
            window.location.href = '../index.php?folder=prodi&page=data-prodi';
        </script>";
    }
    else {
        echo "DATA GAGAL DI UBAH, GET OUT!!!!!!";
    }
}
elseif (isset($_POST['delete'])) {
    // echo "Proses hapus";
    $id = $_POST['id'];
    $query = $koneksi->query("DELETE FROM tabel_prodi WHERE id='$id'");

        //eksekusi query sql
    if ($query === TRUE) {
        echo "<script>
            alert('DATA PRODI BERHASIL DI DELETE');
            window.location.href = '../index.php?folder=prodi&page=data-prodi';
        </script>";
    }
    else {
        echo "DATA GAGAL DI HAPUS, GET OUT!!!!!!";
    }
}
else {
    echo "Tidak ada form terkirim";
}
?>