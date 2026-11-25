<?php
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    echo "Anda tidak berhak mengakses halaman ini.";
    exit;
}

$level = isset($_SESSION['level']) ? $_SESSION['level'] : 2;
$nama_user = isset($_SESSION['nama_user']) ? htmlspecialchars($_SESSION['nama_user']) : htmlspecialchars($_SESSION['username']);
?>
<div style="background: #0d47a1; color: #fff; padding: 10px 20px;">
    <strong>Sistem Penjualan</strong> |
    <a href="beranda.php" style="color: #fff;">Home</a>

    <?php if ($level == 1) { ?>
        <a href="data_master.php" style="color: #fff;">| Data Master</a>
        | <a href="transaksi.php" style="color: #fff;">Transaksi</a>
        | <a href="laporan_penjualan.php" style="color: #fff;">Laporan</a>
    <?php } elseif ($level == 2) { ?>
        | <a href="transaksi.php" style="color: #fff;">Transaksi</a>
        | <a href="laporan_penjualan.php" style="color: #fff;">Laporan</a>
    <?php } ?>

    <span style="float: right;">
        <?php echo $nama_user; ?> |
        <a href="logout.php" style="color: #ffeb3b;">Logout</a>
    </span>
</div>