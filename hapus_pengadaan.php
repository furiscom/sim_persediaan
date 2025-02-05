<?php
include 'includes/db.php';
include 'includes/functions.php';

if (isset($_GET['id'])) {
    $id_pengadaan = validate_input($_GET['id']);

    // Query untuk menghapus data pengadaan
    $sql = "DELETE FROM pengadaan WHERE id_pengadaan = $id_pengadaan";

    if (mysqli_query($conn, $sql)) {
        header("Location: pengadaan.php");
        exit;
    } else {
        tampilkan_error("Error: ". $sql. "<br>". mysqli_error($conn));
    }
} else {
    die("ID Pengadaan tidak ditemukan.");
}

mysqli_close($conn);?>