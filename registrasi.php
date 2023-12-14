<?php
include "functions.php";
function tambah($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);

    $query = "INSERT INTO data_admin VALUES ('', '$nama', '$email', '$username', '$password')";
    // lakukan query sql
    mysqli_query($conn, $query);

    $result = mysqli_affected_rows($conn);
    return $result;
}
if (isset($_POST["signup"])) {
    if (tambah($_POST) > 0) {
        echo "
        <script>
            alert('Data berhasil dimasukkan')
            document.location.href = 'dashboard.php'
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
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Registrasi </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="./vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

</head>

<body class="h-100" style="background-image: url('images/a.jpg'); background-size: cover; background-repeat: no-repeat; height: 100vh;">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-5">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Registrasi Admin</h4>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label><strong class="text-muted">Nama</strong></label>
                                            <input type="text" class="form-control" name="nama" id="nama">
                                        </div>
                                        <div class="form-group">
                                            <label><strong class="text-muted">Email</strong></label>
                                            <input type="email" class="form-control" name="email" id="email">
                                        </div>
                                        <div class="form-group">
                                            <label><strong class="text-muted">Username</strong></label>
                                            <input type="text" class="form-control" name="username" id="username">
                                        </div>
                                        <div class="form-group">
                                            <label><strong class="text-muted">Password</strong></label>
                                            <input type="password" class="form-control" name="password" id="password">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <!-- <a href="page-forgot-password.html">Forgot Password?</a> -->
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block" name="signup">Register</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>already have an account? <a class="text-primary" href="index.php">Sign in</a></p>
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
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>


    <script src="./vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="./js/plugins-init/sweetalert-init.js"></script>

</body>

</html>