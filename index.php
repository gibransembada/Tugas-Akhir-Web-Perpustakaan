<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('location: login.php');
  exit();
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Perpustakaan</title>
</head>

<body>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">Perpustakaan</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Data
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="kategori.php">Kategori</a>
              <a class="dropdown-item" href="buku.php">Buku</a>
              <a class="dropdown-item" href="anggota.php">Anggota</a>
              <a class="dropdown-item" href="katalog.php">Katalog</a>
              <a class="dropdown-item" href="lokasi_buku.php">Lokasi Buku</a>
              <a class="dropdown-item" href="staff.php">Staff</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Transaksi
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="peminjaman.php">Peminjaman</a>
              <a class="dropdown-item" href="pengembalian.php">Pengembalian</a>
              <a class="dropdown-item" href="denda.php">Denda</a>
            </div>
          </li>
          <li>
            <a class="navbar-brand" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- akhir navbar -->

  <!--content-->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 mt-3">
        <div class="jumbotron jumbotron-fluid">
          <div class="container">
            <h2 class="display-4">Selamat Datang</h2>
            <p class="lead">Di Perpustakaan Gibran Sembada</p>
          </div>
        </div>
      </div>
    </div>
    <?php
    // Lakukan koneksi ke database
    include "koneksi.php";

    // Query jumlah data peminjaman
    $sql_peminjaman = "SELECT COUNT(*) as total_peminjaman FROM peminjaman";
    $result_peminjaman = $mysqli->query($sql_peminjaman);
    $row_peminjaman = $result_peminjaman->fetch_assoc();
    $total_peminjaman = $row_peminjaman['total_peminjaman'];

    // Query jumlah data pengembalian
    $sql_pengembalian = "SELECT COUNT(*) as total_pengembalian FROM pengembalian";
    $result_pengembalian = $mysqli->query($sql_pengembalian);
    $row_pengembalian = $result_pengembalian->fetch_assoc();
    $total_pengembalian = $row_pengembalian['total_pengembalian'];

    // Query jumlah data buku
    $sql_buku = "SELECT COUNT(*) as total_buku FROM buku";
    $result_buku = $mysqli->query($sql_buku);
    $row_buku = $result_buku->fetch_assoc();
    $total_buku = $row_buku['total_buku'];

    // Query jumlah data anggota
    $sql_anggota = "SELECT COUNT(*) as total_anggota FROM anggota";
    $result_anggota = $mysqli->query($sql_anggota);
    $row_anggota = $result_anggota->fetch_assoc();
    $total_anggota = $row_anggota['total_anggota'];

    // Tutup koneksi ke database
    $mysqli->close();
    ?>
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Peminjaman</h5>
            <p class="card-text">Jumlah transaksi peminjaman
              <?php echo $total_peminjaman; ?>
            </p>
            <a href="#" class="btn btn-primary">Peminjaman</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Pengembalian</h5>
            <p class="card-text">Jumlah transaksi pengembalian
              <?php echo $total_pengembalian; ?>
            </p>
            <a href="#" class="btn btn-primary">Pengembalian</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Data Buku</h5>
            <p class="card-text">Jumlah buku yang tersedia
              <?php echo $total_buku; ?> buku
            </p>
            <a href="#" class="btn btn-primary">Data Buku</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Data Anggota</h5>
            <p class="card-text">Jumlah anggota
              <?php echo $total_anggota; ?> anggota
            </p>
            <a href="#" class="btn btn-primary">Data Anggota</a>
          </div>
        </div>
      </div>
    </div>

    <!-- akhir content-->

    <!-- footer-->
    <footer class="mt-5 bg-dark p-3 text-center" style="color:white;font-weight: bold;">
      <p>Perpustakaan Gibran Sembada &copy; 2023</p>
    </footer>
    <!--akhir footer-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"></script>
</body>

</html>