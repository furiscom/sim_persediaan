<?php include 'sidebar.php';?>

<!DOCTYPE html>
<html>
<head>
  <title>Laporan - SIM Persediaan</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    /* CSS kustom */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
    }

  .container {
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      margin-left: 270px; /* Memberi jarak dari sidebar */
      padding: 20px;
    }

    /* CSS untuk sidebar */
  .sidebar {
      height: 100vh;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #333;
      padding-top: 20px;
      transition: all 0.3s ease-in-out;
    }

  .sidebar a {
      padding: 10px 20px;
      text-decoration: none;
      font-size: 16px;
      color: #fff;
      display: block;
      transition: all 0.3s ease-in-out;
    }

  .sidebar a:hover {
      background-color: #555;
      color: #ffc107;
    }

  .sidebar.fa {
      margin-right: 10px;
    }
  </style>
</head>
<body>

<div class="container mt-4">
  <h2 class="mb-4">Laporan</h2>

  <form id="formFilterLaporan">
    <div class="row mb-3">
      <div class="col-md-6">
        <label for="jenis_laporan" class="form-label">Jenis Laporan:</label>
        <select class="form-select" id="jenis_laporan" name="jenis_laporan">
          <option value="stok_barang">Stok Barang</option>
          <option value="pengadaan">Pengadaan Barang</option>
          <option value="permintaan">Permintaan Barang</option>
          <option value="pengeluaran">Pengeluaran Barang</option>
        </select>
      </div>
      <div class="col-md-3">
        <label for="periode" class="form-label">Periode:</label>
        <input type="month" class="form-control" id="periode" name="periode">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Tampilkan Laporan</button>
  </form>

  <div id="areaLaporan" class="mt-4">
    </div>
</div>

<script>
  $(document).ready(function() {
    // Fungsi untuk menampilkan laporan menggunakan AJAX
    function tampilkan_laporan(jenis, periode) {
      $.ajax({
        url: 'get_laporan.php', // Buat file get_laporan.php
        type: 'GET',
        data: { jenis: jenis, periode: periode },
        dataType: 'json',
        success: function(response) {
          // Bersihkan area laporan
          $('#areaLaporan').html('');

          // Tampilkan laporan dalam format tabel
          var tableHtml = '<table class="table table-striped">';
          if (response.jenis === 'stok_barang') {
            tableHtml += '<thead><tr><th>ID Barang</th><th>Nama Barang</th><th>Stok</th></tr></thead><tbody>';
            $.each(response.data, function(index, row) {
              tableHtml += '<tr><td>' + row.id_barang + '</td><td>' + row.nama_barang + '</td><td>' + row.stok + '</td></tr>';
            });
          } else if (response.jenis === 'pengadaan') {
            tableHtml += '<thead><tr><th>Tanggal - Supplier</th><th>Total Harga</th></tr></thead><tbody>';
            $.each(response.labels, function(index, label) {
              tableHtml += '<tr><td>' + label + '</td><td>' + response.data[index] + '</td></tr>';
            });
          } else if (response.jenis === 'permintaan') {
            tableHtml += '<thead><tr><th>Tanggal - Peminta</th><th>Jumlah Permintaan</th></tr></thead><tbody>';
            $.each(response.labels, function(index, label) {
              tableHtml += '<tr><td>' + label + '</td><td>' + response.data[index] + '</td></tr>';
            });
          } else if (response.jenis === 'pengeluaran') {
            tableHtml += '<thead><tr><th>Tanggal - Penerima</th><th>Jumlah Pengeluaran</th></tr></thead><tbody>';
            $.each(response.labels, function(index, label) {
              tableHtml += '<tr><td>' + label + '</td><td>' + response.data[index] + '</td></tr>';
            });
          }
          tableHtml += '</tbody></table>';
          $('#areaLaporan').html(tableHtml);
        }
      });
    }

    // Filter laporan saat form disubmit
    $('#formFilterLaporan').submit(function(event) {
      event.preventDefault();
      var jenis = $('#jenis_laporan').val();
      var periode = $('#periode').val();
      tampilkan_laporan(jenis, periode);
    });
  });
  
</script>

</body>
</html>