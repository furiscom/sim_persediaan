<?php

// Fungsi untuk mengambil data barang dari database
function get_data_barang($conn) {
  $query = "SELECT * FROM barang"; // Sesuaikan dengan nama tabel Anda
  $result = mysqli_query($conn, $query);
  
  if (!$result) {
      die("Query Error: " . mysqli_error($conn));
  }
  
  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
  }
  return $data;
}

// Fungsi untuk validasi input
function validate_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Fungsi untuk menampilkan pesan error
function tampilkan_error($pesan_error) {
  echo "<div class='error'>$pesan_error</div>";
}

// Fungsi lainnya dapat ditambahkan di sini
//...?>