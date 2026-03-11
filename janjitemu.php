<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
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

    <div class="tab-content">
        
       <div class="tab-pane fade show active" id="aktif">
            <div class="tab-pane fade show active" id="aktif">
            <div class="row justify-content-center mt-4"> 
                <div class="col-lg-7"> <div class="card p-4 shadow-sm border-0">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0">Unit Donor Darah (UDD) PMI</h5>
                            <span class="badge bg-warning text-dark status-badge">Menunggu</span>
                        </div>
                        
                        <p class="text-muted mb-4"><i class="bi bi-calendar-check me-2"></i>Rabu, 15 Maret 2026 - 10:00 WIB</p>
                        
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-danger btn-sm">Batalkan Janji</button>
                            <button class="btn btn-danger btn-sm">Lihat QR Code</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
       <div class="tab-pane fade" id="riwayat">
    <div class="row justify-content-center mt-4">
        <div class="col-lg-7">
            
            <div class="card p-3 mb-3 border-0 shadow-sm" style="background-color: #f8f9fa;">
                <div class="d-flex align-items-center">
                    <div class="me-3 fs-4 text-success"><i class="bi bi-check-circle-fill"></i></div>
                    <div class="flex-grow-1">
                        <h6 class="mb-0 fw-bold">Unit Donor Darah (UDD) PMI</h6>
                        <small class="text-muted">10 Januari 2026</small>
                    </div>
                    <span class="badge bg-success" style="font-size: 0.7rem;">Selesai</span>
                </div>
            </div>

            <div class="card p-3 mb-3 border-0 shadow-sm" style="background-color: #f8f9fa;">
                <div class="d-flex align-items-center">
                    <div class="me-3 fs-4 text-secondary"><i class="bi bi-x-circle-fill"></i></div>
                    <div class="flex-grow-1">
                        <h6 class="mb-0 fw-bold">Rumah Sakit Umum Daerah</h6>
                        <small class="text-muted">15 Desember 2025</small>
                    </div>
                    <span class="badge bg-secondary" style="font-size: 0.7rem;">Dibatalkan</span>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>