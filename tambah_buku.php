<?php
include "header.php";
include 'koneksi.php';

$query_kategori = "SELECT kategori_id, nama_kategori FROM kategori";
$result_kategori = $mysqli->query($query_kategori);

$kategori_options = array();
if ($result_kategori->num_rows > 0) {
  while ($row = $result_kategori->fetch_assoc()) {
    $kategori_options[$row['kategori_id']] = $row['nama_kategori'];
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $judul = $_POST['judul'];
  $pengarang = $_POST['pengarang'];
  $penerbit = $_POST['penerbit'];
  $tahun_terbit = $_POST['tahun_terbit'];
  $sinopsis = $_POST['sinopsis'];
  $kategori_id = $_POST['kategori_id'];

  $sql = "INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit, sinopsis, kategori_id) VALUES ('$judul',
    '$pengarang', '$penerbit', '$tahun_terbit', '$sinopsis', '$kategori_id')";

  if ($mysqli->query($sql) === TRUE) {
    header("Location: buku.php"); // Redirect ke tampilan awal setelah berhasil tambah data
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
          Tambah Data Buku
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <form action="" method="POST">
                <div class="form-group">
                  <label for="">Judul Buku</label>
                  <input type="text" class="form-control" placeholder="Judul Buku" name="judul">
                  <label for="">Pengarang</label>
                  <input type="text" class="form-control" placeholder="Pengarang" name="pengarang">
                  <label for="">Penerbit</label>
                  <input type="text" class="form-control" placeholder="Penerbit" name="penerbit">
                  <label for="">Tahun Terbit</label>
                  <input type="text" class="form-control" placeholder="Tahun Terbit" name="tahun_terbit">
                  <label for="">Sinopsis</label>
                  <input type="text" class="form-control" placeholder="Sinopsis" name="sinopsis">
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
include "footer.php";
?>