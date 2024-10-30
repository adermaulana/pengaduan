<?php

include 'koneksi.php';


if (isset($_POST['simpan'])) {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $id_kategori = $_POST['id_kategori'];
    $isi_pengaduan = $_POST['isi_pengaduan'];
    $alamat = $_POST['alamat'];
    $status = 'Belum Dikonfirmasi';
    $tanggal = date('Y-m-d H:i:s');

    // Cek apakah NIK terdaftar di tabel data_masyarakat
    $cek_nik = mysqli_query($koneksi, "SELECT * FROM data_masyarakat WHERE nik = '$nik'");
    $jumlah_data = mysqli_num_rows($cek_nik);

    if ($jumlah_data > 0) {
        // Jika NIK terdaftar, lanjutkan penyimpanan
        $simpan = mysqli_query($koneksi, "INSERT INTO pengaduan (nama, nik,email, telepon,alamat, id_kategori, isi_pengaduan, status, tanggal) 
        VALUES ('$nama', '$nik','$email', '$telepon','$alamat', '$id_kategori', '$isi_pengaduan', '$status', '$tanggal')");

        // Cek apakah penyimpanan berhasil
        if ($simpan) {
            echo "<script>
                    alert('Berhasil mengirim pengaduan, silahkan cek email dalam jangka waktu 1 minggu untuk infonya!');
                    document.location='pengaduan.php';
                </script>";
        } else {
            echo "<script>
                    alert('Gagal!');
                    document.location='pengaduan.php';
                </script>";
        }
    } else {
        // Jika NIK tidak terdaftar, tampilkan pesan error
        echo "<script>
                alert('NIK Anda tidak terdaftar di kecamatan XX!');
                document.location='pengaduan.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Pengaduan Masyarakat</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="assets/home/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/home/lib/animate/animate.min.css" rel="stylesheet">
    <link href="assets/home/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/home/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/home/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/home/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-light d-none d-lg-block">
        <div class="row align-items-center top-bar">
            <div class="col-lg-3 col-md-12 text-center text-lg-start">
                <a href="" class="navbar-brand m-0 p-0">
                    <h1 class="text-primary m-0">Pengaduan Masyarakat</h1>
                </a>
            </div>
            <div class="col-lg-9 col-md-12 text-end">
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <i class="fa fa-map-marker-alt text-primary me-2"></i>
                    <p class="m-0">Jalanan XX, Makassar, Indonesia</p>
                </div>
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <i class="far fa-envelope-open text-primary me-2"></i>
                    <p class="m-0">pengaduan@example.com</p>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-0" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid nav-bar bg-light">
        <nav class="navbar navbar-expand-lg navbar-light bg-white p-3 py-lg-0 px-lg-4">
            <a href="" class="navbar-brand d-flex align-items-center m-0 p-0 d-lg-none">
                <h1 class="text-primary m-0">Pengaduan Masyarakat</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav me-auto">
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    <a href="pengaduan.php" class="nav-item nav-link">Lapor Pengaduan</a>
                    <a href="lihatpengaduan.php" class="nav-item nav-link">Lihat Pengaduan</a>
                    <a href="carakerja.php" class="nav-item nav-link">Cara Kerja</a>
                    <a href="kontak.php" class="nav-item nav-link">Kontak</a>
                    <a href="login.php" class="nav-item nav-link">Login</a>
                </div>
                <div class="mt-4 mt-lg-0 me-lg-n4 py-3 px-4 bg-primary d-flex align-items-center">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white" style="width: 45px; height: 45px;">
                        <i class="fa fa-phone-alt text-primary"></i>
                    </div>
                    <div class="ms-3">
                        <p class="mb-1 text-white">Emergency 24/7</p>
                        <h5 class="m-0 text-secondary">+012 345 6789</h5>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 py-5">
        <div class="container">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Buat Laporan Pengaduan</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-4">Laporan Pengaduan</h1>
                    <p class="mb-4"> 
                        <span class="text-danger">
                            Pastikan NIK (Nomor Induk Kependudukan) anda terdaftar di kecamatan XX dan pastikan memasukkan email yang valid 
                        </span> 
                        agar bisa melakukan pengaduan pada website pengaduan kecamatan XX
                    </p>
                    <div class="mt-4 mt-lg-0 me-lg-n4 py-3 px-4 bg-primary d-flex align-items-center">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white" style="width: 45px; height: 45px;">
                            <i class="fa fa-phone-alt text-primary"></i>
                        </div>
                        <div class="ms-3">
                            <p class="mb-1 text-white">Kontak 24/7</p>
                            <h5 class="m-0 text-secondary">+62 853 6789</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-light p-5 h-100 d-flex align-items-center">
                        <form method="POST">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="nama" id="nama"  placeholder="Nama Anda" required>
                                        <label for="name">Nama</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK Anda" required>
                                        <label for="nik">NIK</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email valid" required>
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="telepon" name="telepon" placeholder="Telepon" required>
                                        <label for="subject">No. Telepon</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Alamat" name="alamat" id="alamat" style="height: 150px" required></textarea>
                                        <label for="alamat">Alamat</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <select class="form-select" id="id_kategori" name="id_kategori" aria-label="Kategori Pengaduan" required>
                                            <option selected disabled>Pilih</option>
                                            <?php
                                                $no = 1;
                                                $tampil = mysqli_query($koneksi, "SELECT * FROM kategori");
                                                while($data = mysqli_fetch_array($tampil)):
                                            ?>
                                            <option value="<?= $data['id'] ?>"><?= $data['nama'] ?></option>
                                            <?php
                                                endwhile; 
                                            ?>
                                        </select>
                                        <label for="kategori_pengaduan">Kategori Pengaduan</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Isi Pengaduan" name="isi_pengaduan" id="isi_pengaduan" style="height: 150px" required></textarea>
                                        <label for="laporan">Isi Pengaduan</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit" name="simpan">Kirim Pengaduan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>       

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-light mb-4">Alamat</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Jalanan XX, Makassar, Indonesia</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+62 853 6789</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>pengaduan@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-light mb-4">Pelayanan</h4>
                    <h6 class="text-light">Senin - Jumat:</h6>
                    <p class="mb-4">09.00 WITA - 17.00 WITA</p>
                    <h6 class="text-light">Sabtu - Minggu:</h6>
                    <p class="mb-0">09.00 WITA - 15.00 WITA</p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-light mb-4">Newsletter</h4>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a href="https://themewagon.com">ThemeWagon</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/home/lib/wow/wow.min.js"></script>
    <script src="assets/home/lib/easing/easing.min.js"></script>
    <script src="assets/home/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/home/lib/counterup/counterup.min.js"></script>
    <script src="assets/home/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="assets/home/lib/tempusdominus/js/moment.min.js"></script>
    <script src="assets/home/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="assets/home/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="assets/home/js/main.js"></script>
</body>

</html>