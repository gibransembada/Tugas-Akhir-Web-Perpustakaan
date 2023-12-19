<?php
include "header.php";
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $email = $_POST['email'];
  $telepon = $_POST['telepon'];

  $sql = "INSERT INTO anggota (nama, alamat, email, telepon) VALUES ('$nama',
    '$alamat', '$email', '$telepon')";

  if ($mysqli->query($sql) === TRUE) {
    header("Location: anggota.php"); // Redirect ke tampilan awal setelah berhasil tambah data
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
          Tambah Data Anggota
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <form action="" method="POST">
                <div class="form-group">
                  <label for="">Nama</label>
                  <input type="text" class="form-control" placeholder="Nama" name="nama">
                  <label for="">Alamat</label>
                  <input type="text" class="form-control" placeholder="Alamat" name="alamat">
                  <label for="">Email</label>
                  <input type="email" class="form-control" placeholder="Email" name="email">
                  <label for="">Telepon</label>
                  <input type="text" class="form-control" placeholder="No Telepon" name="telepon">
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