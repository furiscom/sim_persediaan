<?php
// Fungsi untuk menentukan tautan aktif
function active_link($link) {
  if (basename($_SERVER['PHP_SELF']) == $link) {
    echo 'active';
  }
}?>

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

<div class="sidebar">
  <a href="index.php" class="<?php active_link('index.php');?>"><i class="fa fa-home"></i> Dashboard</a>
  <a href="barang.php" class="<?php active_link('barang.php');?>"><i class="fa fa-boxes"></i> Manajemen Barang</a>
  <a href="pengadaan.php" class="<?php active_link('pengadaan.php');?>"><i class="fa fa-cart-plus"></i> Pengadaan Barang</a>
  <a href="permintaan.php" class="<?php active_link('permintaan.php');?>"><i class="fa fa-shopping-cart"></i> Permintaan Barang</a>
  <a href="pengeluaran.php" class="<?php active_link('pengeluaran.php');?>"><i class="fa fa-truck"></i> Pengeluaran Barang</a>
  <a href="laporan.php" class="<?php active_link('laporan.php');?>"><i class="fa fa-file-text"></i> Laporan</a>
  <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
</div>