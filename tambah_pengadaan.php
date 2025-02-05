<?php
include 'includes/db.php';
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $tanggal = validate_input($_POST['tanggal']);
    $supplier = validate_input($_POST['supplier']);
    $total_harga = validate_input($_POST['total_harga']);

    // Query untuk menambahkan data ke database
    $sql = "INSERT INTO pengadaan (tanggal, id_supplier, total_harga) 
            VALUES ('$tanggal', '$supplier', '$total_harga')";

    if (mysqli_query($conn, $sql)) {
        echo "Pengadaan baru berhasil ditambahkan.";
    } else {
        echo "Error: ". $sql. "<br>". mysqli_error($conn);
    }
}

mysqli_close($conn);?>