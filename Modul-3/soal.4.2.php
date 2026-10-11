```php
<?php
$weight = array(
    "Andy" => "70",
    "Barry" => "65",
    "Charlie" => "75"
);

echo 'weight = (';
foreach ($weight as $nama => $berat) {
    echo '"' . $nama . '"=>"' . $berat . '"';
    if ($nama != "Charlie") {
        echo ', ';
    }
}
echo ')<br><br>';

$arrlength = count($weight);


$nama = array_keys($weight);
$berat = array_values($weight);

for ($i = 0; $i < $arrlength; $i++) {
    echo $nama[$i] . " is " . $berat[$i] . " kg.<br>";
}
?>
```