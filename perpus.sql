/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 8.0.30 : Database - perpustakaan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`perpustakaan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `perpustakaan`;

/*Table structure for table `anggota` */

DROP TABLE IF EXISTS `anggota`;

CREATE TABLE `anggota` (
  `anggota_id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`anggota_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `anggota` */

insert  into `anggota`(`anggota_id`,`nama`,`alamat`,`email`,`telepon`) values 
(2,'Rehan','Tahunan','rehan123@gmail.com','087266637638'),
(3,'Gibran','Welahan Jepara','gibransembada@gmail.com','085156413947'),
(4,'Rahil','Kalinyamat','apaja@gmail.com','087266637638');

/*Table structure for table `buku` */

DROP TABLE IF EXISTS `buku`;

CREATE TABLE `buku` (
  `buku_id` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun_terbit` int NOT NULL,
  `sinopsis` text NOT NULL,
  `kategori_id` int NOT NULL,
  PRIMARY KEY (`buku_id`),
  KEY `kategori_id` (`kategori_id`),
  CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `buku` */

insert  into `buku`(`buku_id`,`judul`,`pengarang`,`penerbit`,`tahun_terbit`,`sinopsis`,`kategori_id`) values 
(1,'Dilan 1991','Pidi Baiq','Setia Membaca',2016,'Kisah percintaan anak remaja',2),
(3,'172 Days','Sri Ahmad','Setia Membaca',2018,'Percintaan islami',2),
(4,'Teknlogi Merubah Dunia','Nadiem','Teknik ITB',2017,'Buku yang menceritakan betapa berpengaruhnya teknologi untuk dunia ini.',1);

/*Table structure for table `denda` */

DROP TABLE IF EXISTS `denda`;

CREATE TABLE `denda` (
  `denda_id` int NOT NULL AUTO_INCREMENT,
  `pinjam_id` int NOT NULL,
  `jumlah_denda` decimal(10,2) NOT NULL,
  PRIMARY KEY (`denda_id`),
  KEY `pinjam_id` (`pinjam_id`),
  CONSTRAINT `denda_ibfk_1` FOREIGN KEY (`pinjam_id`) REFERENCES `peminjaman` (`pinjam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `denda` */

/*Table structure for table `katalog` */

DROP TABLE IF EXISTS `katalog`;

CREATE TABLE `katalog` (
  `katalog_id` int NOT NULL AUTO_INCREMENT,
  `buku_id` int NOT NULL,
  `sinopsis` text NOT NULL,
  `kategori_id` int NOT NULL,
  PRIMARY KEY (`katalog_id`),
  KEY `buku_id` (`buku_id`),
  KEY `kategori_id` (`kategori_id`),
  CONSTRAINT `katalog_ibfk_1` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`buku_id`),
  CONSTRAINT `katalog_ibfk_2` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `katalog` */

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `kategori_id` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `kategori` */

insert  into `kategori`(`kategori_id`,`nama_kategori`) values 
(1,'Komputer'),
(2,'Novel'),
(4,'Buku Anak-anak');

/*Table structure for table `lokasi_buku` */

DROP TABLE IF EXISTS `lokasi_buku`;

CREATE TABLE `lokasi_buku` (
  `lokasi_id` int NOT NULL AUTO_INCREMENT,
  `buku_id` int NOT NULL,
  `nama_lokasi` varchar(100) NOT NULL,
  PRIMARY KEY (`lokasi_id`),
  KEY `buku_id` (`buku_id`),
  CONSTRAINT `lokasi_buku_ibfk_1` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`buku_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `lokasi_buku` */

/*Table structure for table `peminjaman` */

DROP TABLE IF EXISTS `peminjaman`;

CREATE TABLE `peminjaman` (
  `pinjam_id` int NOT NULL AUTO_INCREMENT,
  `buku_id` int NOT NULL,
  `anggota_id` int NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` enum('dipinjam','kembali') NOT NULL,
  PRIMARY KEY (`pinjam_id`),
  KEY `buku_id` (`buku_id`),
  KEY `anggota_id` (`anggota_id`),
  CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`buku_id`),
  CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`anggota_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `peminjaman` */

insert  into `peminjaman`(`pinjam_id`,`buku_id`,`anggota_id`,`tanggal_peminjaman`,`tanggal_kembali`,`status`) values 
(1,1,2,'2023-12-19','2023-12-26','dipinjam');

/*Table structure for table `pengembalian` */

DROP TABLE IF EXISTS `pengembalian`;

CREATE TABLE `pengembalian` (
  `pengembalian_id` int NOT NULL AUTO_INCREMENT,
  `pinjam_id` int NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `status_pengembalian` enum('dikembalikan','terlambat') NOT NULL,
  PRIMARY KEY (`pengembalian_id`),
  KEY `pinjam_id` (`pinjam_id`),
  CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`pinjam_id`) REFERENCES `peminjaman` (`pinjam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `pengembalian` */

/*Table structure for table `staff` */

DROP TABLE IF EXISTS `staff`;

CREATE TABLE `staff` (
  `staff_id` char(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `staff` */

insert  into `staff`(`staff_id`,`nama`,`jabatan`,`email`,`telepon`) values 
('STF1','Rahil Danial','Ketua ','rahildanial@gmail.com','086576432541'),
('STF2','Arinal Haq','Wakil Ketua','arinalhaq@gmail.com','089798796754');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`) values 
(1,'admin','21232f297a57a5a743894a0e4a801fc3');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
