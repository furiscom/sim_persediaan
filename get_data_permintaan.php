<?php
include 'includes/db.php';
include 'includes/functions.php';

// Ambil data permintaan dari database
$data_permintaan = get_data_permintaan($conn);

// Tampilkan data permintaan dalam tabel HTML
if (!empty($data_permintaan)) {
  echo "<table class='table table-striped'>
          <thead>
            <tr>
              <th>ID Permintaan</th>
              <th>Tanggal</th>
              <th>Peminta</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>";
  foreach ($data_permintaan as $permintaan) {
    echo "<tr>
            <td>".$permintaan["id_permintaan"]."</td>
            <td>".$permintaan["tanggal"]."</td>
            <td>".$permintaan["peminta"]."</td>
            <td>".$permintaan["status"]."</td>
            <td>
              <a href='edit_permintaan.php?id=".$permintaan["id_permintaan"]."' class='btn btn-sm btn-warning'><i class='fa fa-pencil'></i> Edit</a>
              <a href='hapus_permintaan.php?id=".$permintaan["id_permintaan"]."' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> Hapus</a>
            </td>
          </tr>";
  }
  echo "</tbody></table>";
} else {
  echo "Tidak ada data permintaan.";
}

// Fungsi untuk mengambil data permintaan dari database
function get_data_permintaan($conn) {
    $sql = "SELECT * FROM permintaan";
    $result = mysqli_query($conn, $sql);
    $data_permintaan = array();
  
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        $data_permintaan[] = $row; // Menambahkan setiap baris ke dalam array
      }
    }
    return $data_permintaan;
  }
  ?>