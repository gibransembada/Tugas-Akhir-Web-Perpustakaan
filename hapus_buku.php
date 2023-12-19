<?php
include 'koneksi.php';
$buku_id = $_GET['buku_id']; // ID dari buku yang akan dihapus
$sql = "DELETE FROM buku WHERE buku_id=$buku_id";
if ($mysqli->query($sql) === TRUE) {
    header("Location: buku.php"); // Redirect ke tampilan Read setelah berhasil hapus data
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}
$mysqli->close();
?>