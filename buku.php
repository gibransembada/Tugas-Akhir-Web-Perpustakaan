<?php
include "header.php";

?>

<div class="container">
  <div class="row">
    <div class="col-lg-12 mt-2" style=min-height:480px;">
      <div class="card">
        <div class="card-header">
          Data Buku
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <a href="tambah_buku.php" class="btn btn-primary">Tambah Data</a>
            </div>
            <div class="col">
              <from action="" class="from-inline float-right">
                <input type="text" class="from-control">
                <input type="submit" class="btn btn-primar ml-2">
              </from>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col">
              <?php
              include 'koneksi.php';
              $sql = "SELECT buku.*, kategori.nama_kategori FROM buku INNER JOIN kategori ON buku.kategori_id = kategori.kategori_id";
              $result = $mysqli->query($sql);
              $no = 1;
              if ($result->num_rows > 0) {
                echo "<table class='table table-bordered table-striped'>";
                echo "<tr>
                      <th>No</th>
                      <th>Id Buku</th>
                      <th>Judul</th>
                      <th>Pengarang</th>
                      <th>Penerbit</th>
                      <th>Tahun Terbit</th>
                      <th>Sinopsis</th>
                      <th>Kategori</th>
                      <th>Aksi</th>
                      </tr>";
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $no++ . "</td>";
                  echo "<td>" . $row["buku_id"] . "</td>";
                  echo "<td>" . $row["judul"] . "</td>";
                  echo "<td>" . $row["pengarang"] . "</td>";
                  echo "<td>" . $row["penerbit"] . "</td>";
                  echo "<td>" . $row["tahun_terbit"] . "</td>";
                  echo "<td>" . $row["sinopsis"] . "</td>";
                  echo "<td>" . $row["nama_kategori"] . "</td>";
                  echo "<td><a href='edit_buku.php?buku_id=" . $row["buku_id"] . "' class='btn btn-warning'>Edit</a> | <a href='hapus_buku.php?buku_id=" . $row["buku_id"] . "' class='btn btn-danger'>Hapus</a></td>";
                  echo "</tr>";
                }
                echo "</table>";
              } else {
                echo "Tidak ada data Buku.";
              }
              $mysqli->close();
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
include "footer.php";
?>