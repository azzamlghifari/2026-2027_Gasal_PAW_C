<?php
require 'config.php';

$stmt = $pdo->query("SELECT * FROM supplier ORDER BY id DESC");
$suppliers = $stmt->fetchAll();

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Supplier</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; color: #333; }
        h2 { color: #397f9d; font-weight: normal; }
        .tambah, .btn { display: inline-block; padding: 8px 12px; color: white;
            text-decoration: none; border-radius: 4px; border: 0; cursor: pointer; }
        .tambah { background: #75ad45; float: right; }
        .edit { background: #e87519; }
        .hapus { background: #c82333; }
        table { border-collapse: collapse; width: 100%; margin-top: 18px; }
        th { background: #d9edf7; text-align: left; }
        th, td { border: 1px solid #ddd; padding: 10px; }
        tr:nth-child(even) { background: #f8f8f8; }
        .kosong { text-align: center; color: #777; }
    </style>
</head>
<body>
    <h2>Data Master Supplier</h2>
    <a class="tambah" href="tambah.php">Tambah Data</a>
    <div style="clear:both"></div>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>
        <?php if (count($suppliers) > 0): ?>
            <?php $no = 1; foreach ($suppliers as $supplier): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= e($supplier['nama']) ?></td>
                <td><?= e($supplier['telp']) ?></td>
                <td><?= e($supplier['alamat']) ?></td>
                <td>
                    <a class="btn edit" href="edit.php?id=<?= (int)$supplier['id'] ?>">Edit</a>
                    <a class="btn hapus" href="hapus.php?id=<?= (int)$supplier['id'] ?>"
                       onclick="return confirm('Anda yakin akan menghapus supplier ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5" class="kosong">Belum ada data supplier.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
