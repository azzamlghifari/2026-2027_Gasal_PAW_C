```php
<?php
// Membuat array multidimensi berisi data mahasiswa
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);

// Menambahkan lima data mahasiswa baru
$students[] = array("Daniel", "220404", "0812345611");
$students[] = array("Elena", "220405", "0812345622");
$students[] = array("Fiona", "220406", "0812345633");
$students[] = array("Gabe", "220407", "0812345644");
$students[] = array("Hannah", "220408", "0812345655");

// Menampilkan data awal dan data setelah penambahan
echo "<h3>Data setelah ditambah 5 data lain:</h3>";
echo "students = (";
echo "<pre>";
print_r($students);
echo "</pre>";

// Menampilkan data dalam bentuk tabel
echo "<table border='1' cellpadding='5' cellspacing='0'>";

// Membuat judul tabel
echo "<tr>";
echo "<th>Name</th>";
echo "<th>NIM</th>";
echo "<th>Mobile</th>";
echo "</tr>";

// Menampilkan seluruh data mahasiswa
for ($i = 0; $i < count($students); $i++) {
    echo "<tr>";

    for ($j = 0; $j < 3; $j++) {
        echo "<td>" . $students[$i][$j] . "</td>";
    }

    echo "</tr>";
}

echo "</table>";
?>
```