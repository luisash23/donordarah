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
    // 1. AMBIL DATA AKTIF (Terkonfirmasi & Pending)
    // Pending dimasukkan ke Aktif agar user bisa melihat tiket yang sedang menunggu persetujuan admin
    $resultActive = mysqli_query($db, "SELECT * FROM konfirmasi_donor WHERE idUser = '$idUser' AND status IN ('Terkonfirmasi', 'Pending') ORDER BY createdAt DESC");
    if ($resultActive) {
        while ($row = mysqli_fetch_assoc($resultActive)) {
            $activeAppointments[] = $row;
        }
    }

    // 2. AMBIL DATA RIWAYAT (Ditolak, Dibatalkan, Selesai)
    // Sekarang status 'Ditolak' akan muncul di sini
    $resultHistory = mysqli_query($db, "SELECT * FROM konfirmasi_donor WHERE idUser = '$idUser' AND status IN ('Ditolak', 'Dibatalkan', 'Selesai') ORDER BY createdAt DESC");
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
        body { background-color: #f8f9fa; }
        .nav-tabs .nav-link { color: #555; border: none; padding: 15px 25px; }
        .nav-tabs .nav-link.active { color: #dc3545; font-weight: bold; border-bottom: 3px solid #dc3545; background: none; }
        .status-badge { font-size: 0.75rem; padding: 6px 12px; border-radius: 20px; font-weight: 600; }
        .card-ticket { border-radius: 15px; transition: 0.3s; }
        .card-ticket:hover { transform: translateY(-3px); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top border-bottom shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4 text-danger" href="#"><i class="bi bi-drop-fill"></i> Donasi Darah</a>
        <div class="ms-auto d-flex align-items-center">
            <a href="dashboard.php" class="nav-link me-3">Dashboard</a>
            <a href="logout.php" class="btn btn-sm btn-outline-danger" onclick="return confirm('Logout?');">Keluar</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h3 class="fw-bold mb-4">Janji Temu Saya</h3>

    <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#aktif">Tiket Aktif</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#riwayat">Riwayat Donor</a>
        </li>
    </ul>

    <div class="tab-content pt-3">
        <div class="tab-pane fade show active" id="aktif">
            <div class="row">
                <div class="col-lg-8">
                    <?php if (empty($activeAppointments)): ?>
                        <div class="text-center py-5">
                            <i class="bi bi-calendar2-x fs-1 text-muted"></i>
                            <p class="text-muted mt-2">Tidak ada janji temu yang sedang aktif.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($activeAppointments as $appointment): ?>
                            <div class="card card-ticket p-4 shadow-sm border-0 mb-3 bg-white">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h5 class="fw-bold mb-1 text-dark"><?= htmlspecialchars($appointment['lokasiRS']) ?></h5>
                                        <span class="text-muted small"><i class="bi bi-ticket-perforated me-1"></i> <?= htmlspecialchars($appointment['kodeTiket']) ?></span>
                                    </div>
                                    <?php 
                                        $bgStatus = ($appointment['status'] == 'Terkonfirmasi') ? 'bg-success' : 'bg-warning text-dark';
                                    ?>
                                    <span class="badge <?= $bgStatus ?> status-badge"><?= strtoupper($appointment['status']) ?></span>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Tanggal</small>
                                        <span class="fw-medium"><?= date('d M Y', strtotime($appointment['tanggalDonor'])) ?></span>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Waktu</small>
                                        <span class="fw-medium"><?= htmlspecialchars($appointment['waktuDonor']) ?> WIB</span>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <a href="konfirmasi.php?id=<?= $appointment['idKonfirmasi'] ?>" class="btn btn-danger btn-sm px-3">Lihat E-Ticket</a>
                                    <?php if($appointment['status'] == 'Pending'): ?>
                                        <a href="batalkan_janji.php?id=<?= $appointment['idKonfirmasi'] ?>" class="btn btn-light btn-sm text-danger" onclick="return confirm('Batalkan pengajuan ini?');">Batalkan</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="riwayat">
            <div class="row">
                <div class="col-lg-8">
                    <?php if (empty($historyAppointments)): ?>
                        <div class="text-center py-5">
                            <i class="bi bi-clock-history fs-1 text-muted"></i>
                            <p class="text-muted mt-2">Riwayat masih kosong.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($historyAppointments as $appointment): ?>
                            <div class="card p-3 mb-2 border-0 shadow-sm">
                                <div class="d-flex align-items-center">
                                    <div class="me-3 fs-4">
                                        <?php if($appointment['status'] == 'Selesai'): ?>
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        <?php elseif($appointment['status'] == 'Ditolak'): ?>
                                            <i class="bi bi-x-circle-fill text-danger"></i>
                                        <?php else: ?>
                                            <i class="bi bi-dash-circle-fill text-secondary"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 fw-bold"><?= htmlspecialchars($appointment['lokasiRS']) ?></h6>
                                        <small class="text-muted"><?= date('d F Y', strtotime($appointment['tanggalDonor'])) ?></small>
                                    </div>
                                    <div>
                                        <?php 
                                            $badgeClass = 'bg-secondary';
                                            if($appointment['status'] == 'Selesai') $badgeClass = 'bg-success';
                                            if($appointment['status'] == 'Ditolak') $badgeClass = 'bg-danger';
                                        ?>
                                        <span class="badge <?= $badgeClass ?>" style="font-size: 0.7rem;"><?= strtoupper($appointment['status']) ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>