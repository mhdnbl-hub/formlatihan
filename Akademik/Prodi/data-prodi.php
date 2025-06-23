<h1>Data Prodi</h1>
<a href="index.php?folder=prodi&page=form-prodi" class="btn btn-success">Input data prodi</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Kode Prodi</th>
            <th scope="col">Nama Prodi</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'koneksi.php';
        $prodi = $koneksi->query("SELECT * FROM tabel_prodi");
        $no = 1;
        while ($row = $prodi->fetch_assoc()) {
        ?>
        <tr>
            <th scope="row"><?=$no++ ?></th>
            <td><?=$row['kode_prodi']?></td>
            <td><?=$row['nama_prodi']?></td>
            <td><?=$row['keterangan']?></td>
            <td>
                <div class="d-flex gap-1">
                    <a href="index.php?folder=prodi&page=update-prodi&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <form action="prodi/proses-prodi.php" method="post">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input onclick="return confirm('Are you sure?')" type="submit" name="delete" value="Hapus" class="btn btn-danger btn-sm">
                    </form>
                </div>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>