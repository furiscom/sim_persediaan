<?php
include 'includes/db.php';
include 'includes/functions.php';

// Ambil data pengeluaran dari database
$data_pengeluaran = get_data_pengeluaran($conn);

// Tampilkan data pengeluaran dalam tabel HTML
if (!empty($data_pengeluaran)) {
  echo "<table class='table table-striped'>
          <thead>
            
          </thead>
          <tbody>";
  foreach ($data_pengeluaran as $pengeluaran) {
    echo "<tr>
            <td>".$pengeluaran["id_pengeluaran"]."</td>
            <td>".$pengeluaran["tanggal"]."</td>
            <td>".$pengeluaran["penerima"]."</td>
            <td>".$pengeluaran["keterangan"]."</td>
            <td>
              <a href='edit_pengeluaran.php?id=".$pengeluaran["id_pengeluaran"]."' class='btn btn-sm btn-warning'><i class='fa fa-pencil'></i> Edit</a>
              <a href='hapus_pengeluaran.php?id=".$pengeluaran["id_pengeluaran"]."' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> Hapus</a>
            </td>
          </tr>";
  }
  echo "</tbody></table>";
} else {
  echo "Tidak ada data pengeluaran.";
}

// Fungsi untuk mengambil data pengeluaran dari database
function get_data_pengeluaran($conn) {
    $sql = "SELECT * FROM pengeluaran";
    $result = mysqli_query($conn, $sql);
    $data_pengeluaran = array();
  
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
  $data_pengeluaran[] = $row; // Tambahkan setiap baris ke dalam array
}

    }
    return $data_pengeluaran;
  }?>