<?php
session_start();
include 'config/connection.php'; // Pastikan file ini sudah ada dan benar

// Cek apakah user sudah login, jika sudah, langsung lempar ke dashboard
if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}

// Logika ketika tombol "Masuk" ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email_input = $_POST['email'];
    $pass_input  = $_POST['password'];

    try {
        // Query disesuaikan dengan kolom 'gmail' di tabel 'users' kamu
        $query = "SELECT * FROM users WHERE gmail = :email LIMIT 1";
        $stmt  = $conn->prepare($query);
        $stmt->bindParam(':email', $email_input);
        $stmt->execute();
        
        $user = $stmt->fetch();

        if ($user) {
            // Verifikasi password (mengasumsikan password di DB masih teks biasa/plain)
            if ($pass_input === $user['password']) {
                
                // Set Session berdasarkan kolom di database kamu
                $_SESSION['login']        = true;
                $_SESSION['idUser']       = $user['idUser'];
                $_SESSION['username']     = $user['username'];
                $_SESSION['golonganDarah'] = $user['golonganDarah'];

                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Password yang Anda masukkan salah!";
            }
        } else {
            $error = "Email (Gmail) tidak terdaftar!";
        }
    } catch(PDOException $e) {
        $error = "Terjadi kesalahan sistem.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - DonasiDarah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #fdf2f2; height: 100vh; display: flex; flex-direction: column; font-family: 'Segoe UI', sans-serif; }
        .navbar-brand { color: #d63031 !important; font-weight: bold; }
        .login-container { flex: 1; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .login-card { width: 100%; max-width: 450px; background: white; border-radius: 15px; padding: 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); text-align: center; }
        .heart-logo { color: #ff0000; font-size: 3rem; margin-bottom: 15px; }
        .form-label { display: block; text-align: left; font-weight: 500; font-size: 0.85rem; margin-bottom: 8px; }
        .btn-masuk { background-color: #c81000; color: white; width: 100%; border: none; padding: 10px; border-radius: 5px; transition: 0.3s; }
        .btn-masuk:hover { background-color: #a30d00; color: white; }
        .register-link { color: #ff0000; text-decoration: none; font-weight: bold; }
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
            <div class="heart-logo"><i class="bi bi-heart-fill"></i></div>
            <h3 class="fw-bold">Selamat Datang</h3>
            <p class="text-muted mb-4">Masuk ke akun Anda untuk melanjutkan</p>

            <?php if(isset($error)): ?>
                <div class="alert alert-danger small py-2"><?php echo $error; ?></div>
            <?php endif; ?>

                <form action="config/app.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Email *</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password *</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" name="login" class="btn btn-masuk">Masuk</button>
                    </div>
                </form>

                <p class="text-muted small">
                    Belum punya akun? <a href="register.php" class="register-link">Daftar sekarang</a>
                </p>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>