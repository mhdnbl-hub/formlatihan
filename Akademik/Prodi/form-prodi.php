
            <h1>Form Prodi</h1>
            <form action="prodi/proses-prodi.php" method="post">
                <div class="mb-3">
                    <label for="nim" class="form-label">Kode prodi</label>
                        <input type="text" class="form-control" id="nim" name="kode_prodi" require>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama prodi</label>
                        <input type="text" class="form-control" id="nama" name="nama_prodi" require>
                </div>
                <div class="mb-3">
                    <label for="Alamat" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="alamat" name="keterangan" rows="3"></textarea>
                </div>
                <input type="submit" name="insert" value="Simpan" class="btn btn-success">
            </form>
