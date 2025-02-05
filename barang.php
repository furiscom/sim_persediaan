<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manajemen Data Barang - SIM Persediaan</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
    }
  .container {
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }
  .table-responsive {
      overflow-x: auto;
    }
    @media (max-width: 768px) {
    .table th,.table td {
        font-size: 14px;
      }
    .btn {
        font-size: 12px;
        padding: 5px 10px;
      }
    }
  .sidebar {
      height: 100vh;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #333;
      padding-top: 20px;
      transition: all 0.3s ease-in-out; /* Efek transisi */
    }

.sidebar a {
      padding: 10px 20px;
      text-decoration: none;
      font-size: 16px;
      color: #fff;
      display: block;
      transition: all 0.3s ease-in-out; /* Efek transisi */
    }

.sidebar a:hover {
      background-color: #555;
      color: #ffc107; /* Warna kuning saat hover */
    }

.sidebar.fa {
      margin-right: 10px; /* Jarak antara ikon dan teks */
    }

.content {
      margin-left: 250px;
      padding: 20px;
    }

    /* Efek hover untuk elemen di content */
.content.card:hover {
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      transform: translateY(-5px);
    }
  </style>
</head>
<body>
<?php include 'sidebar.php';?>  
<div class="content">
<div class="container mt-4">

  <h2 class="mb-4 text-center">Manajemen Data Barang</h2>

  <div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Cari barang..." id="searchInput">
    <button class="btn btn-outline-secondary" type="button" id="searchButton">
      <i class="fa fa-search"></i>
    </button>
  </div>

  <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahBarang">
    <i class="fa fa-plus"></i> Tambah Barang Baru
  </a>

  <a href="#" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalImportBarang">
    <i class="fa fa-file-excel-o"></i> Import dari Excel
  </a>

  <div class="table-responsive">
    <table class="table table-striped text-center">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama Barang</th>
          <th>Spesifikasi</th>
          <th>Satuan</th>
          <th>Stok</th>
          <th>Harga</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody id="tabelBarang"></tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Barang Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formTambahBarang">
          <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang:</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
          </div>
          <div class="mb-3">
            <label for="spesifikasi" class="form-label">Spesifikasi:</label>
            <textarea class="form-control" id="spesifikasi" name="spesifikasi"></textarea>
          </div>
          <div class="mb-3">
            <label for="satuan" class="form-label">Satuan:</label>
            <input type="text" class="form-control" id="satuan" name="satuan" required>
          </div>
          <div class="mb-3">
            <label for="stok" class="form-label">Stok:</label>
            <input type="number" class="form-control" id="stok" name="stok" required>
          </div>
          <div class="mb-3">
            <label for="harga_satuan" class="form-label">Harga Satuan:</label>
            <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Tambah Barang</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalImportBarang" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Import Barang dari Excel</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formImportBarang" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="file_excel" class="form-label">Pilih File Excel:</label>
            <input type="file" class="form-control" id="file_excel" name="file_excel" accept=".xls,.xlsx" required>
          </div>
          <button type="submit" class="btn btn-success w-100">Import</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<script>
  $(document).ready(function() {
    function load_data_barang() {
      $.ajax({
        url: 'get_data_barang.php',
        type: 'GET',
        dataType: 'html',
        success: function(response) {
          $('#tabelBarang').html(response);
        }
      });
    }

    load_data_barang();

    $('#formTambahBarang').submit(function(event) {
      event.preventDefault();
      $.ajax({
        url: 'tambah_barang.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
          alert(response);
          $('#modalTambahBarang').modal('hide');
          load_data_barang();
        }
      });
    });

    // Tambahkan event handler untuk formImportBarang
    $('#formImportBarang').submit(function(event) {
  event.preventDefault();

  var formData = new FormData(this);

  $.ajax({
    url: 'import_barang.php', // Buat file import_barang.php untuk menangani import
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function(response) {
      alert(response);
      $('#modalImportBarang').modal('hide');
      location.reload(); //
      load_data_barang(); // Muat ulang data barang setelah import
    },
    error: function(xhr, status, error) {
      alert("Terjadi kesalahan saat mengimport data: " + error);
    }
  });
});

$('#searchButton').click(function() {
  var keyword = $('#searchInput').val();

  $.ajax({
    url: 'get_data_barang.php',
    type: 'GET',
    data: { keyword: keyword }, // Kirim keyword ke server
    dataType: 'html',
    success: function(response) {
      $('#tabelBarang').html(response); // Update tabel barang
    }
  });
});
  });
</script>

</body>
</html>