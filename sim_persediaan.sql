-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;




-- Dumping structure for table sim_persediaan.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` int NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) NOT NULL,
  `spesifikasi` text,
  `satuan` varchar(50) NOT NULL,
  `stok` int NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL,
  `id_jenis` int DEFAULT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `FK_barang_jenis_barang` (`id_jenis`),
  CONSTRAINT `FK_barang_jenis_barang` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_barang` (`id_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sim_persediaan.barang: ~5 rows (approximately)
INSERT INTO `barang` (`id_barang`, `nama_barang`, `spesifikasi`, `satuan`, `stok`, `harga_satuan`, `id_jenis`) VALUES
	(1, 'Kertas HVS A4', 'Kertas HVS 80 gram', 'Rim', 100, 50000.00, NULL),
	(2, 'Pulpen', 'Pulpen biru', 'Pcs', 50, 5000.00, NULL),
	(3, 'Pensil', 'Pensil 2B', 'Pcs', 100, 2000.00, NULL),
	(4, 'Penghapus', 'Penghapus karet', 'Pcs', 50, 1000.00, NULL),
	(5, 'Penggaris', 'Penggaris 30 cm', 'Pcs', 20, 5000.00, NULL),
	(6, 'Kertas HVS A4', '80 gram', 'Rim', 100, 50000.00, 1),
	(7, 'Pulpen', 'Biru', 'Pcs', 50, 5000.00, 1),
	(8, 'Pensil', '2B', 'Pcs', 100, 2000.00, 1),
	(9, 'Penghapus', 'Karet', 'Pcs', 50, 1000.00, 1),
	(10, 'Penggaris', '30 cm', 'Pcs', 20, 5000.00, 1),
	(11, 'CPU Intel Core i7', '3.6 GHz', 'Pcs', 10, 5000000.00, 2),
	(12, 'Monitor 24 inch', '1920x1080', 'Pcs', 20, 2000000.00, 3),
	(13, 'Meja Kantor', 'Kayu Jati', 'Pcs', 5, 1500000.00, 4),
	(16, 'Kertas HVS A4', '80 gram', 'Rim', 100, 50000.00, 1),
	(17, 'Pulpen', 'Biru', 'Pcs', 50, 5000.00, 1),
	(18, 'Pensil', '2B', 'Pcs', 100, 2000.00, 1),
	(19, 'Penghapus', 'Karet', 'Pcs', 50, 1000.00, 1),
	(20, 'Penggaris', '30 cm', 'Pcs', 20, 5000.00, 1),
	(21, 'CPU Intel Core i7', '3.6 GHz', 'Pcs', 10, 5000000.00, 2),
	(22, 'Monitor 24 inch', '1920x1080', 'Pcs', 20, 2000000.00, 3),
	(23, 'Meja Kantor', 'Kayu Jati', 'Pcs', 5, 1500000.00, 4),
	(24, 'Kursi Kantor', '', 'Pcs', 5, 500000.00, 4),
	(25, 'Toner Printer', '', 'Pcs', 10, 500000.00, 5);

-- Dumping structure for table sim_persediaan.detail_pengadaan
CREATE TABLE IF NOT EXISTS `detail_pengadaan` (
  `id_detail_pengadaan` int NOT NULL AUTO_INCREMENT,
  `id_pengadaan` int NOT NULL,
  `id_barang` int NOT NULL,
  `jumlah` int NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_detail_pengadaan`),
  KEY `id_pengadaan` (`id_pengadaan`),
  KEY `id_barang` (`id_barang`),
  CONSTRAINT `detail_pengadaan_ibfk_1` FOREIGN KEY (`id_pengadaan`) REFERENCES `pengadaan` (`id_pengadaan`),
  CONSTRAINT `detail_pengadaan_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sim_persediaan.detail_pengadaan: ~5 rows (approximately)

-- Dumping structure for table sim_persediaan.detail_pengeluaran
CREATE TABLE IF NOT EXISTS `detail_pengeluaran` (
  `id_detail_pengeluaran` int NOT NULL AUTO_INCREMENT,
  `id_pengeluaran` int NOT NULL,
  `id_barang` int NOT NULL,
  `jumlah` int NOT NULL,
  PRIMARY KEY (`id_detail_pengeluaran`),
  KEY `id_pengeluaran` (`id_pengeluaran`),
  KEY `id_barang` (`id_barang`),
  CONSTRAINT `detail_pengeluaran_ibfk_1` FOREIGN KEY (`id_pengeluaran`) REFERENCES `pengeluaran` (`id_pengeluaran`),
  CONSTRAINT `detail_pengeluaran_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sim_persediaan.detail_pengeluaran: ~4 rows (approximately)

-- Dumping structure for table sim_persediaan.detail_permintaan
CREATE TABLE IF NOT EXISTS `detail_permintaan` (
  `id_detail_permintaan` int NOT NULL AUTO_INCREMENT,
  `id_permintaan` int NOT NULL,
  `id_barang` int NOT NULL,
  `jumlah` int NOT NULL,
  PRIMARY KEY (`id_detail_permintaan`),
  KEY `id_permintaan` (`id_permintaan`),
  KEY `id_barang` (`id_barang`),
  CONSTRAINT `detail_permintaan_ibfk_1` FOREIGN KEY (`id_permintaan`) REFERENCES `permintaan` (`id_permintaan`),
  CONSTRAINT `detail_permintaan_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sim_persediaan.detail_permintaan: ~4 rows (approximately)

-- Dumping structure for table sim_persediaan.jenis_barang
CREATE TABLE IF NOT EXISTS `jenis_barang` (
  `id_jenis` int NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(255) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sim_persediaan.jenis_barang: ~5 rows (approximately)
INSERT INTO `jenis_barang` (`id_jenis`, `nama_jenis`) VALUES
	(1, 'ATK'),
	(2, 'CPU'),
	(3, 'Monitor'),
	(4, 'Peralatan Kantor'),
	(5, 'Bahan Habis Pakai');

-- Dumping structure for table sim_persediaan.pengadaan
CREATE TABLE IF NOT EXISTS `pengadaan` (
  `id_pengadaan` int NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `id_supplier` int NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `ppn` decimal(10,2) DEFAULT NULL,
  `pph` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_pengadaan`),
  KEY `id_supplier` (`id_supplier`),
  CONSTRAINT `pengadaan_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sim_persediaan.pengadaan: ~3 rows (approximately)
INSERT INTO `pengadaan` (`id_pengadaan`, `tanggal`, `id_supplier`, `total_harga`, `ppn`, `pph`) VALUES
	(1, '2023-01-15', 1, 1000000.00, 100000.00, 5000.00),
	(2, '2023-02-20', 2, 500000.00, 50000.00, 2500.00),
	(3, '2023-03-10', 3, 2000000.00, 200000.00, 10000.00);

-- Dumping structure for table sim_persediaan.pengeluaran
CREATE TABLE IF NOT EXISTS `pengeluaran` (
  `id_pengeluaran` int NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `penerima` varchar(255) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_pengeluaran`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sim_persediaan.pengeluaran: ~3 rows (approximately)
INSERT INTO `pengeluaran` (`id_pengeluaran`, `tanggal`, `penerima`, `keterangan`) VALUES
	(1, '2023-05-10', 'Bagian Keuangan', 'Pengeluaran ATK'),
	(2, '2023-05-15', 'Bagian Personalia', 'Pengeluaran peralatan kantor'),
	(3, '2023-05-20', 'Bagian Umum', 'Pengeluaran bahan kebersihan'),
	(4, '2025-01-01', '1', '12'),
	(5, '2025-01-01', '2', '2'),
	(6, '2025-01-01', '2', '23');

-- Dumping structure for table sim_persediaan.permintaan
CREATE TABLE IF NOT EXISTS `permintaan` (
  `id_permintaan` int NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `peminta` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `ppn` decimal(10,2) DEFAULT NULL,
  `pph` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_permintaan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sim_persediaan.permintaan: ~3 rows (approximately)
INSERT INTO `permintaan` (`id_permintaan`, `tanggal`, `peminta`, `status`, `ppn`, `pph`) VALUES
	(1, '2023-04-05', 'Bagian Keuangan', 'Disetujui', NULL, NULL),
	(2, '2023-04-12', 'Bagian Personalia', 'Pending', NULL, NULL),
	(3, '2023-04-20', 'Bagian Umum', 'Ditolak', NULL, NULL),
	(4, '2025-02-02', '1', 'Pending', NULL, NULL);

-- Dumping structure for table sim_persediaan.supplier
CREATE TABLE IF NOT EXISTS `supplier` (
  `id_supplier` int NOT NULL AUTO_INCREMENT,
  `nama_supplier` varchar(255) NOT NULL,
  `alamat` text,
  `telepon` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sim_persediaan.supplier: ~3 rows (approximately)
INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat`, `telepon`) VALUES
	(1, 'PT. Sumber Rejeki', 'Jl. Raya Kenangan No. 12', '081234567890'),
	(2, 'Toko Makmur Jaya', 'Jl. Pahlawan No. 45', '085678901234'),
	(3, 'CV. Berkah Abadi', 'Jl. Merdeka No. 99', '089012345678');

-- Dumping structure for table sim_persediaan.users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sim_persediaan.users: ~2 rows (approximately)
INSERT INTO `users` (`id_user`, `username`, `password`, `nama_lengkap`) VALUES
	(1, 'admin', 'admin123', 'Administrator'),
	(2, 'user1', 'password123', 'Pengguna 1');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
