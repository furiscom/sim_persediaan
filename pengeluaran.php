<?php include 'sidebar.php';?>

<!DOCTYPE html>
<html>
<head>
  <title>Pengeluaran Barang - SIM Persediaan</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
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
  <h2 class="mb-4">Pengeluaran Barang</h2>

  <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahPengeluaran">
    <i class="fa fa-plus"></i> Tambah Pengeluaran
  </button>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID Pengeluaran</th>
        <th>Tanggal</th>
        <th>Penerima</th>
        <th>Keterangan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody id="tabelPengeluaran">
      </tbody>
  </table>
</div>

<div class="modal fade" id="modalTambahPengeluaran" tabindex="-1" aria-labelledby="modalTambahPengeluaranLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahPengeluaranLabel">Tambah Pengeluaran Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formTambahPengeluaran">
          <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal:</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
          </div>
          <div class="mb-3">
            <label for="penerima" class="form-label">Penerima:</label>
            <input type="text" class="form-control" id="penerima" name="penerima" required>
          </div>
          <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan:</label>
            <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Tambah Pengeluaran</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    // Fungsi untuk memuat data pengeluaran menggunakan AJAX
    function load_data_pengeluaran() {
      $.ajax({
        url: 'get_data_pengeluaran.php', // Buat file get_data_pengeluaran.php
        type: 'GET',
        dataType: 'html',
        success: function(response) {
          $('#tabelPengeluaran').html(response);
          
        }
      });
    }

    // Muat data pengeluaran saat halaman dimuat
    load_data_pengeluaran();

    // Tambah pengeluaran menggunakan AJAX
    $('#formTambahPengeluaran').submit(function(event) {
      event.preventDefault();
      $.ajax({
        url: 'tambah_pengeluaran.php', // Buat file tambah_pengeluaran.php
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
          alert(response);
          $('#modalTambahPengeluaran').modal('hide');
          location.reload(); //
          load_data_pengeluaran();
        }

      });
    });
  });
</script>

</body>
</html>