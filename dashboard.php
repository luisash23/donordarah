<<<<<<< HEAD
=======
<?php
session_start();
?>
>>>>>>> 47aefeb (inisialisasi project donor darah)
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi Darah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-red: #c81000;
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .btn-red { background-color: var(--primary-red); color: white; }
        .btn-red:hover { background-color: #a00d00; color: white; }
        .text-red { color: var(--primary-red); }
        .hero-section { padding: 60px 0; }
        .stat-box h2 { color: var(--primary-red); font-weight: bold; }
        .how-it-works { padding: 50px 0; background-color: #fff; }
<<<<<<< HEAD
=======
        html { scroll-behavior: smooth; }
            .btn-red { background-color: #c81000; }
>>>>>>> 47aefeb (inisialisasi project donor darah)
        .icon-circle {
            width: 60px; height: 60px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 15px;
            color: var(--primary-red);
            font-size: 24px;
            border: 1px solid #eee;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="#">Donasi Darah</a>
            <div class="ms-auto d-flex align-items-center d-flex gap-2">
                <a href="janjitemu.php" class="nav-link text-danger me-3">Janji Temu</a>
                <a href="login.php" class="btn btn-outline-secondary">Sign in</a>
                <a href="register.php" class="btn btn-dark">Register</a>
            </div>
        </div>
    </nav>
<script>
    document.querySelector('a[href="#pencarian-lokasi"]').addEventListener('click', function(e) {
        setTimeout(function() {
            document.getElementById('input-kode-pos').focus();
        }, 500); 
    });
</script>
<body>

    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="#">Donasi Darah</a>
       <div class="ms-auto d-flex align-items-center gap-2">
        <a href="janjitemu.php" class="nav-link text-danger me-3">Janji Temu</a>
    
    <?php if (isset($_SESSION['login'])): ?>
        <a href="profil-user.php" class="btn btn-outline-secondary">Profil Saya</a>
        <a href="logout.php" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin logout?');">Logout</a>
    <?php else: ?>
        <a href="login.php" class="btn btn-outline-secondary">Sign in</a>
        <a href="register.php" class="btn btn-dark">Register</a>
    <?php endif; ?>
</div>
    </div>
</nav>

    <div class="container hero-section">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold text-red mb-3">Donorkan Darah, Selamatkan Jiwa</h1>
                <p class="lead mb-4 text-muted">Setiap donasi dapat menyelamatkan hingga tiga nyawa. Temukan pusat donor terdekat dan jadwalkan janji temu Anda hari ini.</p>
<<<<<<< HEAD
                
                <div class="input-group mb-5 shadow-sm" style="max-width: 500px;">
                    <input type="text" class="form-control form-control-lg border-0 bg-light" placeholder="Masukkan kode pos">
                    <button class="btn btn-red px-4" type="button">Cari</button>
                </div>

=======
                <div class="input-group mb-5 shadow-sm" style="max-width: 500px;">
                <input type="text" id="input-kode-pos" class="form-control form-control-lg border-0 bg-light" placeholder="Masukkan kode pos">
                <a href="lokasi.php" class="btn btn-red">Cari</a>
            </div>
>>>>>>> 47aefeb (inisialisasi project donor darah)
                <div class="row text-center">
                    <div class="col-4 stat-box">
                        <h2>500+</h2>
                        <p class="small fw-bold">Pusat Donor</p>
                    </div>
                    <div class="col-4 stat-box">
                        <h2>10K+</h2>
                        <p class="small fw-bold">Pendonor</p>
                    </div>
                    <div class="col-4 stat-box">
                        <h2>30K+</h2>
                        <p class="small fw-bold">Jiwa Terselamatkan</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0 text-center">
                <img src="assets/bloodonate.jpg" 
                     class="img-fluid rounded-5 shadow" alt="Blood Donation" style="max-height: 400px; width: 100%; object-fit: cover;">
            </div>
        </div>
    </div>

    <div class="how-it-works text-center">
        <div class="container">
            <h3 class="fw-bold mb-5">Cara Kerjanya</h3>
            <div class="row">
                <div class="col-md-4 mb-4">
<<<<<<< HEAD
                    <div class="icon-circle shadow-sm"><i class="bi bi-search"></i></div>
                    <h5 class="fw-bold text-red">Temukan Lokasinya</h5>
=======
                    <a href="#input-kode-pos" style="text-decoration: none;">
                        <div class="icon-circle shadow-sm"><i class="bi bi-search"></i></div>
                        <h5 class="fw-bold text-red">Temukan Lokasinya</h5>
                    </a>
>>>>>>> 47aefeb (inisialisasi project donor darah)
                    <p class="text-muted small">Cari pusat donor terdekat dengan memasukkan kode pos Anda</p>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="icon-circle shadow-sm"><i class="bi bi-calendar-event"></i></div>
                    <h5 class="fw-bold text-red">Buat Janji Temu</h5>
                    <p class="text-muted small">Pilih waktu yang nyaman dan jadwalkan donasi Anda</p>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="icon-circle shadow-sm"><i class="bi bi-people-fill"></i></div>
                    <h5 class="fw-bold text-red">Selamatkan Jiwa</h5>
                    <p class="text-muted small">Donasi Anda dapat membantu menyelamatkan hingga tiga nyawa</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>