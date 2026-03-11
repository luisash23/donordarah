<?php
session_start();
// Pastikan user sudah login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
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
            <div class="profile-card">
                <div class="text-center">
                    <div class="avatar-box"><i class="bi bi-person-fill"></i></div>
                    <h3 class="fw-bold">Profil Pendonor</h3>
                    <p class="text-muted">Informasi akun dan kesehatan Anda</p>
                </div>

                <hr class="my-4">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Nama Lengkap</label>
                        <div class="fw-bold">Budi Santoso</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Email</label>
                        <div class="fw-bold">budi@email.com</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Golongan Darah</label>
                        <div class="fw-bold badge bg-danger">O+</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Nomor Telepon</label>
                        <div class="fw-bold">081234567890</div>
                    </div>
                </div>

                <div class="alert alert-info mt-3">
                    <i class="bi bi-info-circle-fill"></i> Terakhir mendonor: 3 bulan yang lalu.
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#editModal">
                        Edit Profil
                    </button>
                    <a href="logout.php" class="btn btn-dark">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="update_proses.php" method="POST">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" value="Budi Santoso">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control" name="telepon" value="081234567890">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Golongan Darah</label>
                            <select class="form-select" name="goldar">
                                <option value="O+" selected>O+</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>