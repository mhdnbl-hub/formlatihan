
        <h1>Form Edit Prodi</h1>
        
        <?php
            include 'koneksi.php';
            $id = $_GET['id'];
            $prodi = $koneksi->query("SELECT * FROM tabel_prodi WHERE id = '$id'");
            $row = $prodi->fetch_assoc();
        ?>
        <form action="prodi/proses-prodi.php" method="post">
            <input type="hidden" name="id" value="<?=$row['id']?>">
            <div class="mb-3">
                <label for="nim" class="form-label">Kode Prodi</label>
                    <input type="text" class="form-control" id="nim" name="kode_prodi" value="<?=$row['kode_prodi']?>" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Prodi</label>
                    <input type="text" class="form-control" id="nama" name="nama_prodi" value="<?=$row['nama_prodi']?>" required>
            </div>
            <div class="mb-3">
                <label for="Alamat" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="alamat" name="keterangan" rows="3"><?=$row['keterangan']?></textarea>
            </div>
            <input type="submit" name="update" value="Simpan" class="btn btn-success">
            <a href="index.php?folder=prodi&page=data-prodi" class="btn btn-warning">Batal</a>
        </form>
