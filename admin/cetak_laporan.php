<?php
require '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pengaduan</title>
    <link href="../assets/css/app.css" rel="stylesheet">
   
    <style>
        @media print {
            .no-print {
                display: none;
            }
            body {
                margin: 2cm;
            }
        }
        
        .kop-surat {
            border-bottom: 3px solid #000;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .kop-surat h3,
        .kop-surat h4,
        .kop-surat h5 {
            margin: 0;
            text-align: center;
        }
        
        .kop-surat img {
            height: 80px;
            position: absolute;
            left: 50px;
            top: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .header h5 {
            text-decoration: underline;
            margin-bottom: 10px;
        }
        
        .table {
            border: 1px solid #000;
            margin-bottom: 40px;
        }
        
        .table th,
        .table td {
            padding: 8px;
            border: 1px solid #000;
            font-size: 12px;
        }
        
        .table th {
            background-color: #f8f9fa;
            text-align: center;
            vertical-align: middle;
        }
        
        .ttd-section {
            float: right;
            width: 300px;
            text-align: center;
        }
        
        .clear {
            clear: both;
        }
        
        .info-section {
            margin-bottom: 20px;
        }
        
        .page-number {
            position: fixed;
            bottom: 20px;
            right: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <button onclick="window.print()" class="btn btn-primary mb-3 no-print">Cetak Laporan</button>

        <!-- Kop Surat -->
        <div class="kop-surat">
            <img src="../assets/img/logo.png" alt="Logo" class="logo">
            <h4>KECAMATAN XX</h4>
            <h5>Alamat: Jalanan XX, Makassar, Indonesia</h5>
            <h5>Email: pengaduan@example.com Telp: (021) 12345678</h5>
        </div>

        <!-- Header Laporan -->
        <div class="header">
            <h5>LAPORAN PENGADUAN MASYARAKAT</h5>
            <?php if (isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_akhir'])): ?>
            <p>Periode: <?= date('d F Y', strtotime($_GET['tanggal_mulai'])) ?> - 
                       <?= date('d F Y', strtotime($_GET['tanggal_akhir'])) ?></p>
            <?php else: ?>
            <p>Periode: Semua</p>
            <?php endif; ?>
        </div>

        <!-- Info Section -->
        <div class="info-section">
            <p>Berikut ini adalah laporan pengaduan masyarakat yang telah diterima dan diproses oleh pemerintah desa:</p>
        </div>

        <!-- Tabel Laporan -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="15%">Nama Warga</th>
                    <th width="13%">NIK</th>
                    <th width="12%">Tanggal</th>
                    <th width="15%">Kategori</th>
                    <th width="25%">Isi Pengaduan</th>
                    <th width="15%">Status</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $no = 1;
                $query = "SELECT pengaduan.*, kategori.nama as nama_kategori 
                         FROM pengaduan 
                         JOIN kategori ON pengaduan.id_kategori = kategori.id";
                
                if (isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_akhir']) && 
                    $_GET['tanggal_mulai'] != '' && $_GET['tanggal_akhir'] != '') {
                    $tanggal_mulai = mysqli_real_escape_string($koneksi, $_GET['tanggal_mulai']);
                    $tanggal_akhir = mysqli_real_escape_string($koneksi, $_GET['tanggal_akhir']);
                    $query .= " WHERE tanggal BETWEEN '$tanggal_mulai' AND '$tanggal_akhir'";
                }
                
                $query .= " ORDER BY id DESC";
                $tampil = mysqli_query($koneksi, $query);
                
                while($data = mysqli_fetch_array($tampil)):
            ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['nik'] ?></td>
                    <td><?= date('d/m/Y', strtotime($data['tanggal'])) ?></td>
                    <td><?= $data['nama_kategori'] ?></td>
                    <td><?= $data['isi_pengaduan'] ?></td>
                    <td class="text-center"><?= $data['status'] ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Ringkasan -->
        <div class="summary mb-5">
            <p><strong>Total Pengaduan:</strong> <?= $no - 1 ?> pengaduan</p>
        </div>

        <div class="clear"></div>

        <!-- Nomor Halaman -->
        <div class="page-number">
            Halaman 1
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>