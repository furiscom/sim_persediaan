<?php
include 'includes/db.php';
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama_barang = validate_input($_POST['nama_barang']);
    $spesifikasi = validate_input($_POST['spesifikasi']);
    $satuan = validate_input($_POST['satuan']);
    $stok = validate_input($_POST['stok']);
    $harga_satuan = validate_input($_POST['harga_satuan']);
    $id_jenis = validate_input($_POST['jenis_barang']); // Ambil id_jenis dari dropdown

    // Query untuk menambahkan data ke database
    $sql = "INSERT INTO barang (nama_barang, spesifikasi, satuan, stok, harga_satuan, id_jenis) 
            VALUES ('$nama_barang', '$spesifikasi', '$satuan', '$stok', '$harga_satuan', '$id_jenis')";

    if (mysqli_query($conn, $sql)) {
        echo "Barang baru berhasil ditambahkan.";
    } else {
        echo "Error: ". $sql. "<br>". mysqli_error($conn);
    }
}

mysqli_close($conn);?>