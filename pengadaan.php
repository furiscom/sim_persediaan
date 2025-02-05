<?php include 'sidebar.php';?>

<!DOCTYPE html>
<html>
<head>
  <title>Pengadaan Barang - SIM Persediaan</title>
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

<div class="content">
  <div class="container mt-4">
    <h2 class="mb-4">Pengadaan Barang</h2>

    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahPengadaan">
      <i class="fa fa-plus"></i> Tambah Pengadaan
    </button>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID Pengadaan</th>
          <th>Tanggal</th>
          <th>Supplier</th>
          <th>Total Harga</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody id="tabelPengadaan">
        </tbody>
    </table>
  </div>

  <div class="modal fade" id="modalTambahPengadaan" tabindex="-1" aria-labelledby="modalTambahPengadaanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahPengadaanLabel">Tambah Pengadaan Barang</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formTambahPengadaan">
            <div class="mb-3">
              <label for="tanggal" class="form-label">Tanggal:</label>
              <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="mb-3">
              <label for="supplier" class="form-label">Supplier:</label>
              <select class="form-select" id="supplier" name="supplier" required>
              </select>
            </div>
            <div class="mb-3">
              <label for="total_harga" class="form-label">Total Harga:</label>
              <input type="number" class="form-control" id="total_harga" name="total_harga" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Pengadaan</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<script>
  $(document).ready(function() {

    // Fungsi untuk memuat data pengadaan
    function load_data_pengadaan() {
      $.ajax({
        url: 'get_data_pengadaan.php',
        type: 'GET',
        dataType: 'html',
        success: function(response) {
          $('#tabelPengadaan').html(response);
        }
      });
    }

    load_data_pengadaan();

     // Fungsi untuk memuat data supplier
    function load_data_supplier() {
        $.ajax({
            url: 'get_data_supplier.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var options = '<option value="">Pilih Supplier</option>';
                $.each(data, function(index, item) {
                    options += '<option value="' + item.id_supplier + '">' + item.nama_supplier + '</option>';
                });
                $('#supplier').html(options);
            },
            error: function(xhr, status, error) {
                console.error("Error loading supplier data:", error);
                alert("Gagal memuat data supplier. Periksa koneksi atau file get_data_supplier.php.");
            }
        });
    }

    // Panggil fungsi untuk memuat data supplier saat modal ditampilkan
    $('#modalTambahPengadaan').on('shown.bs.modal', function (e) {
        load_data_supplier();
    });

    // Tambah pengadaan menggunakan AJAX
    $('#formTambahPengadaan').submit(function(event) {
      event.preventDefault();
      $.ajax({
        url: 'tambah_pengadaan.php', // Buat file tambah_pengadaan.php
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
          alert(response);
          $('#modalTambahPengadaan').modal('hide');
          location.reload();
        }
      });
    });
  });
</script>

</body>
</html>