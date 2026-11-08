CARA MENJALANKAN PROJECT

1. Pastikan XAMPP (Apache dan MySQL) sudah aktif.
2. Buka phpMyAdmin.
3. Jalankan file database.sql pada tab SQL.
4. Salin folder tugas_penjualan ke C:\xampp\htdocs\
5. Periksa config.php. Default XAMPP biasanya:
   username = root
   password = kosong
6. Buka browser:
   http://localhost/tugas_penjualan/

HALAMAN:
- index.php              : daftar transaksi
- transaksi_detail.php   : tambah dan lihat detail transaksi
- barang.php             : daftar barang
- hapus_barang.php       : proses hapus dengan pemeriksaan relasi

CATATAN:
- Dropdown barang hanya menampilkan barang yang belum digunakan
  pada transaksi yang sedang dibuka.
- Database menggunakan PRIMARY KEY gabungan (transaksi_id, barang_id)
  sehingga satu barang hanya dapat muncul sekali per transaksi.
- Total transaksi dihitung ulang setelah detail disimpan.
