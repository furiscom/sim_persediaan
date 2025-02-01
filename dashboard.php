<?php


// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
  // Jika belum login, arahkan ke halaman login
  header("Location: login.php");
  exit;
} ?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard - SIM Persediaan</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
  <style>
    /* Custom CSS for the sidebar */
  .sidebar {
      height: 100vh;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #333;
      padding-top: 20px;
      transition: all 0.3s ease-in-out;
    }

  .sidebar a {
      padding: 10px 20px;
      text-decoration: none;
      font-size: 16px;
      color: #fff;
      display: block;
      transition: all 0.3s ease-in-out;
    }

  .sidebar a:hover {
      background-color: #555;
      color: #ffc107;
    }

  .sidebar.fa {
      margin-right: 10px;
    }
  </style>
</head>
<body>

<?php 
include 'sidebar.php'; 
include 'includes/db.php';?>

<div class="ml-64 p-6">
  <h1 class="text-3xl font-bold text-gray-800 mb-4">Dashboard</h1>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white rounded-lg shadow-md p-6">
      <h2 class="text-xl font-semibold text-gray-700 mb-2">Total Barang</h2>
      <p class="text-4xl font-bold text-blue-500"><?php echo get_total_barang($conn);?></p>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6">
      <h2 class="text-xl font-semibold text-gray-700 mb-2">Total Pengadaan</h2>
      <p class="text-4xl font-bold text-green-500"><?php echo get_total_pengadaan($conn);?></p>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6">
      <h2 class="text-xl font-semibold text-gray-700 mb-2">Total Permintaan</h2>
      <p class="text-4xl font-bold text-yellow-500"><?php echo get_total_permintaan($conn);?></p>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6">
      <h2 class="text-xl font-semibold text-gray-700 mb-2">Total Pengeluaran</h2>
      <p class="text-4xl font-bold text-red-500"><?php echo get_total_pengeluaran($conn);?></p>
    </div>
  </div>

  </div>

<?php
// Function to get total barang
function get_total_barang($conn) {
  $sql = "SELECT COUNT(*) AS total FROM barang";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  return $row['total'];
}

// Function to get total pengadaan
function get_total_pengadaan($conn) {
  $sql = "SELECT COUNT(*) AS total FROM pengadaan";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  return $row['total'];
}

// Function to get total permintaan
function get_total_permintaan($conn) {
  $sql = "SELECT COUNT(*) AS total FROM permintaan";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  return $row['total'];
}

// Function to get total pengeluaran
function get_total_pengeluaran($conn) {
  $sql = "SELECT COUNT(*) AS total FROM pengeluaran";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  return $row['total'];
}?>

</body>
</html>