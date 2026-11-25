<?php
session_start();

unset($_SESSION['login']);
unset($_SESSION['username']);
unset($_SESSION['nama_user']);
unset($_SESSION['level']);

header("Location: index.php");
exit;
?>