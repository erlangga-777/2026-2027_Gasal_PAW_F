<!DOCTYPE html>
<html>
<head>
    <title>Daftar Barang</title>
</head>
<body>

    <h1>Daftar Barang</h1>

    <table border="1" cellpadding="" cellspacing="">
        <tr>
            <th>ID</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php
        $koneksi = mysqli_connect("localhost", "root", "", "db_tp_modul6");

        if (!$koneksi) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }

        $query = mysqli_query($koneksi, "SELECT * FROM penjualan_barang");
        while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['kode_barang'] . "</td>";
            echo "<td>" . $row['nama_barang'] . "</td>";
            echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
            echo "<td>" . $row['stok'] . "</td>";
            echo "<td><a href='hapus_barang.php?id=" . $row['id'] . "' onclick='return confirm(\"Yakin ingin menghapus barang ini?\")'>Hapus</a></td>";
            echo "</tr>";
        }
        mysqli_close($koneksi);
        ?>
    </table>

</body>
</html>