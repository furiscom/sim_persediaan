<?php
include 'includes/db.php';
include 'includes/functions.php';

if (isset($_GET['id'])) {
    $id_permintaan = validate_input($_GET['id']);

    // Query untuk mengambil data permintaan berdasarkan ID
    $sql = "SELECT * FROM permintaan WHERE id_permintaan = $id_permintaan";
    $result = mysqli_query($conn, $sql);
    $permintaan = mysqli_fetch_assoc($result);

    if (!$permintaan) {
        die("Permintaan tidak ditemukan.");
    }
} else {
    die("ID Permintaan tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $tanggal = validate_input($_POST['tanggal']);
    $peminta = validate_input($_POST['peminta']);
    $status = validate_input($_POST['status']);

    // Query untuk mengupdate data permintaan
    $sql = "UPDATE permintaan SET 
            tanggal = '$tanggal',
            peminta = '$peminta',
            status = '$status'
            WHERE id_permintaan = $id_permintaan";

    if (mysqli_query($conn, $sql)) {
        header("Location: permintaan.php");
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
  <title>Edit Data Permintaan - SIM Persediaan</title>
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
<h2 class="mb-4">Edit Data Permintaan</h2>

<form method="POST" action="">
  <div class="mb-3">
    <label for="tanggal" class="form-label">Tanggal:</label>
    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $permintaan['tanggal'];?>" required>
  </div>
  <div class="mb-3">
    <label for="peminta" class="form-label">Peminta:</label>
    <input type="text" class="form-control" id="peminta" name="peminta" value="<?php echo $permintaan['peminta'];?>" required>
  </div>
  <div class="mb-3">
    <label for="status" class="form-label">Status:</label>
    <select class="form-select" id="status" name="status" required>
      <option value="Pending" <?php if ($permintaan['status'] == 'Pending') echo 'selected';?>>Pending</option>
      <option value="Disetujui" <?php if ($permintaan['status'] == 'Disetujui') echo 'selected';?>>Disetujui</option>
      <option value="Ditolak" <?php if ($permintaan['status'] == 'Ditolak') echo 'selected';?>>Ditolak</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>
</div>
</div>
</body>
</html>