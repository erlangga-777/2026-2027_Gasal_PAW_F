<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "penjualan";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$tanggal_mulai = isset($_GET['tanggal_mulai']) ? $_GET['tanggal_mulai'] : '';
$tanggal_selesai = isset($_GET['tanggal_selesai']) ? $_GET['tanggal_selesai'] : '';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<h3>Laporan Rekap Penjualan</h3>
<?php if (!empty($tanggal_mulai) && !empty($tanggal_selesai)) { ?>
    <p>Periode: <?php echo $tanggal_mulai; ?> s/d <?php echo $tanggal_selesai; ?></p>
<?php } ?>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>No.</th>
            <th>ID Transaksi</th>
            <th>Waktu Transaksi</th>
            <th>ID Pelanggan</th>
            <th>Keterangan</th>
            <th>Total (Rp)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($tanggal_mulai) && !empty($tanggal_selesai)) {
            $query = "SELECT * FROM transaksi WHERE waktu_transaksi BETWEEN '$tanggal_mulai' AND '$tanggal_selesai' ORDER BY waktu_transaksi ASC";
        } else {
            $query = "SELECT * FROM transaksi ORDER BY waktu_transaksi ASC";
        }

        $result = mysqli_query($koneksi, $query);
        $no = 1;
        $grand_total = 0;

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $grand_total += $row['total'];
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['waktu_transaksi']; ?></td>
                    <td><?php echo $row['pelanggan_id']; ?></td>
                    <td><?php echo $row['keterangan']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" align="right"><strong>Total Keseluruhan Pendapatan:</strong></td>
            <td><strong><?php echo $grand_total; ?></strong></td>
        </tr>
    </tfoot>
</table>