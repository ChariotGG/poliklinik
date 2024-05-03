<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
    <h2>Anda telah berhasil logout</h2>
    <p>Terima kasih atas kunjungan Anda.</p>
    <p><a href="login.php">Login kembali</a></p>
</body>
</html>

<?php
// Mulai atau lanjutkan sesi
session_start();

// Hancurkan semua data sesi
session_destroy();

// Redirect ke halaman login
header("Location: login.php");
exit; // pastikan untuk keluar dari skrip setelah melakukan redirect
?>
