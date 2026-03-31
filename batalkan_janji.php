<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'config/app.php';

$idUser = isset($_SESSION['idUser']) ? intval($_SESSION['idUser']) : 0;
$idKonfirmasi = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($idKonfirmasi <= 0 || $idUser <= 0) {
    header("Location: janjitemu.php?error=ID tidak valid");
    exit;
}

// Verifikasi bahwa janji milik user yang login
$checkQuery = "SELECT idKonfirmasi FROM konfirmasi_donor WHERE idKonfirmasi = '$idKonfirmasi' AND idUser = '$idUser' LIMIT 1";
$checkResult = mysqli_query($db, $checkQuery);

if (!$checkResult || mysqli_num_rows($checkResult) === 0) {
    header("Location: janjitemu.php?error=Janji tidak ditemukan atau tidak milik Anda");
    exit;
}

// Delete atau update status menjadi Dibatalkan
$deleteQuery = "DELETE FROM konfirmasi_donor WHERE idKonfirmasi = '$idKonfirmasi' AND idUser = '$idUser'";

if (mysqli_query($db, $deleteQuery)) {
    header("Location: janjitemu.php?sukses=Janji temu berhasil dibatalkan");
    exit;
} else {
    header("Location: janjitemu.php?error=Gagal membatalkan janji: " . mysqli_error($db));
    exit;
}
?>
