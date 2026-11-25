<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_tp_modul6");

if (isset($_GET['id'])) {
    $id_barang = $_GET['id'];

    $cek_transaksi = mysqli_query($koneksi, "SELECT * FROM penjualan_transaksi_detail WHERE barang_id = '$id_barang'");

    if (mysqli_num_rows($cek_transaksi) > 0) {
        $pesan = "Gagal menghapus! Barang tersebut masih digunakan pada transaksi.";
    } else {
        $query_hapus = mysqli_query($koneksi, "DELETE FROM penjualan_barang WHERE id = '$id_barang'");
        
        if ($query_hapus) {
            $pesan = "Data barang berhasil dihapus.";
        } else {
            $pesan = "Gagal menghapus data barang.";
        }
    }

    mysqli_close($koneksi);

    echo "<script>
            alert('$pesan');
            window.location.href='index_barang.php';
          </script>";
}
?>