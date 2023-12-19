<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['pinjam_id'])) {
    $pinjam_id = $_GET['pinjam_id'];

    // Ambil data peminjaman yang akan dipindahkan ke tabel pengembalian
    $select_query = "SELECT * FROM peminjaman WHERE pinjam_id = $pinjam_id";
    $result = $mysqli->query($select_query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Simpan data yang akan dipindahkan ke variabel
        $pinjam_id = $row['pinjam_id'];
        $tanggal_pengembalian = date("Y-m-d H:i:s"); // Tanggal pengembalian saat ini

        // Tentukan status berdasarkan perbandingan tanggal pengembalian dan tanggal kembali
        $tanggal_kembali = $row['tanggal_kembali'];
        $status = ($tanggal_pengembalian > $tanggal_kembali) ? 'terlambat' : 'dikembalikan';

        // Pindahkan data ke tabel pengembalian
        $insert_query = "INSERT INTO pengembalian (pinjam_id, tanggal_pengembalian, status) VALUES ($pinjam_id, '$tanggal_pengembalian', '$status')";
        $mysqli->query($insert_query);

        // Hapus data peminjaman dari tabel peminjaman
        $delete_query = "DELETE FROM peminjaman WHERE pinjam_id = $pinjam_id";
        $mysqli->query($delete_query);

        // Redirect ke halaman peminjaman setelah proses pengembalian berhasil
        header("Location: peminjaman.php");
        exit();
    } else {
        echo "Data Peminjaman tidak ditemukan.";
    }
}
?>