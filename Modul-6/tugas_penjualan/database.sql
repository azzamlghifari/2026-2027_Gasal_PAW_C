CREATE DATABASE IF NOT EXISTS db_penjualan;
USE db_penjualan;

CREATE TABLE supplier (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nama VARCHAR(100) NOT NULL,
 telp VARCHAR(12),
 alamat TEXT
);

CREATE TABLE barang (
 id INT AUTO_INCREMENT PRIMARY KEY,
 kode_barang VARCHAR(10) UNIQUE NOT NULL,
 nama_barang VARCHAR(100) NOT NULL,
 harga INT NOT NULL,
 stok INT NOT NULL,
 supplier_id INT,
 FOREIGN KEY (supplier_id) REFERENCES supplier(id)
);

CREATE TABLE pelanggan (
 id VARCHAR(20) PRIMARY KEY,
 nama VARCHAR(100) NOT NULL,
 jenis_kelamin ENUM('L','P'),
 telp VARCHAR(12),
 alamat TEXT
);

CREATE TABLE transaksi (
 id INT AUTO_INCREMENT PRIMARY KEY,
 waktu_transaksi DATE NOT NULL,
 keterangan TEXT,
 total INT DEFAULT 0,
 pelanggan_id VARCHAR(20),
 FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id)
);

CREATE TABLE transaksi_detail (
 transaksi_id INT NOT NULL,
 barang_id INT NOT NULL,
 harga INT NOT NULL,
 qty INT NOT NULL,
 PRIMARY KEY (transaksi_id, barang_id),
 FOREIGN KEY (transaksi_id) REFERENCES transaksi(id),
 FOREIGN KEY (barang_id) REFERENCES barang(id)
);

CREATE TABLE pembayaran (
 id INT AUTO_INCREMENT PRIMARY KEY,
 waktu_bayar DATETIME,
 total INT NOT NULL,
 metode ENUM('TUNAI','TRANSFER','EDC'),
 transaksi_id INT,
 FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
);

CREATE TABLE user (
 id_user TINYINT AUTO_INCREMENT PRIMARY KEY,
 username VARCHAR(30) NOT NULL,
 password VARCHAR(35) NOT NULL,
 nama VARCHAR(50),
 alamat VARCHAR(150),
 hp VARCHAR(20),
 level TINYINT(1)
);

INSERT INTO supplier (nama,telp,alamat) VALUES
('PT Sumber Makmur','081234567890','Surabaya'),
('CV Jaya Abadi','081234567891','Malang'),
('PT Indo Grosir','081234567892','Sidoarjo'),
('CV Berkah','081234567893','Gresik'),
('PT Sejahtera','081234567894','Mojokerto');

INSERT INTO barang (kode_barang,nama_barang,harga,stok,supplier_id) VALUES
('BR001','Laptop',5000000,10,1),
('BR002','Mouse',75000,30,2),
('BR003','Keyboard',150000,20,2),
('BR004','Monitor',1500000,15,3),
('BR005','Flashdisk',50000,50,4),
('BR006','Printer',1200000,10,5);

INSERT INTO pelanggan (id,nama,jenis_kelamin,telp,alamat) VALUES
('PL001','Andi','L','081111111111','Surabaya'),
('PL002','Budi','L','082222222222','Malang'),
('PL003','Citra','P','083333333333','Sidoarjo'),
('PL004','Dina','P','084444444444','Gresik'),
('PL005','Eko','L','085555555555','Mojokerto');

INSERT INTO transaksi (waktu_transaksi,keterangan,total,pelanggan_id) VALUES
('2026-10-01','Transaksi 1',0,'PL001'),
('2026-10-02','Transaksi 2',0,'PL002'),
('2026-10-03','Transaksi 3',0,'PL003'),
('2026-10-04','Transaksi 4',0,'PL004'),
('2026-10-05','Transaksi 5',0,'PL005'),
('2026-10-06','Transaksi 6',0,'PL001'),
('2026-10-07','Transaksi 7',0,'PL002'),
('2026-10-08','Transaksi 8',0,'PL003'),
('2026-10-09','Transaksi 9',0,'PL004'),
('2026-10-10','Transaksi 10',0,'PL005');

INSERT INTO user (username,password,nama,alamat,hp,level) VALUES
('admin','admin123','Administrator','Surabaya','081234567890',1);
