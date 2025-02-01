<?php
include 'includes/db.php';
include 'includes/functions.php';

// Tangani permintaan AJAX untuk mendapatkan laporan
if (isset($_GET['jenis']) && isset($_GET['periode'])) {
    $jenis_laporan = $_GET['jenis'];
    $periode = $_GET['periode'];

    // Inisialisasi array untuk menyimpan data laporan
    $labels = array();
    $data = array();
    $label = '';

    switch ($jenis_laporan) {
        case 'stok_barang':
            // Laporan stok barang
            $data = get_data_stok_barang($conn);
            break;

        case 'pengadaan':
            // Laporan pengadaan barang
            $result = get_data_laporan_pengadaan($conn, $periode);
            $labels = $result['labels'];
            $data = $result['data'];
            $label = 'Jumlah Pengadaan';
            break;

        case 'permintaan':
            // Laporan permintaan barang
            $result = get_data_laporan_permintaan($conn, $periode);
            $labels = $result['labels'];
            $data = $result['data'];
            $label = 'Jumlah Permintaan';
            break;

        case 'pengeluaran':
            // Laporan pengeluaran barang
            $result = get_data_laporan_pengeluaran($conn, $periode);
            $labels = $result['labels'];
            $data = $result['data'];
            $label = 'Jumlah Pengeluaran';
            break;

        default:
            // Jenis laporan tidak valid
            echo json_encode(array('error' => 'Jenis laporan tidak valid.'));
            exit;
    }

    // Kirim data laporan dalam format JSON
    echo json_encode(array(
        'labels' => $labels,
        'data' => $data,
        'label' => $label,
        'jenis' => $jenis_laporan // Tambahkan jenis laporan untuk penanganan di laporan.php
    ));
    exit;
}

// Fungsi untuk mendapatkan data stok barang
function get_data_stok_barang($conn)
{
    $sql = "SELECT id_barang, nama_barang, stok FROM barang";
    $result = mysqli_query($conn, $sql);
    $data_stok = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data_stok[] = $row;
        }
    }
    return $data_stok;
}

// Fungsi untuk mendapatkan data laporan pengadaan
function get_data_laporan_pengadaan($conn, $periode)
{
    $sql = "SELECT p.tanggal, s.nama_supplier, SUM(dp.jumlah * dp.harga_satuan) AS total_harga
            FROM pengadaan p
            JOIN detail_pengadaan dp ON p.id_pengadaan = dp.id_pengadaan
            JOIN supplier s ON p.id_supplier = s.id_supplier
            WHERE DATE_FORMAT(p.tanggal, '%Y-%m') = '$periode'
            GROUP BY p.tanggal, s.nama_supplier";
    $result = mysqli_query($conn, $sql);
    $labels = array();
    $data = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $labels[] = $row['tanggal']. ' - '. $row['nama_supplier'];
            $data[] = $row['total_harga'];
        }
    }
    return array('labels' => $labels, 'data' => $data);
}

// Fungsi untuk mendapatkan data laporan permintaan
function get_data_laporan_permintaan($conn, $periode)
{
    $sql = "SELECT tanggal, peminta, COUNT(*) AS jumlah_permintaan
            FROM permintaan
            WHERE DATE_FORMAT(tanggal, '%Y-%m') = '$periode'
            GROUP BY tanggal, peminta";
    $result = mysqli_query($conn, $sql);
    $labels = array();
    $data = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $labels[] = $row['tanggal']. ' - '. $row['peminta'];
            $data[] = $row['jumlah_permintaan'];
        }
    }
    return array('labels' => $labels, 'data' => $data);
}

// Fungsi untuk mendapatkan data laporan pengeluaran
function get_data_laporan_pengeluaran($conn, $periode)
{
    $sql = "SELECT pe.tanggal, pe.penerima, SUM(dp.jumlah) AS jumlah_pengeluaran
            FROM pengeluaran pe
            JOIN detail_pengeluaran dp ON pe.id_pengeluaran = dp.id_pengeluaran
            WHERE DATE_FORMAT(pe.tanggal, '%Y-%m') = '$periode'
            GROUP BY pe.tanggal, pe.penerima";
    $result = mysqli_query($conn, $sql);
    $labels = array();
    $data = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $labels[] = $row['tanggal']. ' - '. $row['penerima'];
            $data[] = $row['jumlah_pengeluaran'];
        }
    }
    return array('labels' => $labels, 'data' => $data);
}?>