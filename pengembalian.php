<?php
include "header.php";

?>

<div class="container">
  <div class="row">
    <div class="col-lg-12 mt-2" style=min-height:480px;">
      <div class="card">
        <div class="card-header">
          Data Pengembalian
        </div>
        <div class="card-body">
          <div class="row">
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
              $sql = "SELECT * FROM pengembalian";
              $result = $mysqli->query($sql);
              $no = 1;
              if ($result->num_rows > 0) {
                echo "<table class='table table-bordered table-striped'>";
                echo "<tr>
                      <th>No</th>
                      <th>Id Pengembalian</th>
                      <th>Nama Peminjam</th>
                      <th>Judul Buku</th>
                      <th>Tgl Pinjam</th>
                      <th>Tgl Kembali</th>
                      <th>Tgl Pengembalian</th>
                      <th>Status</th>
                      </tr>";
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $no++ . "</td>";
                  echo "<td>" . $row[""] . "</td>";
                  echo "<td>" . $row[""] . "</td>";
                  echo "<td>" . $row[""] . "</td>";
                  echo "<td>" . $row[""] . "</td>";
                  echo "<td>" . $row[""] . "</td>";
                  echo "<td>" . $row["status"] . "</td>";
                  echo "</tr>";
                }
                echo "</table>";
              } else {
                echo "Tidak ada data Pengembalian.";
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