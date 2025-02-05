<?php
include 'includes/db.php';
include 'includes/functions.php';

if (isset($_GET['id'])) {
    $id_pengadaan = validate_input($_GET['id']);

    // Query untuk mengambil data pengadaan berdasarkan ID
    $sql = "SELECT * FROM pengadaan WHERE id_pengadaan = $id_pengadaan";
    $result = mysqli_query($conn, $sql);
    $pengadaan = mysqli_fetch_assoc($result);

    if (!$pengadaan) {
        die("Pengadaan tidak ditemukan.");
    }

    // Query untuk mengambil data supplier
    $sql_supplier = "SELECT * FROM supplier";
    $result_supplier = mysqli_query($conn, $sql_supplier);
} else {
    die("ID Pengadaan tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $tanggal = validate_input($_POST['tanggal']);
    $supplier = validate_input($_POST['supplier']);
    $total_harga = validate_input($_POST['total_harga']);

    // Query untuk mengupdate data pengadaan
    $sql = "UPDATE pengadaan SET 
            tanggal = '$tanggal',
            id_supplier = '$supplier',
            total_harga = '$total_harga'
            WHERE id_pengadaan = $id_pengadaan";

    if (mysqli_query($conn, $sql)) {
        header("Location: pengadaan.php"); // Redirect kembali ke halaman pengadaan.php
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
  <title>Edit Data Pengadaan - SIM Persediaan</title>
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
<h2 class="mb-4">Edit Data Pengadaan</h2>

<form method="POST" action="">
  <div class="mb-3">
    <label for="tanggal" class="form-label">Tanggal:</label>
    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $pengadaan['tanggal'];?>" required>
  </div>
  <div class="mb-3">
    <label for="supplier" class="form-label">Supplier:</label>
    <select class="form-select" id="supplier" name="supplier" required>
        <?php
        while ($supplier = mysqli_fetch_assoc($result_supplier)) {
            $selected = ($supplier['id_supplier'] == $pengadaan['id_supplier'])? 'selected': '';
            echo "<option value=\"". $supplier['id_supplier']. "\" $selected>". $supplier['nama_supplier']. "</option>";
        }
      ?>
    </select>
  </div>
  <div class="mb-3">
    <label for="total_harga" class="form-label">Total Harga:</label>
    <input type="number" class="form-control" id="total_harga" name="total_harga" value="<?php echo $pengadaan['total_harga'];?>" required>
  </div>
  <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>
</div>
</div>
</body>
</html>