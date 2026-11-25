<?php
session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    header("Location: beranda.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
</head>
<body>
    <h2>Login Sistem Penjualan</h2>
    <form action="proses-login.php" method="POST">
        Username:
        <input type="text" name="username" placeholder="Enter the username" required><br><br>
        Password:
        <input type="password" name="password" placeholder="Enter the password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>