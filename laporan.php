<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

// Handle form submission
if (isset($_POST['tanggal_mulai'])) {
    // Get user-inputted start and end dates
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];

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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Data Parkir Masuk</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="./css/style.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.php" class="brand-logo">
                <img class="logo-abbr" src="./images/logo.png" alt="">
                <!-- <img class="logo-compact" src="./images/logo-text.png" alt=""> -->
                <span class="p-3">Sistem Parkir Berbasis Web</span>
                <!-- <img class="brand-title" src="./images/logo-text.png" alt=""> -->
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account" style="height: 20px;"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!-- <a href="./app-profile.html" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a> -->
                                    <a href="logout.php" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li><a aria-expanded="false" href="index.php">
                            <i class="icon icon-single-04"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-label first">Data Master</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-form"></i><span class="nav-text">Data Master</span></a>
                        <ul aria-expanded="false">
                            <li><a href="data_admin.php">Data Admin</a></li>
                            <li><a href="data_jenis_kendaraan.php">Jenis Kendaraan</a></li>
                        </ul>
                    </li>

                    <li class="nav-label first">Tabel Parkir</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-chart-bar-33"></i><span class="nav-text">Data Parkir</span></a>
                        <ul aria-expanded="false">
                            <li><a href="data_parkir_masuk.php">Parkir Masuk</a></li>
                            <li><a href="data_parkir_keluar.php">Parkir Keluar</a></li>
                        </ul>
                    </li>

                    <li class="nav-label first">Laporan</li>
                    <li><a aria-expanded="false" href="laporan.php">
                            <i class="icon icon-world-2"></i>
                            <span class="nav-text">Laporan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="container-fluid">
                <div class="row page-titles mx-0 shadow-lg">
                    <div class="col-sm-6 p-md-0">
                        <!-- <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>
                            <span class="ml-1">Card</span>
                        </div> -->
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Laporan</a></li>
                        </ol>
                    </div>
                </div>
                <div class="cols">
                    <!-- Form Parkir Masuk -->
                    <form method="post">
                        <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
                            <div class="card text-white bg-primary shadow-lg">
                                <div class="card-header">
                                    <h5 class="card-title text-white">Filter Laporan</h5>
                                </div>
                                <div class="card-body mb-0">
                                    <div class="basic-form">
                                        <div class="form-group md-4">
                                            <label for="tanggal_mulai">Tanggal Mulai:</label>
                                            <input type="date" class="form-control" name="tanggal_mulai" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_selesai">Tanggal Selesai:</label>
                                            <input type="date" class="form-control" name="tanggal_selesai" required>
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-dark btn-card">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card bg-light shadow-lg">
                        <div class="card-header">
                            <center><h4 class="card-title">Laporan</h4></center>
                            <?php
                            if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($tanggal_mulai) && isset($tanggal_selesai)) {
                                $url = "print.php?tanggal_mulai=" . urlencode($tanggal_mulai) . "&tanggal_selesai=" . urlencode($tanggal_selesai);
                                echo '<a href="' . $url . '" target="_blank"><button type="button" class="btn btn-primary">Cetak Laporan</button></a>';
                            }
                            ?>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-responsive-sm overflow-hidden">
                                <table id="example" class="table table-bordered ">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th class="text-white">No. </th>
                                            <th class="text-white">Tanggal</th>
                                            <th class="text-white">Jumlah Motor</th>
                                            <th class="text-white">Jumlah Mobil</th>
                                            <th class="text-white">Jumlah Truk</th>
                                            <th class="text-white">Total Kendaraan</th>
                                            <th class="text-white">Total Pemasukan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($_SERVER['REQUEST_METHOD'] === "POST") { ?>
                                            <?php $i = 1; ?>
                                            <?php foreach ($parkir_keluar as $row) : ?>
                                                <tr>
                                                    <td class="text-dark"><?= $i; ?></td>
                                                    <td class="text-dark"><?= $row["tanggal_masuk"] ?></td>
                                                    <td class="text-dark"><?= $row["jumlah_motor"]; ?></td>
                                                    <td class="text-dark"><?= $row["jumlah_mobil"]; ?></td>
                                                    <td class="text-dark"><?= $row["jumlah_truk"]; ?></td>
                                                    <td class="text-dark"><?= $row["jumlah_data"]; ?></td>
                                                    <td class="text-dark"><?= $row["total_pemasukan"]; ?></td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--**********************************
            Content body end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>


</body>

</html>