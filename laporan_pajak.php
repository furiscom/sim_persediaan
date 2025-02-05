<?php include 'sidebar.php';?>

<!DOCTYPE html>
<html>
<head>
  <title>Laporan Pajak - SIM Persediaan</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
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
  <h2 class="mb-4">Laporan Pajak</h2>

  <form id="formFilterPajak">
    <div class="row mb-3">
      <div class="col-md-3">
        <label for="periode" class="form-label">Periode:</label>
        <input type="month" class="form-control" id="periode" name="periode">
      </div>
      <div class="col-md-3">
        <label for="ppn" class="form-label">PPN (%):</label>
        <input type="number" class="form-control" id="ppn" name="ppn" value="11">
      </div>
      <div class="col-md-3">
        <label for="pph" class="form-label">PPh (%):</label>
        <input type="number" class="form-control" id="pph" name="pph" value="0.5">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Tampilkan Laporan</button>
  </form>

  <div id="areaLaporanPajak" class="mt-4">
    </div>
</div>

<script>
  $(document).ready(function() {
    // Fungsi untuk menampilkan laporan pajak menggunakan AJAX
    function tampilkan_laporan_pajak(periode) {
      var ppn = $('#ppn').val();
      var pph = $('#pph').val();
      $.ajax({
        url: 'get_laporan_pajak.php',
        type: 'GET',
        data: { periode: periode, ppn: ppn, pph: pph }, // Sertakan ppn dan pph
        dataType: 'json',
        success: function(response) {
          // Bersihkan area laporan
          $('#areaLaporanPajak').html('');

          // Tampilkan laporan dalam format tabel
          var tableHtml = '<table class="table table-striped">';
          tableHtml += '<thead><tr><th>Jenis Transaksi</th><th>Total PPN</th><th>Total PPh</th></tr></thead><tbody>';
        //   tableHtml += '<tr><td>Pengadaan</td><td>' + response.pengadaan.total_ppn + '</td><td>' + response.pengadaan.total_pph + '</td></tr>';
          tableHtml += '<tr><td>Pengeluaran</td><td>' + response.pengeluaran.total_ppn + '</td><td>' + response.pengeluaran.total_pph + '</td></tr>';
        //   tableHtml += '<tr><td>Permintaan</td><td>' + response.permintaan.total_ppn + '</td><td>' + response.permintaan.total_pph + '</td></tr>';
          tableHtml += '</tbody></table>';
          $('#areaLaporanPajak').html(tableHtml);
        }
      });
    }

    // Filter laporan saat form disubmit
    $('#formFilterPajak').submit(function(event) {
      event.preventDefault();
      var periode = $('#periode').val();
      tampilkan_laporan_pajak(periode);
    });
  });
</script>

</body>
</html>