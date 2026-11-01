<?php
require 'config.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) { die('ID supplier tidak valid.'); }

$stmt = $pdo->prepare("SELECT * FROM supplier WHERE id = ?");
$stmt->execute([$id]);
$supplier = $stmt->fetch();
if (!$supplier) { die('Data supplier tidak ditemukan.'); }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $telp = trim($_POST['telp'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');

    if ($nama === '') {
        $error = 'Nama supplier wajib diisi.';
    } else {
        $update = $pdo->prepare("UPDATE supplier SET nama = ?, telp = ?, alamat = ? WHERE id = ?");
        $update->execute([$nama, $telp, $alamat, $id]);
        header('Location: index.php');
        exit;
    }
}
function e($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><title>Edit Supplier</title>
<style>
body{font-family:Arial;margin:40px;color:#333}h2{color:#397f9d;font-weight:normal}
label{display:inline-block;width:100px;margin:10px 0}
input,textarea{width:280px;padding:9px;border:1px solid #ccc;border-radius:4px}
button,a{padding:9px 14px;border:0;border-radius:4px;color:white;text-decoration:none;cursor:pointer}
button{background:#75ad45}.batal{background:#c82333}.error{color:#c82333}
</style>
</head>
<body>
<h2>Edit Data Master Supplier</h2>
<?php if ($error): ?><p class="error"><?= e($error) ?></p><?php endif; ?>
<form method="post">
    <div><label>Nama</label><input type="text" name="nama" required value="<?= e($_POST['nama'] ?? $supplier['nama']) ?>"></div>
    <div><label>Telp</label><input type="text" name="telp" value="<?= e($_POST['telp'] ?? $supplier['telp']) ?>"></div>
    <div><label>Alamat</label><textarea name="alamat" rows="3"><?= e($_POST['alamat'] ?? $supplier['alamat']) ?></textarea></div>
    <br><button type="submit">Update</button>
    <a class="batal" href="index.php">Batal</a>
</form>
</body>
</html>
