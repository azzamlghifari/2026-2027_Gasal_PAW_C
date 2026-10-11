```php
<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

// Menambahkan lima data baru
$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

// Menampilkan isi array
echo 'fruits = ("' . implode('", "', $fruits) . '")';
echo "<br>";

// Menampilkan nilai dengan indeks tertinggi
echo "Nilai dengan indeks tertinggi: " . $fruits[count($fruits) - 1];
?>
```