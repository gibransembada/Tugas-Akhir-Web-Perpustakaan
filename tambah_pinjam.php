<?php
include "header.php";
include 'koneksi.php';

// Query untuk mengambil daftar buku dari tabel buku
$query_buku = "SELECT buku_id, judul FROM buku";
$result_buku = $mysqli->query($query_buku);

// Query untuk mengambil daftar anggota dari tabel anggota
$query_anggota = "SELECT anggota_id, nama FROM anggota";
$result_anggota = $mysqli->query($query_anggota);

// Query untuk mendapatkan nilai ENUM dari kolom 'status'
$sql_enum = "SHOW COLUMNS FROM peminjaman LIKE 'status'";
$result_enum = $mysqli->query($sql_enum);

if ($result_enum) {
  $row_enum = $result_enum->fetch_assoc();
  preg_match("/^enum\(\'(.*)\'\)$/", $row_enum['Type'], $matches);
  $enum_list = explode("','", $matches[1]); // Mendapatkan daftar ENUM

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $buku_id = $_POST['buku_id'];
    $anggota_id = $_POST['anggota_id'];
    $tgl_pinjam = $_POST['tanggal_peminjaman'];
    $tgl_kembali = $_POST['tanggal_kembali'];
    $status = $_POST['status'];

    $sql = "INSERT INTO peminjaman (buku_id, anggota_id, tanggal_peminjaman, tanggal_kembali, status) VALUES ('$buku_id',
      '$anggota_id', '$tgl_pinjam', '$tgl_kembali', '$status')";

    if ($mysqli->query($sql) === TRUE) {
      header("Location: peminjaman.php"); // Redirect ke tampilan awal setelah berhasil tambah data
      exit;
    } else {
      echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $mysqli->close();
  }
} else {
  echo "Error: " . $mysqli->error;
}
?>

<div class="container">
  <div class="row">
    <div class="col-lg-12 mt-2" style=min-height:480px;">
      <div class="card">
        <div class="card-header">
          Tambah Data Peminjaman
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <form action="" method="POST">
                <div class="form-group">
                  <label for="">Buku</label>
                  <select class="form-control" name="buku_id">
                    <?php
                    while ($row_buku = $result_buku->fetch_assoc()) {
                      echo "<option value=\"" . $row_buku['buku_id'] . "\">" . $row_buku['judul'] . "</option>";
                    }
                    ?>
                  </select>
                  <label for="">Anggota</label>
                  <select class="form-control" name="anggota_id">
                    <?php
                    while ($row_anggota = $result_anggota->fetch_assoc()) {
                      echo "<option value=\"" . $row_anggota['anggota_id'] . "\">" . $row_anggota['nama'] . "</option>";
                    }
                    ?>
                  </select>
                  <label for="">Tanggal Peminjaman</label>
                  <input type="date" class="form-control" placeholder="Tanggal Peminjaman" name="tanggal_peminjaman">
                  <label for="">Tanggal Kembali</label>
                  <input type="date" class="form-control" placeholder="Tanggal Kembali" name="tanggal_kembali">
                  <label for="">Status</label>
                  <select class="form-control" name="status">
                    <?php
                    foreach ($enum_list as $enum_value) {
                      echo "<option value=\"$enum_value\">$enum_value</option>";
                    }
                    ?>
                  </select>
                </div>
                <input type="submit" class="btn btn-primary" value="Simpan">
              </form>
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