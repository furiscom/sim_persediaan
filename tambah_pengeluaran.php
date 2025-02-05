<?php
include 'includes/db.php';
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $tanggal = validate_input($_POST['tanggal']);
    $penerima = validate_input($_POST['penerima']);
    $keterangan = validate_input($_POST['keterangan']);

    // Query untuk menambahkan data ke database
    $sql = "INSERT INTO pengeluaran (tanggal, penerima, keterangan) 
            VALUES ('$tanggal', '$penerima', '$keterangan')";

    if (mysqli_query($conn, $sql)) {
        echo "Pengeluaran baru berhasil ditambahkan.";
    } else {
        echo "Error: ". $sql. "<br>". mysqli_error($conn);
    }
}

mysqli_close($conn);?>