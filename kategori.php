<?php
include "header.php";
?>

<div class="container">
  <div class="row">
    <div class="col-lg-12 mt-2" style=min-height:480px;">
      <div class="card">
        <div class="card-header">
          Data Kategori
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <a href="tambah_kategori.php" class="btn btn-primary">Tambah Data</a>
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
              $sql = "SELECT * FROM kategori";
              $result = $mysqli->query($sql);
              $no = 1;
              if ($result->num_rows > 0) {
                echo "<table class='table table-bordered table-striped'>";
                echo "<tr>
                      <th>No</th>
                      <th>Id Kategori</th>
                      <th>Nama Kategori</th>
                      <th>Aksi</th>
                      </tr>";
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $no++ . "</td>";
                  echo "<td>" . $row["kategori_id"] . "</td>";
                  echo "<td>" . $row["nama_kategori"] . "</td>";
                  echo "<td><a href='edit_kategori.php?id=" . $row["kategori_id"] . "' class='btn btn-warning'>Edit</a> | <a href='hapus_kategori.php?id=" . $row["kategori_id"] . "' class='btn btn-danger'>Hapus</a></td>";
                  echo "</tr>";
                }
                echo "</table>";
              } else {
                echo "Tidak ada data kategori.";
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