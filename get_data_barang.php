<?php
include 'includes/db.php';
include 'includes/functions.php';

// Ambil data barang dari database
$data_barang = get_data_barang($conn);

// Tampilkan data barang dalam tabel HTML
if (!empty($data_barang)) {
  echo "<table class='table table-striped'>
          <thead>
            
          </thead>
          <tbody>";
  foreach ($data_barang as $barang) {
    echo "<tr>
            <td>".$barang["id_barang"]."</td>
            <td>".$barang["nama_barang"]."</td>
            <td>".$barang["spesifikasi"]."</td>
            <td>".$barang["satuan"]."</td>
            <td>".$barang["stok"]."</td>
            <td>".$barang["harga_satuan"]."</td>
            <td>
              <a href='edit_barang.php?id=".$barang["id_barang"]."' class='btn btn-sm btn-warning'><i class='fa fa-pencil'></i> Edit</a>
              <a href='hapus_barang.php?id=".$barang["id_barang"]."' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> Hapus</a>
            </td>
          </tr>";
  }
  echo "</tbody></table>";
} else {
  echo "Tidak ada data barang.";
}?>