<h1>Form Edit Mahasiswa</h1>

<?php
    include 'koneksi.php';
    $id = $_GET['id'];
    $mahasiswa = $koneksi->query("SELECT * FROM tabel_mahasiswa WHERE id = '$id'");
    $row = $mahasiswa->fetch_assoc();

    $prodi = $koneksi->query("SELECT * FROM tabel_prodi"); // ambil semua prodi untuk dropdown
?>

<form action="mahasiswa/proses-mahasiswa.php" method="post">
    <input type="hidden" name="id" value="<?=$row['id']?>">

    <div class="mb-3">
        <label for="nim" class="form-label">NIM</label>
        <input type="number" class="form-control" id="nim" name="nim" value="<?=$row['nim']?>" required>
    </div>

    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?=$row['nama']?>" required>
    </div>

    <div class="mb-3">
        <label for="prodi" class="form-label">Prodi</label>
        <select class="form-control" name="prodi" id="prodi" required>
            <option value="">Pilih Prodi</option>
            <?php while ($p = $prodi->fetch_assoc()) { ?>
                <option value="<?=$p['id']?>" <?= ($row['prodi_id'] == $p['id']) ? 'selected' : '' ?>>
                    <?=$p['nama_prodi']?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?=$row['email']?>" required>
    </div>

    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" rows="3"><?=$row['alamat']?></textarea>
    </div>

    <input type="submit" name="update" value="Simpan" class="btn btn-success">
    <a href="index.php?folder=mahasiswa&page=data-mahasiswa" class="btn btn-warning">Batal</a>
</form>
