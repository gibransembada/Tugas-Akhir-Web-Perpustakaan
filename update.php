<?php
include "koneksi.php";

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
        <!DOCTYPE html>
        <html>
        <head>
            <title>Edit Kategori</title>
        </head>
        <body>
            <h2>Edit Kategori</h2>
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['kategori_id']; ?>">
                Nama Kategori: <input type="text" name="nama_kategori" value="<?php echo $row['nama_kategori']; ?>"><br><br>
                <input type="submit" value="Update">
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "Data kategori tidak ditemukan.";
    }
}
?>
