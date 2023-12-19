<?php
include 'koneksi.php';
$sql = "SELECT * FROM kategori";
$result = $mysqli->query($sql);
$no=1;
if ($result->num_rows > 0) {
    echo "<table class='table table-bordered table-striped'>";
    echo "<tr>
            <th>No</th>
            <th>Kode Kategori</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
          </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $no++ ."</td>";
        echo "<td>" . $row["kategori_id"] . "</td>";
        echo "<td>" . $row["nama_kategori"] . "</td>";
        echo "<td><a href='update.php?id=" . $row["kategori_id"] . "' class='btn btn-warning'>Edit</a> | <a href='delete.php?id=" . $row["kategori_id"] . "' class='btn btn-danger'>Hapus</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data buku.";
}
$mysqli->close();
?>