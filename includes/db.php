<?php
$host = "localhost"; // Ganti dengan host database Anda
$user = "ujk6jyva_admin"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$database = "ujk6jyva_sim_persediaan"; // Ganti dengan nama database Anda

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi database gagal: ". mysqli_connect_error());
}?>