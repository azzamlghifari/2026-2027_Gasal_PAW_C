CREATE DATABASE IF NOT EXISTS db_penjualan
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_penjualan;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS pembayaran;
DROP TABLE IF EXISTS transaksi_detail;
DROP TABLE IF EXISTS transaksi;
DROP TABLE IF EXISTS barang;
DROP TABLE IF EXISTS supplier;
DROP TABLE IF EXISTS pelanggan;
DROP TABLE IF EXISTS user;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE pelanggan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  jenis_kelamin ENUM('L','P') NOT NULL,
  telp VARCHAR(20),
  alamat TEXT
) ENGINE=InnoDB;

CREATE TABLE supplier (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  telp VARCHAR(20),
  alamat TEXT
) ENGINE=InnoDB;

CREATE TABLE barang (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kode_barang VARCHAR(10) NOT NULL UNIQUE,
  nama_barang VARCHAR(100) NOT NULL,
  harga INT NOT NULL DEFAULT 0,
  stok INT NOT NULL DEFAULT 0,
  supplier_id INT NOT NULL,
  CONSTRAINT fk_barang_supplier FOREIGN KEY (supplier_id)
    REFERENCES supplier(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE `user` (
  id_user INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(30) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  nama VARCHAR(50) NOT NULL,
  alamat VARCHAR(150),
  hp VARCHAR(20),
  level TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

CREATE TABLE transaksi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  waktu_transaksi DATETIME NOT NULL,
  keterangan TEXT,
  total INT NOT NULL DEFAULT 0,
  pelanggan_id INT NOT NULL,
  CONSTRAINT fk_transaksi_pelanggan FOREIGN KEY (pelanggan_id)
    REFERENCES pelanggan(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE transaksi_detail (
  transaksi_id INT NOT NULL,
  barang_id INT NOT NULL,
  harga INT NOT NULL,
  qty INT NOT NULL,
  PRIMARY KEY (transaksi_id, barang_id),
  CONSTRAINT fk_detail_transaksi FOREIGN KEY (transaksi_id)
    REFERENCES transaksi(id) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_detail_barang FOREIGN KEY (barang_id)
    REFERENCES barang(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE pembayaran (
  id INT AUTO_INCREMENT PRIMARY KEY,
  waktu_bayar DATETIME NOT NULL,
  total INT NOT NULL,
  metode ENUM('TUNAI','TRANSFER','EDC') NOT NULL,
  transaksi_id INT NOT NULL,
  CONSTRAINT fk_pembayaran_transaksi FOREIGN KEY (transaksi_id)
    REFERENCES transaksi(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO pelanggan (nama, jenis_kelamin, telp, alamat) VALUES
('Andi Saputra','L','081234560001','Surabaya'),
('Budi Santoso','L','081234560002','Gresik'),
('Citra Lestari','P','081234560003','Sidoarjo'),
('Dewi Anggraini','P','081234560004','Lamongan'),
('Eko Prasetyo','L','081234560005','Surabaya'),
('Fitri Handayani','P','081234560006','Mojokerto'),
('Gilang Ramadhan','L','081234560007','Gresik'),
('Hana Putri','P','081234560008','Malang'),
('Indra Wijaya','L','081234560009','Sidoarjo'),
('Joko Susilo','L','081234560010','Surabaya');

INSERT INTO supplier (nama, telp, alamat) VALUES
('PT. Maju Bersama','08123456','Surabaya'),
('PT. Senang Sekali','081515563','Bangkalan'),
('PT. Segar Segar','0845454663','Surabaya'),
('CV. Sumber Makmur','081222333444','Gresik'),
('PT. Berkah Jaya','082133445566','Sidoarjo'),
('CV. Mitra Niaga','083144556677','Lamongan'),
('PT. Cipta Usaha','085255667788','Mojokerto'),
('CV. Karya Abadi','087766554433','Malang'),
('PT. Sukses Mandiri','081399887766','Surabaya'),
('CV. Indo Supply','082188776655','Gresik');

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001','Buku Tulis',5000,100,1),
('BRG002','Pulpen',3000,150,2),
('BRG003','Pensil',2500,120,3),
('BRG004','Penghapus',2000,80,4),
('BRG005','Penggaris',4000,70,5),
('BRG006','Spidol',7000,60,6),
('BRG007','Map Plastik',3500,90,7),
('BRG008','Kertas A4',45000,40,8),
('BRG009','Stabilo',8000,55,9),
('BRG010','Rautan',5000,65,10);

INSERT INTO `user` (username, password, nama, alamat, hp, level) VALUES
('admin1', 'admin123', 'Administrator', 'Surabaya', '081200000001', 1),
('petugas1', 'petugas123', 'Petugas Satu', 'Gresik', '081200000002', 2),
('petugas2', 'petugas123', 'Petugas Dua', 'Sidoarjo', '081200000003', 2),
('user04', 'user123', 'User Empat', 'Lamongan', '081200000004', 2),
('user05', 'user123', 'User Lima', 'Malang', '081200000005', 2),
('user06', 'user123', 'User Enam', 'Mojokerto', '081200000006', 2),
('user07', 'user123', 'User Tujuh', 'Gresik', '081200000007', 2),
('user08', 'user123', 'User Delapan', 'Surabaya', '081200000008', 2),
('user09', 'user123', 'User Sembilan', 'Bangkalan', '081200000009', 2),
('user10', 'user123', 'User Sepuluh', 'Surabaya', '081200000010', 2);

INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2026-10-01 09:00:00','Pembelian alat tulis',10000,1),
('2026-10-02 10:00:00','Pembelian pulpen',9000,2),
('2026-10-03 11:00:00','Pembelian pensil',7500,3),
('2026-10-04 12:00:00','Pembelian penghapus',4000,4),
('2026-10-05 13:00:00','Pembelian penggaris',8000,5),
('2026-10-06 14:00:00','Pembelian spidol',14000,6),
('2026-10-07 15:00:00','Pembelian map',7000,7),
('2026-10-08 09:30:00','Pembelian kertas',90000,8),
('2026-10-09 10:30:00','Pembelian stabilo',16000,9),
('2026-10-10 11:30:00','Pembelian rautan',10000,10);

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1,1,5000,2),(2,2,3000,3),(3,3,2500,3),(4,4,2000,2),(5,5,4000,2),
(6,6,7000,2),(7,7,3500,2),(8,8,45000,2),(9,9,8000,2),(10,10,5000,2);

INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES
('2026-10-01 09:05:00',10000,'TUNAI',1),
('2026-10-02 10:05:00',9000,'TRANSFER',2),
('2026-10-03 11:05:00',7500,'EDC',3),
('2026-10-04 12:05:00',4000,'TUNAI',4),
('2026-10-05 13:05:00',8000,'TRANSFER',5),
('2026-10-06 14:05:00',14000,'EDC',6),
('2026-10-07 15:05:00',7000,'TUNAI',7),
('2026-10-08 09:35:00',90000,'TRANSFER',8),
('2026-10-09 10:35:00',16000,'EDC',9),
('2026-10-10 11:35:00',10000,'TUNAI',10);
