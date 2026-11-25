<?php
$conn = mysqli_connect("localhost", "root", "", "db_belajar_keamanan");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>