<?php
session_start();
$_SESSION['login'] = true; 
?>
<!DOCTYPE html>
<html lang="id">
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - DonasiDarah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #fdf2f2; /* Latar belakang agak kemerahan sangat muda */
            height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar-brand {
            color: #d63031 !important;
            font-weight: bold;
        }
        .login-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            width: 100%;
            max-width: 450px;
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            text-align: center;
        }
        .heart-logo {
            color: #ff0000;
            font-size: 3rem;
            margin-bottom: 15px;
        }
        .form-label {
            display: block;
            text-align: left;
            font-weight: 500;
            font-size: 0.85rem;
            margin-bottom: 8px;
        }
        .input-group-text {
            background-color: transparent;
            border-right: none;
            color: #adb5bd;
        }
        .form-control {
            border-left: none;
            padding: 10px;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #dee2e6;
        }
        .btn-masuk {
          background-color: #c81000; 
          color: white;
          padding: 10px 20px;
          display: block; 
          text-align: center;
          text-decoration: none;
          border-radius: 5px;
        }
        .btn-masuk:hover {
            background-color: #cc0000;
        }
        .register-link {
            color: #ff0000;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-light bg-white border-bottom py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <i class="bi bi-heart-fill me-2 text-danger"></i> DonasiDarah
            </a>
        </div>
    </nav>

    <div class="login-container">
        <div class="login-card">
            <div class="heart-logo">
                <i class="bi bi-heart-fill"></i>
            </div>
            
            <h3 class="fw-bold">Selamat Datang</h3>
            <p class="text-muted mb-4">Masuk ke akun Anda untuk melanjutkan</p>

            <form>
                <div class="mb-3">
                    <label class="form-label">Email *</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" class="form-control" placeholder="email@example.com">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password *</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" placeholder="••••••••">
                    </div>
                </div>

                <div class="d-grid mb-4">
                    <a href="dashboard.php" class="btn btn-masuk ">Masuk</a>
                </div>

                <p class="text-muted small">
                    Belum punya akun? <a href="register.php" class="register-link">Daftar sekarang</a>
                </p>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>