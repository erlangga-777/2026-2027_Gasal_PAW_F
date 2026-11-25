<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    echo "Anda tidak berhak mengakses halaman ini.";
    exit;
}

include "navbar.php";

$nama_user = isset($_SESSION['nama_user']) ? htmlspecialchars($_SESSION['nama_user']) : htmlspecialchars($_SESSION['username']);
$level = isset($_SESSION['level']) ? (int) $_SESSION['level'] : 2;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Beranda</title>
</head>
<body>
    <h2>Selamat datang, <?php echo $nama_user; ?></h2>
    <p>Level: <?php echo ($level == 1) ? "Owner (1)" : "Kasir (2)"; ?></p>
</body>
</html>