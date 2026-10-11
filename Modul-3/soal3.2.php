```php
<?php
$weight = array(
    "Andy" => "70",
    "Barry" => "65",
    "Charlie" => "75"
);

// Menampilkan isi array
echo 'weight = (';
foreach ($weight as $nama => $berat) {
    echo '"' . $nama . '"=>"' . $berat . '"';
    if ($nama != "Charlie") {
        echo ', ';
    }
}
echo ')<br>';

// Menampilkan data kedua
echo "Data kedua: " . $weight["Barry"];
?>
```