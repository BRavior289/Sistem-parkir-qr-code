<?php
session_start();
include "functions.php";
// cek cookies
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username db berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = '$id'");
    // masukkan ke $row
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan hash(username db)
    if ($key === $row['username']) {
        $_SESSION["login"] = true;
    }
}

// Supaya yg sudah login tidak bisa mengakses login.php lagi
if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // cek Username
    $result = mysqli_query($conn, "SELECT * FROM data_admin WHERE username = '$username'");

    // apakah ada nilai yg dikembalikan dari query result
    if (mysqli_num_rows($result) === 1) {

        // didalam $result sudah ada id,username,password
        $row = mysqli_fetch_assoc($result);
        if ($password === $row["password"]) {

            $_SESSION["login"] = true;

            if (isset($_POST['remember'])) {
                // supaya COOKIES tidak bisa diprediksi dan dibuat manual di browser
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', $row['username'], time() + 60);  
            }

            header("Location: index.php");
            exit;
        }
    }
    // menampilkan pesan salah password
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login Admin</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="./css/style.css" rel="stylesheet">

</head>

<body class="h-100" style="background-image: url('images/a.jpg'); background-size: cover; background-repeat: no-repeat; height: 100vh;">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-4 ">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xxl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Sign in</h4>
                                    <?php if (isset($error)) : ?>
                                        <p style="color: red;">Username / Password Salah</p>
                                    <?php endif; ?>
                                    <form action="" method="post">
                                        <div class="form-group ">
                                            <!-- <label><strong>Username</strong></label> -->
                                            <input type="text" autocomplete="off" class="form-control" placeholder="Masukkan Username" name="username" id="username" required>
                                        </div>
                                        <div class="form-group">
                                            <!-- <label><strong>Password</strong></label> -->
                                            <input type="password" autocomplete="off" class="form-control" placeholder="Password" name="password" id="password" required>
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <div class="form-check ml-2">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                                    <label class="form-check-label" for="remember">Remember me</label>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <a href="page-forgot-password.html">Forgot Password?</a>
                                            </div> -->
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block" name="login">Sign in</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-primary" href="registrasi.php">Sign up</a></p>
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

</body>

</html>