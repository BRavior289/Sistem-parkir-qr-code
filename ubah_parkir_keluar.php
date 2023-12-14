<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
include 'functions.php';
$id_karcis = $_GET["id_karcis"];
$data_parkir_keluar = query("SELECT * FROM data_parkir_keluar WHERE id_karcis = '$id_karcis'")[0];

function ubah($data)
{
    global $conn;
    $id_karcis = $data["id_karcis"];

    $tanggal_jam_masuk = ($data['tanggal_jam_masuk']);
    $tanggal_jam_keluar = ($data['tanggal_jam_keluar']);
    $tanggal_jam_sekarang = date("Y-m-d H:i:s");

    // Validasi: pastikan tanggal dan waktu masuk tidak lebih besar dari tanggal dan waktu keluar
    if (strtotime($tanggal_jam_masuk) > strtotime($tanggal_jam_keluar)) {
        echo "
        <script>
            alert('Tanggal/waktu masuk tidak boleh diatas tanggal/waktu keluar');
        </script>
        ";
        return 0; // Keluar dari fungsi dengan nilai 0
    } elseif (strtotime($tanggal_jam_keluar) > strtotime($tanggal_jam_sekarang)) {
        echo "
        <script>
            alert('Tanggal/waktu keluar tidak boleh diatas tanggal/waktu saat ini.');
        </script>
        ";
        return 0; // Keluar dari fungsi dengan nilai 0
    }

    $jenis_kendaraan = ($data['jenis_kendaraan']);
    $no_plat = htmlspecialchars($data['no_plat']);
    // Tarif
    $data_tarif = query("SELECT tarif FROM data_jenis_kendaraan WHERE jenis_kendaraan = '$jenis_kendaraan'")[0];
    $tarif = $data_tarif['tarif'];

    $lama_parkir = abs(strtotime($tanggal_jam_keluar) - strtotime($tanggal_jam_masuk));
    $lama_parkir = ($lama_parkir <= 0) ? 1 : ceil($lama_parkir / 3600);

    // Hitung total bayar
    $total_bayar = $lama_parkir * $tarif;
    $query = "UPDATE data_parkir_keluar SET 
    tanggal_jam_masuk='$tanggal_jam_masuk',  tanggal_jam_keluar='$tanggal_jam_keluar', jenis_kendaraan='$jenis_kendaraan', no_plat='$no_plat' ,
    tarif='$tarif', lama_parkir='$lama_parkir', total_bayar='$total_bayar'
    WHERE id_karcis='$id_karcis' ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil diubah');
                document.location.href = 'data_parkir_keluar.php';
            </script>
            ";
    } else {
        echo "
            <script>
            alert('Gagal!!');
            document.location.href = 'data_parkir_keluar.php';
            </script>
            ";
    }
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
    <style>
        /* Add this style to your existing styles or in a separate CSS file */
        .form-group input,
        .form-group select {
            border: 1px solid #ccc;
            /* You can customize the border color and style */
            border-radius: 4px;
            /* Optional: Add rounded corners to the border */
        }
    </style>

</head>

<body>
    <?php echo var_dump($_POST["submit"]); ?>

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
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-chart-bar-33"></i><span class="nav-text">Data Master</span></a>
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
                            <li class="breadcrumb-item"><a href="data_parkir_keluar.php">Parkir Keluar</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Ubah Data</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Form Ubah Data Parkir Keluar</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form form-vertical" method="post">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group col-4">
                                                        <label for="id_karcis">ID Karcis</label>
                                                        <input type="text" name="" readonly value="<?php echo 'KC-' . $data_parkir_keluar["id_karcis"] ?>" class="form-control" placeholder="" readonly>
                                                        <input type="text" id="id_karcis" name="id_karcis" class="form-control" placeholder="" value="<?php echo $data_parkir_keluar["id_karcis"] ?>" hidden>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group col-md-5">
                                                        <label for="tanggal_jam_masuk">Tanggal Masuk</label>
                                                        <input type="datetime-local" id="tanggal_jam_masuk" class="form-control" name="tanggal_jam_masuk" placeholder="tanggal_jam_masuk" value="<?php echo $data_parkir_keluar["tanggal_jam_masuk"] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group col-md-5">
                                                        <label for="tanggal_jam_keluar">Tanggal Keluar</label>
                                                        <input type="datetime-local" id="tanggal_jam_keluar" class="form-control" name="tanggal_jam_keluar" placeholder="tanggal_jam_keluar" value="<?php echo $data_parkir_keluar["tanggal_jam_keluar"] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group col-md-4">
                                                        <label for="jenis_kendaraan">Jenis Kendaraan</label>
                                                        <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-control">
                                                            <?php
                                                            $jenis_kendaraan = query("SELECT jenis_kendaraan FROM data_jenis_kendaraan");
                                                            foreach ($jenis_kendaraan as $row) {
                                                                echo '<option value="' . $row['jenis_kendaraan'] . '">' . $row['jenis_kendaraan'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group col-4">
                                                    <label for="no_plat">No. Plat</label>
                                                    <input type="text" id="no_plat" class="form-control" name="no_plat" placeholder="no_plat" value="<?php echo $data_parkir_keluar["no_plat"] ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" name="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <select name="jenis_kendaraan" id="jenis_kendaraan">
        <?php
        $jenis_kendaraan = query("SELECT jenis_kendaraan FROM data_jenis_kendaraan");
        foreach ($jenis_kendaraan as $row) {
            echo '<option value="' . $row['jenis_kendaraan'] . '">' . $row['jenis_kendaraan'] . '</option>';
        }
        ?>
    </select>

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


</body>

</html>