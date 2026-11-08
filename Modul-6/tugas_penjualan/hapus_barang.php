<?php
require "config.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (!$id) {
    header("Location: barang.php?pesan=" . urlencode("ID barang tidak valid."));
    exit;
}

// Periksa apakah barang pernah dipakai pada transaksi_detail.
$cek = $pdo->prepare("SELECT COUNT(*) FROM transaksi_detail WHERE barang_id=?");
$cek->execute([$id]);

if ($cek->fetchColumn() > 0) {
    header("Location: barang.php?pesan=" .
        urlencode("Barang tidak dapat dihapus karena masih digunakan dalam transaksi."));
    exit;
}

$hapus = $pdo->prepare("DELETE FROM barang WHERE id=?");
$hapus->execute([$id]);

header("Location: barang.php?pesan=" . urlencode("Barang berhasil dihapus."));
exit;
?>