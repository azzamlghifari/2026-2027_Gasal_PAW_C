<?php
require "config.php";
$barang = $pdo->query("
    SELECT b.*, s.nama AS nama_supplier
    FROM barang b LEFT JOIN supplier s ON s.id=b.supplier_id
    ORDER BY b.id
")->fetchAll();
$pesan = $_GET["pesan"] ?? "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Barang</title>
<style>
body{font-family:Arial;margin:35px;background:#f5f5f5}
.container{background:white;padding:25px;border-radius:10px;max-width:950px;margin:auto}
table{border-collapse:collapse;width:100%;margin-top:15px}
th,td{border:1px solid #ddd;padding:10px}
th{background:#eee}
a{display:inline-block;padding:8px 12px;background:#2563eb;color:white;text-decoration:none;border-radius:5px}
.hapus{background:#dc2626}
.pesan{padding:10px;background:#fef3c7;margin:12px 0}
</style>
</head>
<body><div class="container">
<a href="index.php">Kembali</a>
<h2>Data Barang</h2>
<?php if($pesan): ?><div class="pesan"><?= htmlspecialchars($pesan) ?></div><?php endif; ?>
<table>
<tr><th>ID</th><th>Kode</th><th>Nama</th><th>Harga</th><th>Stok</th><th>Supplier</th><th>Aksi</th></tr>
<?php foreach($barang as $b): ?>
<tr>
<td><?= $b["id"] ?></td>
<td><?= htmlspecialchars($b["kode_barang"]) ?></td>
<td><?= htmlspecialchars($b["nama_barang"]) ?></td>
<td>Rp <?= number_format($b["harga"],0,',','.') ?></td>
<td><?= $b["stok"] ?></td>
<td><?= htmlspecialchars($b["nama_supplier"] ?? "-") ?></td>
<td><a class="hapus" href="hapus_barang.php?id=<?= $b["id"] ?>"
onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</a></td>
</tr>
<?php endforeach; ?>
</table>
</div></body></html>