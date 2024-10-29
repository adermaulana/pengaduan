<?php

include '../koneksi.php';

    $konfirmasi = mysqli_query($koneksi, "UPDATE pengaduan SET status = 'Dikonfirmasi' WHERE id = '$_GET[id]'");

    if ($konfirmasi) {
        echo "<script>
            alert('Data berhasil dikonfirmasi!');
            document.location='pengaduan.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal mengkonfirmasi data!');
        </script>";
    }

?>