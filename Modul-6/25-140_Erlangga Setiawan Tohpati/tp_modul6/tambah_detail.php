<!DOCTYPE html>
<html>
<head>
    <title>Tambah Detail Transaksi</title>
</head>
<body>

    <h1>Tambah Barang ke Transaksi</h1>

    <form action="proses_tambah_detail.php" method="POST">
        <input type="hidden" name="transaksi_id" value="1">

        <label>Pilih Barang:</label><br>
        <select name="barang_id" required>
            <option value="">-- Pilih Barang --</option>
            <?php
            $koneksi = mysqli_connect("localhost", "root", "", "db_tp_modul6");

            if (!$koneksi) {
                die("Koneksi gagal: " . mysqli_connect_error());
            }

            $query_barang = mysqli_query($koneksi, "SELECT * FROM penjualan_barang");
            while ($b = mysqli_fetch_assoc($query_barang)) {
                echo "<option value='" . $b['id'] . "'>" . $b['nama_barang'] . " (Rp " . number_format($b['harga'], 0, ',', '.') . ")</option>";
            }
            mysqli_close($koneksi);
            ?>
        </select>
        <br><br>

        <label>Quantity (Qty):</label><br>
        <input type="number" name="qty" value="1" min="1" required>
        <br><br>

        <button type="submit" name="simpan">Simpan & Update Total</button>
    </form>

</body>
</html>