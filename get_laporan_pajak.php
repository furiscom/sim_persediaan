<?php
include 'includes/db.php';

if (isset($_GET['periode']) && isset($_GET['ppn']) && isset($_GET['pph'])) {
    $periode = $_GET['periode'];
    $ppn_persen = $_GET['ppn'];
    $pph_persen = $_GET['pph'];

    // Query untuk menghitung total PPN dan PPh dari tabel pengadaan
    $sql_pengadaan = "SELECT 
                        SUM(total_harga * ($ppn_persen / 100)) AS total_ppn, 
                        SUM(total_harga * ($pph_persen / 100)) AS total_pph 
                      FROM pengadaan 
                      WHERE DATE_FORMAT(tanggal, '%Y-%m') = '$periode'";
    $result_pengadaan = mysqli_query($conn, $sql_pengadaan);
    $pengadaan = mysqli_fetch_assoc($result_pengadaan);

    // Query untuk menghitung total PPN dan PPh dari tabel pengeluaran
    $sql_pengeluaran = "SELECT SUM(p.total_harga * ($ppn_persen  / 100)) AS total_ppn,
       SUM(p.total_harga * ($pph_persen / 100)) AS total_pph
FROM pengadaan p
WHERE DATE_FORMAT(p.tanggal, '%Y-%m') ;";
    $result_pengeluaran = mysqli_query($conn, $sql_pengeluaran);
    $pengeluaran = mysqli_fetch_assoc($result_pengeluaran);

    // Query untuk menghitung total PPN dan PPh dari tabel permintaan
    // (Asumsi permintaan tidak memiliki total_harga, sesuaikan dengan kebutuhan)
    $sql_permintaan = "SELECT 
                            0 AS total_ppn, 
                            0 AS total_pph"; 
    $result_permintaan = mysqli_query($conn, $sql_permintaan);
    $permintaan = mysqli_fetch_assoc($result_permintaan);

    // Kirim data laporan dalam format JSON
    echo json_encode(array(
        'pengadaan' => $pengadaan,
        'pengeluaran' => $pengeluaran,
        'permintaan' => $permintaan
    ));
    exit;
}?>