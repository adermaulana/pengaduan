<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
include '../koneksi.php';

$query = mysqli_query($koneksi, "SELECT email FROM pengaduan WHERE id = '$_GET[id]'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data pengaduan tidak ditemukan.'); window.location.href='pengaduan.php';</script>";
    exit;
}


$email = $data['email'];
$subject = "Informasi Pengaduan Kecamatan XX";  // Specify a subject for clarity
$content = "<p>Pengaduan Anda telah dikonfirmasi. Terima kasih atas partisipasi Anda.</p>";

try {
    $mail = new PHPMailer(true);
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'pengaduan465@gmail.com';
    $mail->Password   = 'magg mlzo zgcs onma';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Recipients
    $mail->setFrom('pengaduan465@gmail.com', 'Pengaduan Kecamatan XX');
    $mail->addAddress($email);

    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $content;

    $mail->send();

    // Update the database record status after successful email send
    $konfirmasi = mysqli_query($koneksi, "UPDATE pengaduan SET status = 'Dikonfirmasi' WHERE id = '$_GET[id]'");

    if ($konfirmasi) {
        echo "<script>alert('Data berhasil dikonfirmasi dan email berhasil dikirim!'); window.location.href='pengaduan.php';</script>";
    } else {
        echo "<script>alert('Data berhasil dikonfirmasi tetapi gagal mengupdate status di database.');</script>";
    }

} catch (Exception $e) {
    echo "Pesan gagal dikirim. Error: {$mail->ErrorInfo}";
}
?>
