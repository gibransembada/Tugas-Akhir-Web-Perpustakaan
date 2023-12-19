<?php
include "koneksi.php";
include "header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $anggota_id = $_POST['anggota_id'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $email = $_POST['email'];
  $telepon = $_POST['telepon'];

  $sql = "UPDATE anggota SET nama='$nama', alamat='$alamat', email='$email', telepon='$telepon' WHERE anggota_id=$anggota_id";

  if ($mysqli->query($sql) === TRUE) {
    header("Location: anggota.php"); // Redirect ke halaman anggota.php setelah berhasil update
    exit;
  } else {
    echo "Error updating record: " . $mysqli->error;
  }

  $mysqli->close();
} else {
  // Ambil ID dari parameter URL
  $anggota_id = $_GET['anggota_id'];

  // Query untuk mengambil informasi anggota berdasarkan ID
  $sql = "SELECT * FROM anggota WHERE anggota_id=$anggota_id";
  $result = $mysqli->query($sql);

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    // Tampilkan formulir untuk mengedit data
    ?>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mt-2" style=min-height:480px;">
          <div class="card">
            <div class="card-header">
              Edit Data Anggota
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <form action="" method="POST">
                    <div class="form-group">
                      <input type="hidden" name="anggota_id" value="<?php echo $row['anggota_id']; ?>">
                      <label for="">Nama</label>
                      <input type="text" class="form-control" placeholder="Nama" name="nama"
                        value="<?php echo $row['nama']; ?>">
                      <label for="">Alamat</label>
                      <input type="text" class="form-control" placeholder="Alamat" name="alamat"
                        value="<?php echo $row['alamat']; ?>">
                      <label for="">Email</label>
                      <input type="email" class="form-control" placeholder="Email" name="email"
                        value="<?php echo $row['email']; ?>">
                      <label for="">Telepon</label>
                      <input type="text" class="form-control" placeholder="No Telepon" name="telepon"
                        value="<?php echo $row['telepon']; ?>">
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
  } else {
    echo "Data Anggota tidak ditemukan.";
  }
}
?>

<?php
include 'footer.php';
?>