<?php
session_start();
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';
// date_default_timezone_set('Asia/Makassar');

function tambah($data)
{
    global $conn;
    $tanggal_jam_masuk = date("Y-m-d H:i:s");
    $jenis_kendaraan = $data['jenis_kendaraan'];
    $no_plat = htmlspecialchars($data['no_plat']);
    $query = "INSERT INTO data_parkir_masuk VALUES ('', '$tanggal_jam_masuk', '$jenis_kendaraan', '$no_plat')";
    mysqli_query($conn, $query);

    $result = mysqli_affected_rows($conn);
    return $result;
}

if (isset($_POST["submit"])) {
    if (tambah($_POST) > 0) {
        echo "
        <script>
            alert('Data Berhasil Dimasukkan')
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data GAGAL dimasukkan !!!')
        </script>
        ";
    }
}
function hapus_parkir_masuk($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM data_parkir_masuk WHERE `data_parkir_masuk`.`id_karcis` = '$id'");
    return mysqli_affected_rows($conn);
}
$parkir_masuk = query("SELECT * FROM data_parkir_masuk");
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
                                    <a href="./app-profile.html" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
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
                    <!-- Form Parkir Masuk -->
                    <form method="post">
                        <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
                            <div class="card text-white bg-primary shadow-lg">
                                <div class="card-header">
                                    <h5 class="card-title text-white">Masukkan Data Parkir</h5>
                                </div>
                                <div class="card-body mb-0">
                                    <div class="basic-form">
                                        <div class="form-group md-4">
                                            <label>Jenis Kendaraan :</label>
                                            <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-control w-auto px-4">
                                                <?php
                                                $jenis_kendaraan = query("SELECT jenis_kendaraan FROM data_jenis_kendaraan");
                                                foreach ($jenis_kendaraan as $row) {
                                                    echo '<option value="' . $row['jenis_kendaraan'] . '">' . $row['jenis_kendaraan'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_plat">No. PLat :</label>
                                            <input type="text" name="no_plat" id="no_plat" class="form-control input-default " placeholder="">
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-dark btn-card">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card bg-light border shadow-lg">
                        <div class="card-header">
                            <h4 class="card-title">Tabel Parkir Masuk</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- Tabel -->
                                <table class="table table-bordered table-striped verticle-middle table-responsive-sm text-dark ">
                                    <thead>
                                        <tr>
                                            <th scope="col">No. </th>
                                            <th scope="col">ID Karcis</th>
                                            <th scope="col">QR Code </th>
                                            <th scope="col">Tanggal / Jam</th>
                                            <th scope="col">Jenis Kendaraan</th>
                                            <th scope="col">No. Plat</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($parkir_masuk as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= 'KC-' . $row["id_karcis"]; ?></td>
                                                <td>
                                                    <?php
                                                    $kode = $row["id_karcis"];
                                                    $file_path = "images/qrcode/" . $row["id_karcis"] . ".png";
                                                    require_once "phpqrcode/qrlib.php";
                                                    QRcode::png($kode, $file_path, "M", 5, 0);
                                                    ?>
                                                    <a href="qrcode.php?id_karcis=<?= $row["id_karcis"]; ?>" target="_blank" >
                                                        <img src="<?= $file_path; ?>" alt="<?= $row["id_karcis"] ?>.png">
                                                    </a>
                                                </td>
                                                <td><?= $row["tanggal_jam_masuk"]; ?></td>
                                                <td><?= $row["jenis_kendaraan"]; ?></td>
                                                <td><?= $row["no_plat"]; ?></td>
                                                <td>
                                                    <span>
                                                        <a href="ubah_parkir_masuk.php?id_karcis=<?= $row["id_karcis"]; ?>" class="mr-4" data-toggle="tooltip" data-placement="top" title="Ubah">
                                                            <i class="fa fa-pencil fa-lg color-muted"></i>
                                                        </a>
                                                        <a href="hapus.php?id=<?= $row["id_karcis"]; ?>&fungsi=parkir_masuk" onclick="return confirm('Hapus data?')" data-toggle="tooltip" data-placement="top" title="Hapus">
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