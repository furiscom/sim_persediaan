<?php
include 'includes/db.php';
include 'includes/functions.php';

if (isset($_GET['id'])) {
    $id_pengeluaran = validate_input($_GET['id']);

    // Query untuk mengambil data pengeluaran berdasarkan ID
    $sql = "SELECT * FROM pengeluaran WHERE id_pengeluaran = $id_pengeluaran";
    $result = mysqli_query($conn, $sql);
    $pengeluaran = mysqli_fetch_assoc($result);

    if (!$pengeluaran) {
        die("Pengeluaran tidak ditemukan.");
    }
} else {
    die("ID Pengeluaran tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $tanggal = validate_input($_POST['tanggal']);
    $penerima = validate_input($_POST['penerima']);
    $keterangan = validate_input($_POST['keterangan']);

    // Query untuk mengupdate data pengeluaran
    $sql = "UPDATE pengeluaran SET 
            tanggal = '$tanggal',
            penerima = '$penerima',
            keterangan = '$keterangan'
            WHERE id_pengeluaran = $id_pengeluaran";

    if (mysqli_query($conn, $sql)) {
        header("Location: pengeluaran.php");
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
  <title>Edit Data Pengeluaran - SIM Persediaan</title>
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
<h2 class="mb-4">Edit Data Pengeluaran</h2>

<form method="POST" action="">
  <div class="mb-3">
    <label for="tanggal" class="form-label">Tanggal:</label>
    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $pengeluaran['tanggal'];?>" required>
  </div>
  <div class="mb-3">
    <label for="penerima" class="form-label">Penerima:</label>
    <input type="text" class="form-control" id="penerima" name="penerima" value="<?php echo $pengeluaran['penerima'];?>" required>
  </div>
  <div class="mb-3">
    <label for="keterangan" class="form-label">Keterangan:</label>
    <textarea class="form-control" id="keterangan" name="keterangan"><?php echo $pengeluaran['keterangan'];?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>
</div>
</div>
</body>
</html>