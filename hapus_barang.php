<?php
include 'includes/db.php';
include 'includes/functions.php';

if (isset($_GET['id'])) {
    $id_barang = validate_input($_GET['id']);

    // Query untuk menghapus data barang
    $sql = "DELETE FROM barang WHERE id_barang = $id_barang";

    if (mysqli_query($conn, $sql)) {
        header("Location: barang.php"); // Redirect kembali ke halaman barang.php
        exit;
    } else {
        tampilkan_error("Error: ". $sql. "<br>". mysqli_error($conn));
    }
} else {
    die("ID Barang tidak ditemukan.");
}

mysqli_close($conn);?>