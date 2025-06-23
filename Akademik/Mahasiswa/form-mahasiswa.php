
        <h1>Form Mahasiswa</h1>
        <form action="mahasiswa/proses-mahasiswa.php" method="post">
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                    <input type="number" class="form-control" id="nim" name="nim" require>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" require>
            </div>
            <div class="mb-3">
                <label for="prodi" class="form-label">Prodi</label>
                    <select class="form-control"name="prodi" id="prodi" require>
                        <option value="">Pilih Prodi</option>
                        <?php
                        $prodi = $koneksi->query("SELECT * FROM tabel_prodi");
                        while ($p = $prodi->fetch_assoc()){
                        ?>
                        <option value="<?=$p['id']?>"><?=$p['nama_prodi']?></option>
                        
                        <?php }?>
                    </select>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" require>
            </div>
            <div class="mb-3">
                <label for="Alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
            </div>
            <input type="submit" name="insert" value="Simpan" class="btn btn-success">
        </form>
        
