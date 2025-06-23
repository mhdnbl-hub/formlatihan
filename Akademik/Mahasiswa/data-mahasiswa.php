
        <h1>Data Mahasiswa</h1>
        <a href ="index.php?folder=mahasiswa&page=form-mahasiswa" class ="btn btn-success">Input Data Mahasiswa</a>
          <table class="table">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">NIM</th>
        <th scope="col">Nama</th>
        <th scope="col">Email</th>
        <th scope="col">Prodi</th>
        <th scope="col">Alamat</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      include 'koneksi.php';
      $mahasiswa = $koneksi->query("SELECT m.*, p.nama_prodi FROM tabel_mahasiswa m LEFT JOIN tabel_prodi p ON m.prodi_id=p.id");
      $no = 1;
      while ($row = $mahasiswa->fetch_assoc()) {
          
      ?>
      <tr>
        <th scope="row"><?=$no++ ?></th>
        <td><?=$row['nim']?></td>
        <td><?=$row['nama']?></td>
        <td><?=$row['email']?></td>
        <td><?=$row['nama_prodi']?></td>
        <td><?=$row['alamat']?></td>
        <td>
          <div class="d-flex gap-1">
            <a href="index.php?folder=mahasiswa&page=update-mahasiswa&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <form action="mahasiswa/proses-mahasiswa.php" method="post">
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
              <input onclick="return confirm('Are u sure?')" type="submit" name="delete" value="Hapus" class="btn btn-danger btn-sm">
            </form>
          </div>
        </td>
      </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
