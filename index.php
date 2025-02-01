<?php
session_start(); // Mulai sesi

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
  // Jika belum login, arahkan ke halaman login
  header("Location: login.php");
  exit;
}

// Jika sudah login, tampilkan konten halaman index
#include 'sidebar.php'
;?>

<!DOCTYPE html>
<html>
<head>
  <title>SIM Persediaan</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    /* CSS untuk sidebar */
  .sidebar {
      height: 100vh;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #333;
      padding-top: 20px;
      transition: all 0.3s ease-in-out; /* Efek transisi */
    }

  .sidebar a {
      padding: 10px 20px;
      text-decoration: none;
      font-size: 16px;
      color: #fff;
      display: block;
      transition: all 0.3s ease-in-out; /* Efek transisi */
    }

  .sidebar a:hover {
      background-color: #555;
      color: #ffc107; /* Warna kuning saat hover */
    }

  .sidebar.fa {
      margin-right: 10px; /* Jarak antara ikon dan teks */
    }

  .content {
      margin-left: 250px;
      padding: 20px;
    }

    /* Efek hover untuk elemen di content */
  .content.card:hover {
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      transform: translateY(-5px);
    }
  </style>
</head>
<body>

<?php include 'sidebar.php';?>

<div class="content">
  <h2>Selamat datang di SIM Persediaan</h2>

  <div class="row">
    <div class="col-md-4">
      <div class="card mt-4">
        <div class="card-body">
          <h5 class="card-title"><i class="fa fa-boxes"></i> Total Barang</h5>
          <p class="card-text">100</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mt-4">
        <div class="card-body">
          <h5 class="card-title"><i class="fa fa-cart-plus"></i> Total Pengadaan</h5>
          <p class="card-text">50</p>
        </div>
      </div>
    </div>
    </div>
</div>

</body>
</html>