<?php

    include 'koneksi.php';

    session_start();

    if(isset($_SESSION['status']) == 'login'){

        header("location:admin");
    }

    if(isset($_POST['login'])){

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $login = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' and password='$password'");
        $cek = mysqli_num_rows($login);

        if($cek > 0) {
            $admin_data = mysqli_fetch_assoc($login);
            $_SESSION['id_admin'] = $admin_data['id'];
            $_SESSION['nama_admin'] = $admin_data['nama'];
            $_SESSION['username_admin'] = $username;
            $_SESSION['status'] = "login";
            header('location:admin');

        }  else {
            echo "<script>
            alert('Login Gagal, Periksa Username dan Password Anda!');
            header('location:login.php');
                 </script>";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/login/css/bootstrap.min.css">

    <style>

    .gradient-custom-2 {
    /* fallback for old browsers */
    background: #fccb90;

    /* Chrome 10-25, Safari 5.1-6 */
    background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
    }

    @media (min-width: 768px) {
    .gradient-form {
    height: 100vh !important;
    }
    }
    @media (min-width: 769px) {
    .gradient-custom-2 {
    border-top-right-radius: .3rem;
    border-bottom-right-radius: .3rem;
    }
    }

    </style>

</head>
<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
            <div class="card rounded-3 text-black">
            <div class="row g-0">
                <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">

                    <div class="text-center">

                    <h4 class="mt-1 mb-5 pb-1">Login</h4>
                    </div>

                    <form method="POST">
                    <p>Please login to your account</p>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example11">Username</label>
                        <input type="text" id="username" name="username" class="form-control"
                        placeholder="username" />
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example22">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="password" />
                    </div>

                    <div class="text-center pt-1 mb-5 pb-1">
                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" name="login">Log
                        in</button>
                        
                    </div>

                    </form>

                </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                    <h4 class="mb-4"></h4>
                    <p class="small mb-0"></p>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </section>
    
    <script src="assets/login/js/bootstrap.bundle.min.js"></script>
</body>
</html>