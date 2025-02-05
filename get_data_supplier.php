<?php
include "includes/db.php"; // Ganti dengan nama file koneksi Anda

$sql = "SELECT id_supplier, nama_supplier FROM supplier";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>