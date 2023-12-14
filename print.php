<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

// Handle form submission
if (isset($_GET['tanggal_mulai'])) {
    // Get user-inputted start and end dates
    $tanggal_mulai = $_GET['tanggal_mulai'];
    $tanggal_selesai = $_GET['tanggal_selesai'];

    // Validate and sanitize input if needed

    // Build the query with the date range
    $query = "SELECT DATE(tanggal_jam_masuk) as tanggal_masuk,
                SUM(CASE WHEN jenis_kendaraan LIKE '%mobil%' THEN 1 ELSE 0 END) as jumlah_mobil,
                SUM(CASE WHEN jenis_kendaraan LIKE '%motor%' THEN 1 ELSE 0 END) as jumlah_motor,
                SUM(CASE WHEN jenis_kendaraan LIKE '%truk%' THEN 1 ELSE 0 END) as jumlah_truk,
                COUNT(*) as jumlah_data,
                SUM(total_bayar) as total_pemasukan
            FROM data_parkir_keluar
            WHERE DATE(tanggal_jam_masuk) BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'
            GROUP BY DATE(tanggal_jam_masuk)";

    $parkir_keluar = query($query);
}
?>

<body onload="print()">
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmedit">
        <?php if (!empty($tanggal_mulai)) { ?>
            <center>
                <h2>LAPORAN PARKIR</h2>
                <hr>
                <br>
                <h4>PERIODE PEMESANAN <b><?php echo ($tanggal_mulai); ?> s/d <?php echo ($tanggal_selesai); ?></b> </h4>
                <br>
            </center>
        <?php } else { ?>
            <center>
                <h2>LAPORAN PARKIR</h2>
                <hr>
            </center>
        <?php } ?>
        <table class="table my-0" border="1px">
            <thead>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jumlah Motor</th>
                <th>Jumlah Mobil</th>
                <th>Jumlah Truk</th>
                <th>Total Kendaraan</th>
                <th>Total Pemasukan</th>
            </thead>
            <tbody>
                <?php
                $nomor = 0;
                $total_pemasukan = 0;
                foreach ($parkir_keluar as $row) {
                    $nomor++;
                    $total_pemasukan += $row["total_pemasukan"];
                ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $row["tanggal_masuk"]; ?></td>
                        <td><?php echo $row["jumlah_motor"]; ?></td>
                        <td><?php echo $row["jumlah_mobil"]; ?></td>
                        <td><?php echo $row["jumlah_truk"]; ?></td>
                        <td><?php echo $row["jumlah_data"]; ?></td>
                        <td><?php echo $row["total_pemasukan"]; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
            <tr>
                <th align="center"><strong></strong></th>
                <th><strong></strong></th>
                <th><strong></strong></th>
                <th><strong></strong></th>
                <th><strong></strong></th>
                <th><strong>Total Pemasukan</strong></th>
                <th style="background-color: whitesmoke;" align="right"><strong>Rp. <?php echo number_format($total_pemasukan); ?>,-</strong></th>
            </tr>
        </table>
    </form>
</body>