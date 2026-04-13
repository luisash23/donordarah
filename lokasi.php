<?php
session_start();
include 'config/app.php';

// Ambil data tempat donor dari database
$tempatResult = mysqli_query($db, "SELECT * FROM tempat_donor ORDER BY idTempat ASC");
if (!$tempatResult) {
    die("Error mengambil data tempat: " . mysqli_error($db));
}

$tempatList = [];
while ($row = mysqli_fetch_assoc($tempatResult)) {
    $tempatList[] = $row;
}
?>
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



        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    
                    <?php if (count($tempatList) > 0): ?>
                        <?php foreach ($tempatList as $tempat): ?>
                            <div class="card location-card mb-4 shadow-sm">
                                <div class="row g-4 align-items-center">
                                    <div class="col-md-4">
                                        <img src="assets/donor.jpg" class="img-placeholder" alt="<?= $tempat['nama_tempat']; ?>">
                                    </div>
                                    <div class="col-md-8">
                                        <h4 class="fw-bold mb-1"><?= $tempat['nama_tempat']; ?></h4>
                                        <div class="mb-3">
                                            <span class="text-warning"><i class="bi bi-star-fill"></i> 4.7</span>
                                        </div>
                                        
                                        <div class="info-item">
                                            <i class="bi bi-geo-alt text-danger"></i>
                                            <span><?= $tempat['alamat']; ?></span>
                                        </div>
                                        <div class="info-item">
                                            <i class="bi bi-telephone text-danger"></i>
                                            <span>+62 8890-4938-3129</span>
                                        </div>
                                        <div class="info-item mb-4">
                                            <i class="bi bi-clock text-danger"></i>
                                            <span>Sen-Jum: 08.00-18.00, Sab: 09.00-16.00</span>
                                        </div>

                                        <a href="fromjanjitemu.php" class="btn btn-red px-4 py-2 fw-bold">Buat Janji Temu</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-warning text-center">
                            <i class="bi bi-info-circle me-2"></i> Belum ada tempat donor yang tersedia. Silakan cek kembali nanti.
                        </div>
                    <?php endif; ?>

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
</body>
</html>