<?php
session_start();
include 'config/connection.php';

// Pastikan user sudah login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Ambil data user terbaru dari database
$idUser = $_SESSION['idUser'];
try {
    $query = "SELECT * FROM users WHERE idUser = :id LIMIT 1";
    $stmt  = $conn->prepare($query);
    $stmt->bindParam(':id', $idUser);
    $stmt->execute();
    $user = $stmt->fetch();

    if (!$user) {
        session_destroy();
        header("Location: login.php");
        exit;
    }
} catch (PDOException $e) {
    die("Gagal mengambil data: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna - DonasiDarah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .profile-card { background: #fff; padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .avatar-box { width: 120px; height: 120px; background: #eee; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 50px; color: #c81000; margin: 0 auto 20px; border: 3px solid #c81000; }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="profile-card text-center">
                <div class="avatar-box"><i class="bi bi-person-fill"></i></div>
                <h3 class="fw-bold"><?= htmlspecialchars($user['username']) ?></h3>
                <p class="text-muted">ID Pendonor: #<?= $user['idUser'] ?></p>

                <hr class="my-4">

                <div class="row text-start">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Email (Gmail)</label>
                        <div class="fw-bold"><?= htmlspecialchars($user['gmail']) ?></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Golongan Darah</label>
                        <div><span class="badge bg-danger"><?= $user['golonganDarah'] ?></span></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Berat Badan</label>
                        <div class="fw-bold"><?= $user['beratBadan'] ?> kg</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Tinggi Badan</label>
                        <div class="fw-bold"><?= $user['tinggiBadan'] ?> cm</div>
                    </div>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#editModal">Edit Profil</button>
                    <a href="logout.php" class="btn btn-dark">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profil Anda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="config/update_proses.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Berat Badan (kg)</label>
                            <input type="number" name="beratBadan" class="form-control" value="<?= $user['beratBadan'] ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tinggi Badan (cm)</label>
                            <input type="number" name="tinggiBadan" class="form-control" value="<?= $user['tinggiBadan'] ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Golongan Darah</label>
                        <select name="golonganDarah" class="form-select">
                            <?php 
                            $opts = ['A', 'B', 'AB', 'O'];
                            foreach($opts as $o) {
                                $sel = ($user['golonganDarah'] == $o) ? 'selected' : '';
                                echo "<option value='$o' $sel>$o</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="update" class="btn btn-danger">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>