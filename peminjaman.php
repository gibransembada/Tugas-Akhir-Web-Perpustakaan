<script>
  document.addEventListener('DOMContentLoaded', function () {
    const dikembalikanButtons = document.querySelectorAll('.kembalikan-btn');

    dikembalikanButtons.forEach(function (button) {
      button.addEventListener('click', function (event) {
        event.preventDefault();
        const pinjamId = this.getAttribute('data-pinjamid');

        const confirmation = confirm('Apakah buku dikembalikan?');

        if (confirmation) {
          fetch(`kembali.php?pinjam_id=${pinjamId}`)
            .then(response => {
              if (response.ok) {
                alert('Buku berhasil dikembalikan!');
                location.reload();
              } else {
                throw new Error('Terjadi kesalahan saat menyimpan data pengembalian');
              }
            })
            .catch(error => {
              alert(error.message);
            });
        }
      });
    });
  });
</script>

<?php
include "header.php";

?>

<div class="container">
  <div class="row">
    <div class="col-lg-12 mt-2" style=min-height:480px;">
      <div class="card">
        <div class="card-header">
          Data Peminjaman
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <a href="tambah_pinjam.php" class="btn btn-primary">Tambah Peminjaman</a>
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
              $sql = "SELECT p.pinjam_id, b.judul AS judul_buku, a.nama AS nama_anggota, p.tanggal_peminjaman, p.tanggal_kembali, p.status 
              FROM peminjaman p 
              INNER JOIN buku b ON p.buku_id = b.buku_id 
              INNER JOIN anggota a ON p.anggota_id = a.anggota_id";
              $result = $mysqli->query($sql);
              $no = 1;
              if ($result->num_rows > 0) {
                echo "<table class='table table-bordered table-striped'>";
                echo "<tr>
                      <th>No</th>
                      <th>Id Pinjam</th>
                      <th>Judul Buku</th>
                      <th>Nama Peminjam</th>
                      <th>Tgl Pinjam</th>
                      <th>Tgl Kembali</th>
                      <th>Status</th>
                      <th>Aksi</th>
                      </tr>";
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $no++ . "</td>";
                  echo "<td>" . $row["pinjam_id"] . "</td>";
                  echo "<td>" . $row["judul_buku"] . "</td>";
                  echo "<td>" . $row["nama_anggota"] . "</td>";
                  echo "<td>" . $row["tanggal_peminjaman"] . "</td>";
                  echo "<td>" . $row["tanggal_kembali"] . "</td>";
                  echo "<td>" . $row["status"] . "</td>";
                  echo "<td><a href='kembali.php' class='btn btn-info kembalikan-btn' data-pinjamid='" . $row["pinjam_id"] . "'>Kembalikan</a></td>";
                  echo "</tr>";
                }
                echo "</table>";
              } else {
                echo "Tidak ada data Peminjaman.";
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