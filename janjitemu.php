<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
include 'config/app.php';

$idUser = isset($_SESSION['idUser']) ? intval($_SESSION['idUser']) : 0;

$activeAppointments = [];
$historyAppointments = [];

if ($idUser > 0) {
    $resultActive = mysqli_query($db, "SELECT * FROM konfirmasi_donor WHERE idUser = '$idUser' AND status = 'Terkonfirmasi' ORDER BY createdAt DESC");
    if ($resultActive) {
        while ($row = mysqli_fetch_assoc($resultActive)) {
            $activeAppointments[] = $row;
        }
    }

    $resultHistory = mysqli_query($db, "SELECT * FROM konfirmasi_donor WHERE idUser = '$idUser' AND status != 'Terkonfirmasi' ORDER BY createdAt DESC");
    if ($resultHistory) {
        while ($row = mysqli_fetch_assoc($resultHistory)) {
            $historyAppointments[] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Janji Temu Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .nav-tabs .nav-link { color: #555; }
        .nav-tabs .nav-link.active { color: #c81000; font-weight: bold; border-bottom: 3px solid #c81000; }
        .status-badge { font-size: 0.8rem; padding: 5px 10px; border-radius: 20px; }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top border-bottom">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="#">Donasi Darah</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="ms-auto d-flex align-items-center">
            <a href="dashboard.php" class="nav-link text-danger me-3">Dashboard</a>
                
                <?php if (isset($_SESSION['login'])): ?>
                    <a href="profil-user.php" class="btn btn-outline-secondary me-2">Profil Saya</a>
                    <a href="logout.php" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin Logout?');">Logout</a>
                <?php else: ?>
                     <a href="login.php" class="btn btn-outline-secondary">Sign in</a>
                     <a href="register.php" class="btn btn-dark">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#aktif">Aktif</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#riwayat">Riwayat</a>
        </li>
    </ul>

    <?php if (isset($_GET['sukses'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_GET['sukses']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_GET['error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="tab-content">
        
       <div class="tab-pane fade show active" id="aktif">
            <div class="row justify-content-center mt-4">
                <div class="col-lg-7">
                    <?php if (count($activeAppointments) === 0): ?>
                        <div class="alert alert-info">Belum ada janji aktif. Silakan buat janji di halaman penjadwalan.</div>
                    <?php else: ?>
                        <?php foreach ($activeAppointments as $appointment): ?>
                            <div class="card p-4 shadow-sm border-0 mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="fw-bold mb-0"><?= htmlspecialchars($appointment['lokasiRS'] ?: 'Lokasi Tak Diketahui') ?></h5>
                                    <span class="badge bg-success text-white status-badge"><?= htmlspecialchars($appointment['status']) ?></span>
                                </div>

                                <p class="text-muted mb-2"><i class="bi bi-calendar-check me-2"></i><?= date('l, d F Y', strtotime($appointment['tanggalDonor'])) ?> - <?= htmlspecialchars($appointment['waktuDonor']) ?> WIB</p>
                                <p class="text-muted mb-3"><strong>Kode Tiket:</strong> <?= htmlspecialchars($appointment['kodeTiket']) ?></p>

                                <div class="d-flex gap-2">
                                    <a href="konfirmasi.php?id=<?= intval($appointment['idKonfirmasi']) ?>" class="btn btn-secondary btn-sm">Detail E-Ticket</a>
                                    <a href="batalkan_janji.php?id=<?= intval($appointment['idKonfirmasi']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin membatalkan janji temu ini?');">Batalkan Janji</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
       <div class="tab-pane fade" id="riwayat">
    <div class="row justify-content-center mt-4">
        <div class="col-lg-7">
            <?php if (count($historyAppointments) === 0): ?>
                <div class="alert alert-info">Belum ada riwayat janji temu.</div>
            <?php else: ?>
                <?php foreach ($historyAppointments as $appointment): ?>
                    <div class="card p-3 mb-3 border-0 shadow-sm" style="background-color: #f8f9fa;">
                        <div class="d-flex align-items-center">
                            <div class="me-3 fs-4 <?= $appointment['status'] === 'Selesai' ? 'text-success' : 'text-secondary' ?>">
                                <i class="bi <?= $appointment['status'] === 'Selesai' ? 'bi-check-circle-fill' : 'bi-x-circle-fill' ?>"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-bold"><?= htmlspecialchars($appointment['lokasiRS'] ?: 'Lokasi Tak Diketahui') ?></h6>
                                <small class="text-muted"><?= date('d M Y', strtotime($appointment['tanggalDonor'])) ?></small>
                            </div>
                            <span class="badge <?= $appointment['status'] === 'Selesai' ? 'bg-success' : 'bg-secondary' ?>" style="font-size: 0.7rem;"><?= htmlspecialchars($appointment['status']) ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>