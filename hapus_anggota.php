<?php
include 'koneksi.php';
$anggota_id = $_GET['anggota_id']; // ID dari anggota yang akan dihapus
$sql = "DELETE FROM anggota WHERE anggota_id=$anggota_id";
if ($mysqli->query($sql) === TRUE) {
    header("Location: anggota.php"); // Redirect ke tampilan Read setelah berhasil hapus data
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}
$mysqli->close();
?>