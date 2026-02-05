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
                                <img src="https://fastly.picsum.photos/id/1023/400/300.jpg?hmac=W0WqR5zYq1t6p8zK9p-M7G-E-O-n-7-0-0-0" class="img-placeholder" alt="UDD PMI">
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
                                    <i class="bi bi-telephone text-danger"></i>
                                    <span>+62 8890-4938-3129</span>
                                </div>
                                <div class="info-item mb-4">
                                    <i class="bi bi-clock text-danger"></i>
                                    <span>Sen-Jum: 08.00-18.00, Sab: 09.00-16.00</span>
                                </div>

                                <button class="btn btn-red px-4 py-2 fw-bold">
                                    <i class="bi bi-calendar-check me-2"></i> Buat Janji Temu
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
</body>
</html>