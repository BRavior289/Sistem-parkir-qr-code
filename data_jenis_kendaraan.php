<?php

session_start();
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';

function hapus_jenis_kendaraan($id)
{
    global $conn;
    $query = "DELETE FROM data_jenis_kendaraan WHERE id_jenis_kendaraan = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

$jenis_kendaraan = query("SELECT * FROM data_jenis_kendaraan");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Data Admin</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Datatable -->
    <link href="./vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
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
                            <span class="ml-1">Datatable</span>
                        </div> -->
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Data Master</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Data Jenis Kendaraan</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-light shadow-lg">
                            <div class="card-header">
                                <h4 class="card-title">Tabel Jenis Kendaraan</h4>
                                <a href="tambah-data/tambah-admin.php"><button type="button" href="tambah-data/tambah-admin.php" class="btn btn-primary">Tambah Data</button></a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table">
                                        <thead class="thead-primary">
                                            <tr>
                                                <th class="text-white">No.</th>
                                                <th class="text-white">ID Jenis Kendaraan</th>
                                                <th class="text-white">Jenis Kendaraan</th>
                                                <th class="text-white">Tarif</th>
                                                <th class="text-white">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($jenis_kendaraan as $i => $row) : ?>
                                                <tr>
                                                    <td class="text-dark"><?= $i + 1; ?></td>
                                                    <td class="text-dark"><?= 'JK' . sprintf('%03s', $row["id_jenis_kendaraan"]); ?></td>
                                                    <td class="text-dark"><?= $row["jenis_kendaraan"]; ?></td>
                                                    <td class="text-dark">Rp <?= number_format($row["tarif"], 0, ',', '.'); ?></td>
                                                    <td class="text-dark">
                                                        <a href="ubah_jenis_kendaraan.php?id_jenis_kendaraan=<?= $row["id_jenis_kendaraan"]; ?>">Ubah</a>
                                                        <a href="hapus.php?id=<?= $row["id_jenis_kendaraan"]; ?>&fungsi=jenis_kendaraan" onclick="return confirm('Hapus data?')">Hapus</a>
                                                    </td>
                                                </tr>

                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
    <!--**********************************
            Content body end
        ***********************************-->


    <!--**********************************
            Footer start
        ***********************************-->
    <!-- <div class="footer">
        <div class="copyright">
            <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Quixkit</a> 2019</p>
        </div>
    </div> -->
    <!--**********************************
            Footer end
        ***********************************-->

    <!--**********************************
           Support ticket button start
        ***********************************-->

    <!--**********************************
           Support ticket button end
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



    <!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>

</body>

</html>