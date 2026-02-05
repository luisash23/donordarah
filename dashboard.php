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
            <div class="ms-auto d-flex align-items-center">
                <a href="janjitemu.php" class="nav-link text-danger me-3">Janji Temu</a>
                <button class="btn btn-outline-secondary me-2">Sign in</button>
                <button class="btn btn-dark">Register</button>
            </div>
        </div>
    </nav>

    <div class="container hero-section">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold text-red mb-3">Donorkan Darah, Selamatkan Jiwa</h1>
                <p class="lead mb-4 text-muted">Setiap donasi dapat menyelamatkan hingga tiga nyawa. Temukan pusat donor terdekat dan jadwalkan janji temu Anda hari ini.</p>
                
                <div class="input-group mb-5 shadow-sm" style="max-width: 500px;">
                    <input type="text" class="form-control form-control-lg border-0 bg-light" placeholder="Masukkan kode pos">
                    <button class="btn btn-red px-4" type="button">Cari</button>
                </div>

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
                    <div class="icon-circle shadow-sm"><i class="bi bi-search"></i></div>
                    <h5 class="fw-bold text-red">Temukan Lokasinya</h5>
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