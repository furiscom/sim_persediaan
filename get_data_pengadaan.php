<?php
include 'includes/db.php';
include 'includes/functions.php';

// Ambil data pengadaan dari database
$data_pengadaan = get_data_pengadaan($conn);

// Tampilkan data pengadaan dalam tabel HTML
if (!empty($data_pengadaan)) {
  echo "<table class='table table-striped'>
          <thead>
            <tr>
  
            </tr>
          </thead>
          <tbody>";
  foreach ($data_pengadaan as $pengadaan) {
    // Ambil nama supplier
    $supplier = get_supplier_by_id($conn, $pengadaan['id_supplier']);

    echo "<tr>
            <td>".$pengadaan["id_pengadaan"]."</td>
            <td>".$pengadaan["tanggal"]."</td>
            <td>".$supplier["nama_supplier"]."</td>
            <td>".$pengadaan["total_harga"]."</td>
            <td>
              <a href='edit_pengadaan.php?id=".$pengadaan["id_pengadaan"]."' class='btn btn-sm btn-warning'><i class='fa fa-pencil'></i> Edit</a>
              <a href='hapus_pengadaan.php?id=".$pengadaan["id_pengadaan"]."' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> Hapus</a>
            </td>
          </tr>";
  }
  echo "</tbody></table>";
} else {
  echo "Tidak ada data pengadaan.";
}

// Fungsi untuk mengambil data pengadaan dari database
function get_data_pengadaan($conn) {
  $sql = "SELECT * FROM pengadaan";
  $result = mysqli_query($conn, $sql);
  $data_pengadaan = array();

  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $data_pengadaan[] = $row;
    }
  }
  return $data_pengadaan;
}

// Fungsi untuk mengambil data supplier berdasarkan ID
function get_supplier_by_id($conn, $id_supplier) {
  $sql = "SELECT * FROM supplier WHERE id_supplier = $id_supplier";
  $result = mysqli_query($conn, $sql);
  return mysqli_fetch_assoc($result);
}?>