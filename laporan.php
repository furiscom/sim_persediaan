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
      <div class="col-md-6">
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

          // Tampilkan laporan sesuai jenis
          if (jenis == 'stok_barang') {
            // Tampilkan tabel stok barang
            var table = '<table class="table table-striped">' +
                        '<thead><tr><th>ID Barang</th><th>Nama Barang</th><th>Stok</th></tr></thead>' +
                        '<tbody>';
            $.each(response.data, function(index, barang) {
              table += '<tr><td>' + barang.id_barang + '</td><td>' + barang.nama_barang + '</td><td>' + barang.stok + '</td></tr>';
            });
            table += '</tbody></table>';
            $('#areaLaporan').html(table);
          } else if (jenis == 'pengadaan' || jenis == 'permintaan' || jenis == 'pengeluaran') {
            // Tampilkan grafik untuk pengadaan, permintaan, dan pengeluaran
            var canvas = $('<canvas id="chartLaporan"></canvas>');
            $('#areaLaporan').html(canvas);

            var ctx = document.getElementById('chartLaporan').getContext('2d');
            new Chart(ctx, {
              type: 'bar',
              data: {
                labels: response.labels,
                datasets: [{
                  label: response.label,
                  data: response.data,
                  backgroundColor: 'rgba(54, 162, 235, 0.2)',
                  borderColor: 'rgba(54, 162, 235, 1)',
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
          }
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