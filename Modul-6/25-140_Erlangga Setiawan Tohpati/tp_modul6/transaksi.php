<!DOCTYPE html>
<html>
 <head>
 <title>Transaksi</title>
 </head>
 <body>

 <h1>Daftar Master Transaksi</h1>
 <table border="1">
 <tr>
     <th>ID Transaksi</th>
     <th>Waktu Transaksi</th>
     <th>Keterangan</th>
     <th>Total</th>
     <th>Pelanggan ID</th>
 </tr>
 <?php
 $koneksi = mysqli_connect("localhost", "root", "", "db_tp_modul6");

 if (mysqli_connect_error()) {
     die("Koneksi database gagal: " . mysqli_connect_error());
 }

 $query_master = "SELECT id, waktu_transaksi, keterangan, total, pelanggan_id FROM penjualan_transaksi";
 $result_master = mysqli_query($koneksi, $query_master);

 while ($row = mysqli_fetch_assoc($result_master)) {
     echo "<tr>";
     echo "<td>" . $row['id'] . "</td>";
     echo "<td>" . $row['waktu_transaksi'] . "</td>";
     echo "<td>" . $row['keterangan'] . "</td>";
     echo "<td>Rp " . number_format($row['total'], 0, ',', '.') . "</td>";
     echo "<td>" . $row['pelanggan_id'] . "</td>";
     echo "</tr>";
 }
 ?>
 </table>

 <br>

 <h1>Daftar Detail Transaksi</h1>
 <table border="1">
 <tr>
     <th>ID Transaksi</th>
     <th>Barang ID</th>
     <th>Harga</th>
     <th>Qty</th>
 </tr>
 <?php
 $query_detail = "SELECT transaksi_id, barang_id, harga, qty FROM penjualan_transaksi_detail";
 $result_detail = mysqli_query($koneksi, $query_detail);

 while ($row = mysqli_fetch_assoc($result_detail)) {
     echo "<tr>";
     echo "<td>" . $row['transaksi_id'] . "</td>";
     echo "<td>" . $row['barang_id'] . "</td>";
     echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
     echo "<td>" . $row['qty'] . "</td>";
     echo "</tr>";
 }

 mysqli_close($koneksi);
 ?>
 </table>

 </body>
</html>