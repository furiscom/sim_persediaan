<?php
include 'includes/db.php';
include 'includes/functions.php';

require 'vendor/autoload.php'; // Include library PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file_excel'])) {
  $file_excel = $_FILES['file_excel']['tmp_name'];

  try {
    $spreadsheet = IOFactory::load($file_excel);
    $sheet = $spreadsheet->getActiveSheet();
    $highestRow = $sheet->getHighestRow();

    for ($row = 2; $row <= $highestRow; $row++) {
      $nama_barang = validate_input($sheet->getCellByColumnAndRow(1, $row)->getValue());
      $spesifikasi = validate_input($sheet->getCellByColumnAndRow(2, $row)->getValue());
      $satuan = validate_input($sheet->getCellByColumnAndRow(3, $row)->getValue());
      $stok = validate_input($sheet->getCellByColumnAndRow(4, $row)->getValue());
      $harga_satuan = validate_input($sheet->getCellByColumnAndRow(5, $row)->getValue());
      $jenis_barang = validate_input($sheet->getCellByColumnAndRow(6, $row)->getValue());

      // Ambil id_jenis dari tabel jenis_barang berdasarkan nama_jenis
      $sql_jenis = "SELECT id_jenis FROM jenis_barang WHERE nama_jenis = '$jenis_barang'";
      $result_jenis = mysqli_query($conn, $sql_jenis);
      if (mysqli_num_rows($result_jenis) > 0) {
        $row_jenis = mysqli_fetch_assoc($result_jenis);
        $id_jenis = $row_jenis['id_jenis'];
      } else {
        // Jika jenis barang tidak ditemukan, Anda dapat:
        // 1. Menambahkan jenis barang baru ke tabel jenis_barang
        // 2. Melewatkan baris ini dan melanjutkan ke baris berikutnya
        // 3. Menghentikan proses import dan menampilkan pesan error
        // Di sini, kita akan menambahkan jenis barang baru ke tabel jenis_barang
        $sql_insert_jenis = "INSERT INTO jenis_barang (nama_jenis) VALUES ('$jenis_barang')";
        if (mysqli_query($conn, $sql_insert_jenis)) {
          $id_jenis = mysqli_insert_id($conn);
        } else {
          throw new Exception("Error: ". $sql_insert_jenis. "<br>". mysqli_error($conn));
        }
      }

      // Query untuk menambahkan data ke database
      $sql = "INSERT INTO barang (nama_barang, spesifikasi, satuan, stok, harga_satuan, id_jenis) 
              VALUES ('$nama_barang', '$spesifikasi', '$satuan', '$stok', '$harga_satuan', '$id_jenis')";

      if (!mysqli_query($conn, $sql)) {
        throw new Exception("Error: ". $sql. "<br>". mysqli_error($conn));
      }
    }

    echo "Data barang berhasil diimport.";
  } catch (Exception $e) {
    echo "Terjadi kesalahan saat mengimport data: ". $e->getMessage();
  }
} else {
  echo "File Excel tidak ditemukan.";
}

mysqli_close($conn);?>