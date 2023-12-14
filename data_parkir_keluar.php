<?php
session_start();
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
require "parkir-keluar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script type="text/javascript" src="js/adapter.min.js"></script>
    <script type="text/javascript" src="js/vue.min.js"></script>
    <script type="text/javascript" src="js/instascan.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <title>Data Parkir Keluar</title>
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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Data Parkir</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Parkir Masuk</a></li>
                        </ol>
                    </div>
                </div>
                <div class="cols">
                    <!-- Form Parkir Keluuar -->
                    <form method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card text-white bg-success">
                                    <div class="card-header">
                                        <h5 class="card-title text-white">Masukkan Angka Kode Karcis</h5>
                                    </div>
                                    <div class="card-body mb-0">
                                        <div class="basic-form">
                                            <form>
                                                <div class="form-group">
                                                    <input type="text" name="id_karcis" id="id_karcis" class="form-control input-default" placeholder="Kode Karcis">
                                                </div>
                                                <button type="submit" name="submit" class="btn btn-dark btn-card">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card bg-light shadow-lg">
                                    <div class="card-header bg-primary d-flex justify-content-center align-items-center">
                                        <h5 class="card-title m-0 text-white ">Barcode Scanner</h5>
                                    </div>
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <div class="embed-responsive embed-responsive-16by9 w-75 bg-dark">
                                            <video id="preview" class="embed-responsive-item" style="max-width: 100%; height: auto;"></video>
                                        </div>
                                        <form action="" method="post" class="form-horizontal mt-3">
                                            <input type="text" name="barcode" id="barcode" hidden placeholder="Scan QR code" class="form-control">
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                    <div class="card border shadow-lg">
                        <div class="card-header">
                            <h4 class="card-title">Tabel Parkir Keluar</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- Tabel -->
                                <table class="table table-bordered table-striped verticle-middle table-responsive-sm text-dark ">
                                    <thead>
                                        <tr>
                                            <th scope="col">No. </th>
                                            <th scope="col">ID Karcis</th>
                                            <th scope="col">No. Plat</th>
                                            <th scope="col">Tanggal / Jam Masuk </th>
                                            <th scope="col">Tanggal / Jam Keluar</th>
                                            <th scope="col">Jenis Kendaraan</th>
                                            <th scope="col">Lama Parkir (Jam)</th>
                                            <th scope="col">Tarif</th>
                                            <th scope="col">Total Bayar</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($parkir_keluar as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= 'KC-' . $row["id_karcis"]; ?></td>
                                                <td><?= $row["no_plat"]; ?></td>
                                                <td><?= $row["tanggal_jam_masuk"]; ?></td>
                                                <td><?= $row["tanggal_jam_keluar"]; ?></td>
                                                <td><?= $row["jenis_kendaraan"]; ?></td>
                                                <td><?= $row["lama_parkir"]; ?></td>
                                                <td><?= $row["tarif"]; ?></td>
                                                <td><?= $row["total_bayar"]; ?></td>
                                                <td>
                                                    <span>
                                                        <a href="ubah_parkir_keluar.php?id_karcis=<?= $row["id_karcis"]; ?>" class="mr-4" data-toggle="tooltip" data-placement="top" title="Ubah">
                                                            <i class="fa fa-pencil fa-lg color-muted"></i>
                                                        </a>
                                                        <a href="hapus.php?id=<?= $row["id_karcis"]; ?>&fungsi=parkir_keluar" onclick="return confirm('Hapus data?')" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                            <i class="fa fa-close fa-lg color-danger"></i>
                                                        </a>
                                                    </span>
                                                </td>

                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
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

    <script>
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert('No cameras found');
            }

        }).catch(function(e) {
            console.error(e);
        });

        scanner.addListener('scan', function(c) {
            document.getElementById('barcode').value = c;
            document.forms[0].submit();
        });
    </script>


</body>

</html>