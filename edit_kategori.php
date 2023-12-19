<?php
include "koneksi.php";
include "header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['id'];
  $nama_kategori = $_POST['nama_kategori'];

  $sql = "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE kategori_id=$id";

  if ($mysqli->query($sql) === TRUE) {
    header("Location: kategori.php"); // Redirect ke halaman kategori.php setelah berhasil update
    exit;
  } else {
    echo "Error updating record: " . $mysqli->error;
  }

  $mysqli->close();
} else {
  // Ambil ID dari parameter URL
  $id = $_GET['id'];

  // Query untuk mengambil informasi kategori berdasarkan ID
  $sql = "SELECT * FROM kategori WHERE kategori_id=$id";
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
              Edit Data Kategori
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <form action="" method="POST">
                    <div class="form-group">
                      <label for="">Nama Kategori</label>
                      <input type="hidden" value="<?php echo $row['kategori_id']; ?>" name="id">
                      <input type="text" class="form-control" name="nama_kategori" value="<?php echo $row['nama_kategori']; ?>">
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
    echo "Data kategori tidak ditemukan.";
  }
}
?>

<?php
include 'footer.php';
?>