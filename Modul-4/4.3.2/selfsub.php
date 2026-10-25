<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Self Submission</title>
    <style>
        fieldset { width: 400px; padding: 10px 15px; }
        .field { margin-bottom: 8px; }
        .field label { display: inline-block; width: 130px; vertical-align: top; }
        .error { color: red; }
    </style>
</head>
<body>
    <h2>Register</h2>

<?php
$errors = array();

// Pengecekan apakah tombol submit sudah ditekan / ada isian form
if (isset($_POST['surname']) || isset($_POST['submit'])) {
    require 'validate.inc';

    // Validasi setiap field (Poin #9)
    validateName($errors, $_POST, 'surname');
    validateEmail($errors, $_POST, 'email');
    validatePassword($errors, $_POST, 'passwd');
    validateState($errors, $_POST, 'state');

    if ($errors) {
        // Tampilkan pesan error dan tampilkan kembali form (dengan isian sebelumnya)
        echo '<h1>Invalid, correct the following errors:</h1>';
        foreach ($errors as $field => $error) {
            echo "<p class='error'>{$field} {$error}</p>";
        }
        include 'form.inc';
    } else {
        // Tampilkan pesan sukses jika tidak ada error
        echo '<h1>Form submitted successfully with no errors</h1>';
    }
} else {
    // Tampilkan form kosong jika pertama kali diakses
    include 'form.inc';
}
?>

</body>
</html>