<?php
include 'includes/db.php';
include 'includes/functions.php';

if (isset($_GET['id'])) {
    $id_permintaan = validate_input($_GET['id']);

    // Query untuk menghapus data permintaan
    $sql = "DELETE FROM permintaan WHERE id_permintaan = $id_permintaan";

    if (mysqli_query($conn, $sql)) {
        header("Location: permintaan.php");
        exit;
    } else {
        tampilkan_error("Error: ". $sql. "<br>". mysqli_error($conn));
    }
} else {
    die("ID Permintaan tidak ditemukan.");
}

mysqli_close($conn);?>