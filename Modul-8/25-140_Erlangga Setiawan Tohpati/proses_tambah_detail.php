<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_tp_modul6");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if (isset($_POST['simpan'])) {
    $transaksi_id = $_POST['transaksi_id'];
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    $q_barang = mysqli_query($koneksi, "SELECT harga FROM penjualan_barang WHERE id = '$barang_id'");
    $data_barang = mysqli_fetch_assoc($q_barang);
    $harga = $data_barang['harga'];

    $query_insert = "INSERT INTO penjualan_transaksi_detail (transaksi_id, barang_id, harga, qty) 
                     VALUES ('$transaksi_id', '$barang_id', '$harga', '$qty')";
    
    if (mysqli_query($koneksi, $query_insert)) {
        
        $q_hitung = mysqli_query($koneksi, "SELECT SUM(harga * qty) AS total_baru FROM penjualan_transaksi_detail WHERE transaksi_id = '$transaksi_id'");
        $data_hitung = mysqli_fetch_assoc($q_hitung);
        $total_baru = $data_hitung['total_baru'];

        mysqli_query($koneksi, "UPDATE penjualan_transaksi SET total = '$total_baru' WHERE id = '$transaksi_id'");

        echo "<script>
                alert('Detail transaksi berhasil ditambahkan dan total transaksi berhasil diperbarui!');
                window.location.href='tambah_detail.php';
              </script>";
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>