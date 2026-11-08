<?php
require "config.php";
$transaksi = $pdo->query("
    SELECT t.id, t.waktu_transaksi, t.total, p.nama AS pelanggan
    FROM transaksi t
    LEFT JOIN pelanggan p ON p.id = t.pelanggan_id
    ORDER BY t.id DESC
")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Sistem Penjualan</title>
<style>
body{font-family:Arial;margin:35px;background:#f5f5f5}
.container{background:white;padding:25px;border-radius:10px;max-width:950px;margin:auto}
table{border-collapse:collapse;width:100%;margin-top:15px}
th,td{border:1px solid #ddd;padding:10px;text-align:left}
th{background:#eee}
a,button{display:inline-block;padding:8px 12px;background:#2563eb;color:white;text-decoration:none;border:0;border-radius:5px}
.menu{margin-bottom:18px}
</style>
</head>
<body><div class="container">
<h2>Sistem Penjualan</h2>
<div class="menu">
<a href="index.php">Daftar Transaksi</a>
<a href="barang.php">Data Barang</a>
</div>
<h3>Daftar Transaksi</h3>
<table>
<tr><th>ID</th><th>Tanggal</th><th>Pelanggan</th><th>Total</th><th>Aksi</th></tr>
<?php foreach($transaksi as $t): ?>
<tr>
<td><?= htmlspecialchars($t['id']) ?></td>
<td><?= htmlspecialchars($t['waktu_transaksi']) ?></td>
<td><?= htmlspecialchars($t['pelanggan'] ?? '-') ?></td>
<td>Rp <?= number_format($t['total'],0,',','.') ?></td>
<td><a href="transaksi_detail.php?id=<?= $t['id'] ?>">Kelola Detail</a></td>
</tr>
<?php endforeach; ?>
</table>
</div></body></html>