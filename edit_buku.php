<?php
include "koneksi.php";
include "header.php";

$query_kategori = "SELECT kategori_id, nama_kategori FROM kategori";
$result_kategori = $mysqli->query($query_kategori);

$kategori_options = array();
if ($result_kategori->num_rows > 0) {
  while ($row = $result_kategori->fetch_assoc()) {
    $kategori_options[$row['kategori_id']] = $row['nama_kategori'];
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $buku_id = $_POST['buku_id'];
  $judul = $_POST['judul'];
  $pengarang = $_POST['pengarang'];
  $penerbit = $_POST['penerbit'];
  $tahun_terbit = $_POST['tahun_terbit'];
  $sinopsis = $_POST['sinopsis'];
  $kategori_id = $_POST['kategori_id'];

  $sql = "UPDATE buku SET judul='$judul', pengarang='$pengarang', penerbit='$penerbit', tahun_terbit='$tahun_terbit', sinopsis='$sinopsis', kategori_id='$kategori_id' WHERE buku_id=$buku_id";

  if ($mysqli->query($sql) === TRUE) {
    header("Location: buku.php"); // Redirect ke halaman buku.php setelah berhasil update
    exit;
  } else {
    echo "Error updating record: " . $mysqli->error;
  }

  $mysqli->close();
} else {
  // Ambil ID dari parameter URL
  $buku_id = $_GET['buku_id'];

  // Query untuk mengambil informasi buku berdasarkan ID
  $sql = "SELECT * FROM buku WHERE buku_id=$buku_id";
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
              Edit Data Buku
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <form action="" method="POST">
                    <div class="form-group">
                      <input type="hidden" name="buku_id" value="<?php echo $row['buku_id']; ?>">
                      <label for="">Judul Buku</label>
                      <input type="text" class="form-control" placeholder="Judul Buku" name="judul"
                        value="<?php echo $row['judul']; ?>">
                      <label for="">Pengarang</label>
                      <input type="text" class="form-control" placeholder="Pengarang" name="pengarang"
                        value="<?php echo $row['pengarang']; ?>">
                      <label for="">Penerbit</label>
                      <input type="text" class="form-control" placeholder="Penerbit" name="penerbit"
                        value="<?php echo $row['penerbit']; ?>">
                      <label for="">Tahun Terbit</label>
                      <input type="text" class="form-control" placeholder="Tahun Terbit" name="tahun_terbit"
                        value="<?php echo $row['tahun_terbit']; ?>">
                      <label for="">Sinopsis</label>
                      <input type="text" class="form-control" placeholder="Sinopsis" name="sinopsis"
                        value="<?php echo $row['sinopsis']; ?>">
                      <label for="">Kategori</label>
                      <select class="form-control" name="kategori_id">
                        <?php foreach ($kategori_options as $id => $nama_kategori) { ?>
                          <option value="<?php echo $id; ?>">
                            <?php echo $nama_kategori; ?>
                          </option>
                        <?php } ?>
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
  } else {
    echo "Data Buku tidak ditemukan.";
  }
}
?>

<?php
include 'footer.php';
?>