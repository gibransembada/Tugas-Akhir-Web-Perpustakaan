<?php
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