<?php
include 'includes/db.php';
include 'includes/functions.php';

// Ambil data barang dari database
if (isset($_GET['keyword'])) {
  $keyword = validate_input($_GET['keyword']);
  $query = "SELECT b.*, jb.nama_jenis FROM barang b JOIN jenis_barang jb ON b.id_jenis = jb.id_jenis WHERE b.nama_barang LIKE '%$keyword%'"; // Filter berdasarkan keyword dan join dengan tabel jenis_barang
} else {
  $query = "SELECT b.*, jb.nama_jenis FROM barang b JOIN jenis_barang jb ON b.id_jenis = jb.id_jenis"; // Join dengan tabel jenis_barang
}

$result = mysqli_query($conn, $query);

if (!$result) {
  die("Query Error: ". mysqli_error($conn));
}

$data =[];
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}

// Tampilkan data barang dalam tabel HTML
if (!empty($data)) {
  echo "<table class='table table-striped'>
          <thead>
            <tr>

            </tr>
          </thead>
          <tbody>";
          $no=1;
  foreach ($data as $barang) {
    
    echo "<tr>
            <td>".$no."</td>
            <td>".$barang["nama_barang"]."</td>
            <td>".$barang["spesifikasi"]."</td>
            <td>".$barang["satuan"]."</td>
            <td>".$barang["stok"]."</td>
            <td>".$barang["harga_satuan"]."</td>
            <td>".$barang["nama_jenis"]."</td>
            <td>
              <a href='edit_barang.php?id=".$barang["id_barang"]."' class='btn btn-sm btn-warning'><i class='fa fa-pencil'></i> Edit</a>
              <a href='hapus_barang.php?id=".$barang["id_barang"]."' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> Hapus</a>
            </td>
          </tr>";
          $no++;
  }
  echo "</tbody></table>";
} else {
  echo "Tidak ada data barang.";
}?>