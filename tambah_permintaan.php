<?php
include 'includes/db.php';
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $tanggal = validate_input($_POST['tanggal']);
    $peminta = validate_input($_POST['peminta']);
    $status = validate_input($_POST['status']);

    // Query untuk menambahkan data ke database
    $sql = "INSERT INTO permintaan (tanggal, peminta, status) 
            VALUES ('$tanggal', '$peminta', '$status')";

    if (mysqli_query($conn, $sql)) {
        echo "Permintaan baru berhasil ditambahkan.";
    } else {
        echo "Error: ". $sql. "<br>". mysqli_error($conn);
    }
}

mysqli_close($conn);?>