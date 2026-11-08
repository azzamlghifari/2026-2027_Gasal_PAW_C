<?php
require "config.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (!$id) die("ID transaksi tidak valid.");

$stmt = $pdo->prepare("SELECT t.*, p.nama AS nama_pelanggan
                       FROM transaksi t
                       LEFT JOIN pelanggan p ON p.id=t.pelanggan_id
                       WHERE t.id=?");
$stmt->execute([$id]);
$transaksi = $stmt->fetch();
if (!$transaksi) die("Transaksi tidak ditemukan.");

$pesan = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $barang_id = filter_input(INPUT_POST, "barang_id", FILTER_VALIDATE_INT);
    $qty = filter_input(INPUT_POST, "qty", FILTER_VALIDATE_INT);

    if (!$barang_id || !$qty || $qty < 1) {
        $pesan = "Pilih barang dan isi qty minimal 1.";
    } else {
        try {
            // Cegah barang yang sama dimasukkan dua kali pada transaksi ini.
            $cek = $pdo->prepare("SELECT COUNT(*) FROM transaksi_detail
                                  WHERE transaksi_id=? AND barang_id=?");
            $cek->execute([$id, $barang_id]);

            if ($cek->fetchColumn() > 0) {
                $pesan = "Barang tersebut sudah ada dalam detail transaksi ini.";
            } else {
                $ambil = $pdo->prepare("SELECT harga FROM barang WHERE id=?");
                $ambil->execute([$barang_id]);
                $barang = $ambil->fetch();

                if (!$barang) {
                    $pesan = "Barang tidak ditemukan.";
                } else {
                    $pdo->beginTransaction();

                    $simpan = $pdo->prepare("INSERT INTO transaksi_detail
                        (transaksi_id, barang_id, harga, qty) VALUES (?, ?, ?, ?)");
                    $simpan->execute([$id, $barang_id, $barang["harga"], $qty]);

                    // Hitung ulang total dari seluruh detail transaksi.
                    $hitung = $pdo->prepare("SELECT COALESCE(SUM(harga * qty),0)
                                             FROM transaksi_detail WHERE transaksi_id=?");
                    $hitung->execute([$id]);
                    $total = $hitung->fetchColumn();

                    $update = $pdo->prepare("UPDATE transaksi SET total=? WHERE id=?");
                    $update->execute([$total, $id]);

                    $pdo->commit();
                    header("Location: transaksi_detail.php?id=" . $id . "&sukses=1");
                    exit;
                }
            }
        } catch (Exception $e) {
            if ($pdo->inTransaction()) $pdo->rollBack();
            $pesan = "Gagal menyimpan detail: " . $e->getMessage();
        }
    }
}

if (isset($_GET["sukses"])) $pesan = "Detail transaksi berhasil disimpan.";

// Dropdown hanya menampilkan barang yang belum dipakai pada transaksi ini.
$barang = $pdo->prepare("
    SELECT b.id, b.kode_barang, b.nama_barang, b.harga
    FROM barang b
    WHERE NOT EXISTS (
        SELECT 1 FROM transaksi_detail d
        WHERE d.transaksi_id=? AND d.barang_id=b.id
    )
    ORDER BY b.nama_barang
");
$barang->execute([$id]);
$daftar_barang = $barang->fetchAll();

$detail = $pdo->prepare("
    SELECT d.barang_id, b.kode_barang, b.nama_barang, d.harga, d.qty,
           (d.harga*d.qty) AS subtotal
    FROM transaksi_detail d
    JOIN barang b ON b.id=d.barang_id
    WHERE d.transaksi_id=?
    ORDER BY b.nama_barang
");
$detail->execute([$id]);
$daftar_detail = $detail->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Detail Transaksi</title>
<style>
body{font-family:Arial;margin:35px;background:#f5f5f5}
.container{background:white;padding:25px;border-radius:10px;max-width:950px;margin:auto}
table{border-collapse:collapse;width:100%;margin-top:15px}
th,td{border:1px solid #ddd;padding:10px;text-align:left}
th{background:#eee}
input,select{padding:9px;margin:5px 0;width:260px}
button,a{padding:9px 13px;background:#2563eb;color:white;text-decoration:none;border:0;border-radius:5px;cursor:pointer}
.pesan{padding:10px;background:#e0f2fe;margin:12px 0}
</style>
</head>
<body><div class="container">
<a href="index.php">Kembali</a>
<h2>Detail Transaksi #<?= $id ?></h2>
<p>Tanggal: <?= htmlspecialchars($transaksi["waktu_transaksi"]) ?></p>
<p>Pelanggan: <?= htmlspecialchars($transaksi["nama_pelanggan"] ?? "-") ?></p>

<?php if($pesan): ?><div class="pesan"><?= htmlspecialchars($pesan) ?></div><?php endif; ?>

<h3>Tambah Barang</h3>
<form method="post">
<label>Barang</label><br>
<select name="barang_id" required>
<option value="">-- Pilih Barang --</option>
<?php foreach($daftar_barang as $b): ?>
<option value="<?= $b["id"] ?>">
<?= htmlspecialchars($b["kode_barang"]." - ".$b["nama_barang"]." (Rp ".number_format($b["harga"],0,',','.').")") ?>
</option>
<?php endforeach; ?>
</select><br>
<label>Qty</label><br>
<input type="number" name="qty" min="1" value="1" required><br>
<button type="submit">Simpan Detail</button>
</form>

<h3>Daftar Detail Barang</h3>
<table>
<tr><th>Kode</th><th>Nama Barang</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr>
<?php foreach($daftar_detail as $d): ?>
<tr>
<td><?= htmlspecialchars($d["kode_barang"]) ?></td>
<td><?= htmlspecialchars($d["nama_barang"]) ?></td>
<td>Rp <?= number_format($d["harga"],0,',','.') ?></td>
<td><?= $d["qty"] ?></td>
<td>Rp <?= number_format($d["subtotal"],0,',','.') ?></td>
</tr>
<?php endforeach; ?>
</table>
<h3>Total Transaksi: Rp <?= number_format($transaksi["total"],0,',','.') ?></h3>
</div></body></html>