<<<<<<< HEAD
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi Darah - Janji Temu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-red: #c81000;
            --light-gray: #f8f9fa;
        }
        body { font-family: 'Inter', sans-serif; color: #333; scroll-behavior: smooth; }
        
        /* Navbar & Global */
        .btn-red { background-color: var(--primary-red); color: white; border-radius: 10px; }
        .btn-red:hover { background-color: #a00d00; color: white; }
        .text-red { color: var(--primary-red); }

        /* Hero Section */
        .hero-section { padding: 80px 0; }
        .stat-box h2 { color: var(--primary-red); font-weight: bold; margin-bottom: 0; }
        
        /* Search & Result Section */
        .search-section { padding: 100px 0; background-color: #fdfdfd; }
        .search-bar-wrapper { 
            background: white; 
            border-radius: 50px; 
            padding: 8px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            max-width: 700px;
            margin: 0 auto;
        }
        
        /* Card Styling */
        .location-card {
            border-radius: 24px;
            border: 1px solid #f0f0f0;
            padding: 24px;
            transition: all 0.3s ease;
            background: white;
        }
        .location-card:hover { transform: translateY(-5px); box-shadow: 0 12px 30px rgba(0,0,0,0.05); }
        .img-placeholder {
            width: 100%;
            height: 200px;
            background: #eee;
            border-radius: 18px;
            object-fit: cover;
        }
        .info-item { font-size: 0.95rem; color: #555; display: flex; align-items: center; gap: 10px; margin-bottom: 8px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top border-bottom">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="#">Donasi Darah</a>
            <div class="ms-auto d-flex align-items-center">
                <a href="dashboard.php" class="nav-link text-danger fw-semibold me-4">Dashboard</a>
                <button class="btn btn-light border me-2 px-4">Sign in</button>
                <button class="btn btn-dark px-4">Register</button>
            </div>
        </div>
    </nav>



        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    
                    <div class="card location-card mb-4 shadow-sm">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-4">
                                <img src="assets/donor.jpg" class="img-placeholder" alt="UDD PMI">
                            </div>
                            <div class="col-md-8">
                                <h4 class="fw-bold mb-1">Unit Donor Darah (UDD) PMI</h4>
                                <div class="mb-3">
                                    <span class="text-warning"><i class="bi bi-star-fill"></i> 4.7</span>
                                </div>
                                
                                <div class="info-item">
                                    <i class="bi bi-geo-alt text-danger"></i>
                                    <span>Jl. Palang Merah Indonesia No. 1, Sidodadi Samarinda Ulu</span>
                                </div>
                                <div class="info-item">
                                    <i class="i i-telephone text-danger"></i>
                                    <span>+62 8890-4938-3129</span>
                                </div>
                                <div class="info-item mb-4">
                                    <i class="bi bi-clock text-danger"></i>
                                    <span>Sen-Jum: 08.00-18.00, Sab: 09.00-16.00</span>
                                </div>

                                <button class="btn btn-red px-4 py-2 fw-bold">
                                    <a  href="formjanji.php" class="btn btn-red px-4 py-2 fw-bold">Buat Janji Temu</a>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card location-card bg-light border-dashed" style="border: 2px dashed #ddd; opacity: 0.6;">
                        <div class="p-5 text-center text-muted">
                            <i class="bi bi-geo-fill fs-1 mb-3"></i>
                            <p>Masukkan kode pos untuk mencari lokasi lainnya</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <footer class="py-4 text-center text-muted border-top">
        <small>&copy; 2026 Donasi Darah Indonesia. Semua Hak Dilindungi.</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
=======
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
>>>>>>> 47aefeb (inisialisasi project donor darah)
</body>
</html>