<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Sebagai Pendonor - DonasiDarah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #ffffff;
            font-family: 'Segoe UI', sans-serif;
        }

        .navbar-brand {
            color: #d63031 !important;
            font-weight: bold;
        }

        .register-card {
            max-width: 800px;
            margin: 40px auto;
            border: 1px solid #e0e0e0;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .section-header {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .icon-red {
            color: #dc3545;
        }

        .form-label {
            font-weight: 500;
            font-size: 0.9rem;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
        }

        /* Style untuk icon di dalam input */
        .input-group-text {
            background-color: transparent;
            border-right: none;
            color: #6c757d;
        }

        .input-group .form-control,
        .input-group .form-select {
            border-left: none;
        }

        .input-group .form-control:focus,
        .input-group .form-select:focus {
            box-shadow: none;
            border-color: #dee2e6;
        }

        .helper-text {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 4px;
        }

        .btn-danger {
            background-color: #ff0000;
            border: none;
            padding: 12px;
            font-weight: bold;
            border-radius: 10px;
        }

        .login-link {
            color: #ff0000;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-light bg-white border-bottom">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-heart-fill me-2"></i> DonasiDarah
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="register-card">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Daftar Sebagai Pendonor</h2>
                <p class="text-muted">Daftar untuk mulai mendonorkan darah dan menyelamatkan nyawa</p>
            </div>

            <form action="config/app.php" method="POST">
    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Nama Depan *</label>
                            <input type="text" name="nama_depan" class="form-control" placeholder="Nama Depan" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Belakang *</label>
                            <input type="text" name="nama_belakang" class="form-control" placeholder="Nama Belakang" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email *</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="gmail" class="form-control" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Golongan Darah *</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-droplet"></i></span>
                                <select name="golonganDarah" class="form-select" required>
                                    <option value="">Pilih Golongan Darah</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Berat Badan (kg) *</label>
                            <input type="number" name="beratBadan" class="form-control" placeholder="Min. 45 kg" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tinggi Badan (cm) *</label>
                            <input type="number" name="tinggiBadan" class="form-control" placeholder="Min. 150 cm" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-5">
                        <div class="col-md-6">
                            <label class="form-label">Password *</label>
                            <input type="password" name="password" class="form-control" required minlength="6">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Konfirmasi Password *</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" name="register" class="btn btn-danger">Daftar Sekarang</button>
                    </div>
                </form>
                <div class="text-center mt-4">
                    <p class="text-muted">Sudah punya akun? <a href="login.php" class="login-link">Login di sini</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>