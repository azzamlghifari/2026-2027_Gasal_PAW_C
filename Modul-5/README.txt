MODUL 5 - DATABASE PHP NATIVE

ISI FOLDER
- database.sql : membuat database, 7 tabel, relasi, dan 10 data contoh per tabel
- config.php   : koneksi PDO ke MySQL
- index.php    : menampilkan data supplier
- tambah.php   : menambah supplier
- edit.php     : mengubah supplier
- hapus.php    : menghapus supplier dengan konfirmasi popup dari index.php

CARA MENJALANKAN
1. Jalankan Apache dan MySQL dari XAMPP.
2. Buka http://localhost/phpmyadmin
3. Pilih menu Import, pilih file database.sql, lalu klik Import/Go.
4. Ekstrak folder modul5_database ke C:\xampp\htdocs\
5. Pastikan pengaturan config.php sesuai:
   host = localhost, dbname = db_penjualan, username = root, password = ""
6. Buka browser:
   http://localhost/modul5_database/

CATATAN
- Password MySQL XAMPP umumnya kosong pada instalasi standar. Jika milikmu berbeda,
  ubah variabel $password di config.php.
- Tabel supplier terhubung ke tabel barang. Supplier yang masih dipakai oleh barang
  tidak dapat dihapus karena aturan foreign key. Hapus atau pindahkan barang terkait
  terlebih dahulu jika ingin menghapus supplier tersebut.
- Password user contoh hanya data latihan, bukan untuk aplikasi produksi.
