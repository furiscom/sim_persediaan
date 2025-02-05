<?php
include 'includes/db.php';
include 'includes/functions.php';

if (isset($_GET['id'])) {
    $id_barang = validate_input($_GET['id']);

    // Query untuk mengambil data barang berdasarkan ID
    $sql = "SELECT * FROM barang WHERE id_barang = $id_barang";
    $result = mysqli_query($conn, $sql);
    $barang = mysqli_fetch_assoc($result);

    if (!$barang) {
        die("Barang tidak ditemukan.");
    }
} else {
    die("ID Barang tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama_barang = validate_input($_POST['nama_barang']);
    $spesifikasi = validate_input($_POST['spesifikasi']);
    $satuan = validate_input($_POST['satuan']);
    $stok = validate_input($_POST['stok']);
    $harga_satuan = validate_input($_POST['harga_satuan']);
    $id_jenis = validate_input($_POST['jenis_barang']); // Ambil id_jenis dari dropdown

    // Query untuk mengupdate data barang
    $sql = "UPDATE barang SET 
            nama_barang = '$nama_barang',
            spesifikasi = '$spesifikasi',
            satuan = '$satuan',
            stok = '$stok',
            harga_satuan = '$harga_satuan',
            id_jenis = '$id_jenis'
            WHERE id_barang = $id_barang";

    if (mysqli_query($conn, $sql)) {
        header("Location: barang.php"); // Redirect kembali ke halaman barang.php
        exit;
    } else {
        tampilkan_error("Error: ". $sql. "<br>". mysqli_error($conn));
    }
}?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Data Barang - SIM Persediaan</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
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
  </style>
</head>
<body>
<?php include 'sidebar.php';?>  
<div class="content">
<div class="container mt-4">
<h2 class="mb-4">Edit Data Barang</h2>

<form method="POST" action="">
  <div class="mb-3">
    <label for="nama_barang" class="form-label">Nama Barang:</label>
    <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo $barang['nama_barang'];?>" required>
  </div>
  <div class="mb-3">
    <label for="spesifikasi" class="form-label">Spesifikasi:</label>
    <textarea class="form-control" id="spesifikasi" name="spesifikasi"><?php echo $barang['spesifikasi'];?></textarea>
  </div>
  <div class="mb-3">
    <label for="satuan" class="form-label">Satuan:</label>
    <input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo $barang['satuan'];?>" required>
  </div>
  <div class="mb-3">
    <label for="stok" class="form-label">Stok:</label>
    <input type="number" class="form-control" id="stok" name="stok" value="<?php echo $barang['stok'];?>" required>
  </div>
  <div class="mb-3">
    <label for="harga_satuan" class="form-label">Harga Satuan:</label>
    <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" value="<?php echo $barang['harga_satuan'];?>" required>
  </div>
  <div class="mb-3">
    <label for="jenis_barang" class="form-label">Jenis Barang:</label>
    <select class="form-select" id="jenis_barang" name="jenis_barang" required>
      <?php
      $sql_jenis = "SELECT * FROM jenis_barang";
      $result_jenis = mysqli_query($conn, $sql_jenis);
      while ($row_jenis = mysqli_fetch_assoc($result_jenis)) {
        $selected = ($row_jenis['id_jenis'] == $barang['id_jenis'])? 'selected': '';
        echo "<option value=\"". $row_jenis['id_jenis']. "\" $selected>". $row_jenis['nama_jenis']. "</option>";
      }
    ?>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>
</div>
</div>
</body>
</html>