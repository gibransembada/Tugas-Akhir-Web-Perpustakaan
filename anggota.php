<?php
include "header.php";

?>

<div class="container">
  <div class="row">
    <div class="col-lg-12 mt-2" style=min-height:480px;">
      <div class="card">
        <div class="card-header">
          Data Anggota
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <a href="tambah_anggota.php" class="btn btn-primary">Tambah Anggota</a>
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
              $sql = "SELECT * FROM anggota";
              $result = $mysqli->query($sql);
              $no = 1;
              if ($result->num_rows > 0) {
                echo "<table class='table table-bordered table-striped'>";
                echo "<tr>
                      <th>No</th>
                      <th>Id Anggota</th>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>Email</th>
                      <th>Telepon</th>
                      <th>Aksi</th>
                      </tr>";
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $no++ . "</td>";
                  echo "<td>" . $row["anggota_id"] . "</td>";
                  echo "<td>" . $row["nama"] . "</td>";
                  echo "<td>" . $row["alamat"] . "</td>";
                  echo "<td>" . $row["email"] . "</td>";
                  echo "<td>" . $row["telepon"] . "</td>";
                  echo "<td><a href='edit_anggota.php?anggota_id=" . $row["anggota_id"] . "' class='btn btn-warning'>Edit</a> | <a href='hapus_anggota.php?anggota_id=" . $row["anggota_id"] . "' class='btn btn-danger'>Hapus</a></td>";
                  echo "</tr>";
                }
                echo "</table>";
              } else {
                echo "Tidak ada data anggota.";
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