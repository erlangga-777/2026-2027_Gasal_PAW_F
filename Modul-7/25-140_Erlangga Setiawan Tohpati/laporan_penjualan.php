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

$chart_labels = [];
$chart_data = [];

if (!empty($tanggal_mulai) && !empty($tanggal_selesai)) {
    $query_chart = "SELECT waktu_transaksi, SUM(total) as total_pendapatan FROM transaksi WHERE waktu_transaksi BETWEEN '$tanggal_mulai' AND '$tanggal_selesai' GROUP BY waktu_transaksi ORDER BY waktu_transaksi ASC";
} else {
    $query_chart = "SELECT waktu_transaksi, SUM(total) as total_pendapatan FROM transaksi GROUP BY waktu_transaksi ORDER BY waktu_transaksi ASC";
}

$result_chart = mysqli_query($koneksi, $query_chart);
if ($result_chart) {
    while ($row_c = mysqli_fetch_assoc($result_chart)) {
        $chart_labels[] = $row_c['waktu_transaksi'];
        $chart_data[] = $row_c['total_pendapatan'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
</head>
<body>
    <h2>Laporan Penjualan</h2>
    
    <form method="GET" action="">
        <label for="tanggal_mulai">Tanggal Mulai:</label>
        <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="<?php echo $tanggal_mulai; ?>" required>
        
        <label for="tanggal_selesai">Tanggal Selesai:</label>
        <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="<?php echo $tanggal_selesai; ?>" required>
        
        <button type="submit">Tampilkan</button>
        <button type="button" onclick="window.print()">Cetak</button>
        <a href="ekspor.php?tanggal_mulai=<?php echo $tanggal_mulai; ?>&tanggal_selesai=<?php echo $tanggal_selesai; ?>" target="_blank">
            <button type="button">Excel</button>
        </a>
    </form>
    <br>

    <div style="width: 500px;">
      <canvas id="myChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
      const ctx = document.getElementById('myChart');

      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: <?php echo json_encode($chart_labels); ?>,
          datasets: [{
            label: 'Total Pendapatan (Rp)',
            data: <?php echo json_encode($chart_data); ?>,
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    </script>
    <br>

    <h3>Rekap Penjualan Hari Ini</h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Total Pendapatan (Rp)</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($tanggal_mulai) && !empty($tanggal_selesai)) {
                $query_rekap = "SELECT waktu_transaksi, SUM(total) as total_pendapatan FROM transaksi WHERE waktu_transaksi BETWEEN '$tanggal_mulai' AND '$tanggal_selesai' GROUP BY waktu_transaksi ORDER BY waktu_transaksi ASC";
            } else {
                $query_rekap = "SELECT waktu_transaksi, SUM(total) as total_pendapatan FROM transaksi GROUP BY waktu_transaksi ORDER BY waktu_transaksi ASC";
            }

            $result_rekap = mysqli_query($koneksi, $query_rekap);
            $no_r = 1;

            if ($result_rekap && mysqli_num_rows($result_rekap) > 0) {
                while ($row_r = mysqli_fetch_assoc($result_rekap)) {
                    ?>
                    <tr>
                        <td><?php echo $no_r++; ?></td>
                        <td>Rp <?php echo number_format($row_r['total_pendapatan'], 0, ',', '.'); ?></td>
                        <td><?php echo $row_r['waktu_transaksi']; ?></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='3' align='center'>Tidak ada data rekap</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>

    <?php
    if (!empty($tanggal_mulai) && !empty($tanggal_selesai)) {
        $query_summary = "SELECT COUNT(DISTINCT pelanggan_id) as jumlah_pelanggan, SUM(total) as total_pendapatan FROM transaksi WHERE waktu_transaksi BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'";
    } else {
        $query_summary = "SELECT COUNT(DISTINCT pelanggan_id) as jumlah_pelanggan, SUM(total) as total_pendapatan FROM transaksi";
    }

    $result_summary = mysqli_query($koneksi, $query_summary);
    $summary = mysqli_fetch_assoc($result_summary);
    $jumlah_pelanggan = $summary['jumlah_pelanggan'] ?? 0;
    $total_pendapatan = $summary['total_pendapatan'] ?? 0;
    ?>

    <div style="border: 1px solid #000; padding: 15px; width: 350px; background-color: #f9f9f9;">
        <h3 style="margin-top: 0;">Rekap Penjualan Hari Ini</h3>
        <p><strong>Jumlah Pelanggan:</strong> <?php echo $jumlah_pelanggan; ?> Orang</p>
        <p><strong>Total Pendapatan:</strong> Rp <?php echo number_format($total_pendapatan, 0, ',', '.'); ?></p>
    </div>
    <br>

    <h3>Detail Transaksi</h3>
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

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['waktu_transaksi']; ?></td>
                        <td><?php echo $row['pelanggan_id']; ?></td>
                        <td><?php echo $row['keterangan']; ?></td>
                        <td>Rp <?php echo number_format($row['total'], 0, ',', '.'); ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>

</body>
</html>