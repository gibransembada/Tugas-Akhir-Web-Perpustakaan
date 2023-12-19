<?php
include "header.php";
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama_kategori = $_POST['nama_kategori'];
  $sql = "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')";

  if ($mysqli->query($sql) === TRUE) {
    header("Location: kategori.php"); // Redirect ke tampilan awal setelah berhasil tambah data
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
  }
  $mysqli->close();
}
?>

<div class="container">
  <div class="row">
    <div class="col-lg-12 mt-2" style=min-height:480px;">
      <div class="card">
        <div class="card-header">
          Tambah Data Kategori
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <form action="" method="POST">
                <div class="form-group">
                  <label for="">Nama Kategori</label>
                  <input type="text" class="form-control" placeholder="Nama Kategori" name="nama_kategori">
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