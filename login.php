<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'config/app.php'; 

if (isset($_POST['masuk'])) {
    $email    = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $query  = "SELECT * FROM users WHERE gmail = '$email' AND password = '$password'";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        
        $_SESSION['login']  = true;
        $_SESSION['idUser'] = $data['idUser']; 

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Email atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Masuk - DonasiDarah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #fdf2f2; height: 100vh; display: flex; flex-direction: column; font-family: 'Segoe UI', sans-serif; }
        .login-container { flex: 1; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .login-card { width: 100%; max-width: 450px; background: white; border-radius: 15px; padding: 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); text-align: center; }
        .btn-masuk { background-color: #c81000; color: white; border: none; padding: 10px; border-radius: 5px; width: 100%; font-weight: 600; }
        .btn-masuk:hover { background-color: #cc0000; color: white; }
    </style>
</head>
<body>

    <nav class="navbar navbar-light bg-white border-bottom py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-danger" href="#"><i class="bi bi-heart-fill me-2"></i> DonasiDarah</a>
        </div>
    </nav>

    <div class="login-container">
        <div class="login-card">
            <i class="bi bi-heart-fill text-danger" style="font-size: 3rem;"></i>
            <h3 class="fw-bold mt-3">Selamat Datang</h3>
            <p class="text-muted mb-4">Silakan masuk ke akun Anda</p>

            <form method="POST" action="">
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger py-2 small"><?= $error ?></div>
                <?php endif; ?>

                <div class="mb-3 text-start">
                    <label class="form-label small fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
                </div>

                <div class="mb-4 text-start">
                    <label class="form-label small fw-bold">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <button type="submit" name="masuk" class="btn btn-masuk">Masuk</button>
                <p class="mt-3 small">Belum punya akun? <a href="register.php" class="text-danger">Daftar sekarang</a></p>
                
            </form>
        </div>
    </div>

</body>
</html>