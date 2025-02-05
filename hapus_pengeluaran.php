<?php
include 'includes/db.php';
include 'includes/functions.php';

if (isset($_GET['id'])) {
    $id_pengeluaran = validate_input($_GET['id']);

    // Query untuk menghapus data pengeluaran
    $sql = "DELETE FROM pengeluaran WHERE id_pengeluaran = $id_pengeluaran";

    if (mysqli_query($conn, $sql)) {
        header("Location: pengeluaran.php");
        exit;
    } else {
        tampilkan_error("Error: ". $sql. "<br>". mysqli_error($conn));
    }
} else {
    die("ID Pengeluaran tidak ditemukan.");
}

mysqli_close($conn);?>