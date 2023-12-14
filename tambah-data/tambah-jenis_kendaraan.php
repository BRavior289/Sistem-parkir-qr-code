<?php
require '../functions.php';
function tambah($data){
    global $conn;
    $jenis_kendaraan = htmlspecialchars($data['jenis_kendaraan']);

    // Validasi tarif: memastikan hanya angka bulat yang diizinkan
    $tarif = filter_var($data['tarif'], FILTER_VALIDATE_INT);
    if ($tarif === false) {
        echo "
        <script>
            alert('Tarif harus berupa angka bulat');
        </script>
        ";
        return 0; // Keluar dari fungsi dengan nilai 0
    }
    $query = "INSERT INTO data_jenis_kendaraan VALUES ('', '$jenis_kendaraan', '$tarif')";
    mysqli_query($conn, $query);

    $result = mysqli_affected_rows($conn);
    return $result;
}

if (isset($_POST["submit"])) {
    if (tambah($_POST) > 0) {
        // panggil fungsi tambah sekaligus cek apakah > 0
        echo "
        <script>
            alert('Data berhasil dimasukkan')
            document.location.href = '../data_jenis_kendaraan.php';
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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Data Parkir Masuk</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon.png">
    <link href="../css/style.css" rel="stylesheet">

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
            <a href="../dashboard.php" class="brand-logo">
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
                                    <a href="../app-profile.html" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="../page-login.html" class="dropdown-item">
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
                    <li><a aria-expanded="false" href="../dashboard.php">
                            <i class="icon icon-single-04"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-label first">Data Master</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-chart-bar-33"></i><span class="nav-text">Data Master</span></a>
                        <ul aria-expanded="false">
                            <li><a href="../data_admin.php">Data Admin</a></li>
                            <li><a href="../data_jenis_kendaraan.php">Jenis Kendaraan</a></li>
                        </ul>
                    </li>

                    <li class="nav-label first">Tabel Parkir</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-chart-bar-33"></i><span class="nav-text">Data Parkir</span></a>
                        <ul aria-expanded="false">
                            <li><a href="../data_parkir_masuk.php">Parkir Masuk</a></li>
                            <li><a href="../data_parkir_keluar.php">Parkir Keluar</a></li>
                        </ul>
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
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>
                            <span class="ml-1">Card</span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Bootstrap</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Card</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Form Tambah Data Jenis Kendaraan</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form form-vertical" method="post" >
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="jenis_kendaraan">Jenis Kendaraan</label>
                                                        <input type="text" id="jenis_kendaraan" name="jenis_kendaraan" class="form-control col-4"
                                                            placeholder="Jenis Kendaraan">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="tarif">Tarif</label>
                                                        <input type="number" id="tarif"
                                                            class="form-control col-4" name="tarif" placeholder="Tarif" >
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" name="submit"
                                                        class="btn btn-primary me-1 mb-1">Submit</button>
                                                    <button type="reset" 
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
    <script src="../vendor/global/global.min.js"></script>
    <script src="../js/quixnav-init.js"></script>
    <script src="../js/custom.min.js"></script>


</body>

</html>