<!DOCTYPE html>
<html>
<head>
  <title>Permintaan Barang - SIM Persediaan</title>
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
    }
  </style>
</head>
<body>
<?php include 'sidebar.php';?>
<div class="container mt-4">
  <h2 class="mb-4">Permintaan Barang</h2>

  <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahPermintaan">
    <i class="fa fa-plus"></i> Tambah Permintaan
  </button>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID Permintaan</th>
        <th>Tanggal</th>
        <th>Peminta</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody id="tabelPermintaan">
      </tbody>
  </table>
</div>

<div class="modal fade" id="modalTambahPermintaan" tabindex="-1" aria-labelledby="modalTambahPermintaanLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahPermintaanLabel">Tambah Permintaan Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formTambahPermintaan">
          <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal:</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
          </div>
          <div class="mb-3">
            <label for="peminta" class="form-label">Peminta:</label>
            <input type="text" class="form-control" id="peminta" name="peminta" required>
          </div>
          <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select class="form-select" id="status" name="status" required>
              <option value="Pending">Pending</option>
              <option value="Disetujui">Disetujui</option>
              <option value="Ditolak">Ditolak</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Tambah Permintaan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    // Fungsi untuk memuat data permintaan menggunakan AJAX
    function load_data_permintaan() {
      $.ajax({
        url: 'get_data_permintaan.php', // Buat file get_data_permintaan.php
        type: 'GET',
        dataType: 'html',
        success: function(response) {
          $('#tabelPermintaan').html(response);
        }
      });
    }

    // Muat data permintaan saat halaman dimuat
    load_data_permintaan();

    // Tambah permintaan menggunakan AJAX
    $('#formTambahPermintaan').submit(function(event) {
      event.preventDefault();
      $.ajax({
        url: 'tambah_permintaan.php', // Buat file tambah_permintaan.php
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
          alert(response);
          $('#modalTambahPermintaan').modal('hide');
          load_data_permintaan();
        }
      });
    });
  });
</script>

</body>
</html>