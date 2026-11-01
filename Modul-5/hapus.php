<?php
require 'config.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: index.php');
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM supplier WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: index.php');
    exit;
} catch (PDOException $e) {
    // Supplier tidak bisa dihapus jika masih dipakai oleh data barang (foreign key).
    die("Supplier tidak dapat dihapus karena masih digunakan pada data barang. "
        . '<br><a href="index.php">Kembali</a>');
}
?>
