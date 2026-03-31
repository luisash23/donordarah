<?php
session_start();
include 'config/app.php'; 

if (!isset($_SESSION['idUser'])) {
    header("Location: login.php?pesan=harus_login"); 
    exit;
}
 //klo berhasil ambil data
$idUser = $_SESSION['idUser'];
$result = mysqli_query($db, "SELECT * FROM users WHERE idUser = '$idUser'");
$user = mysqli_fetch_assoc($result);

$username = $user['username'] ?? 'Tamu';
$email    = $user['gmail'] ?? '-';
$goldar   = $user['golonganDarah'] ?? '-';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Waktu Janji Temu - DonasiDarah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .navbar-brand { color: #d63031 !important; font-weight: bold; }
        .main-container { max-width: 900px; margin: 30px auto; padding: 0 15px; }
        .back-link { text-decoration: none; color: #6c757d; font-size: 0.9rem; margin-bottom: 20px; display: inline-block; }
        .back-link:hover { color: #333; }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .info-pendonor { background-color: #eef5ff; border: 1px solid #cce0ff; padding: 20px; border-radius: 12px; }
        .info-label { color: #0d6efd; font-weight: 600; font-size: 0.85rem; }
        .info-value { color: #333; font-size: 0.9rem; margin-bottom: 10px; }
        .time-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 12px; margin-bottom: 25px; }
        .btn-time { border: 1px solid #dee2e6; background: white; padding: 10px; border-radius: 8px; font-size: 0.9rem; transition: 0.2s; }
        .btn-time:hover { border-color: #d63031; color: #d63031; }
        .btn-time.active { background-color: #d63031; color: white; border-color: #d63031; }
        .date-title { font-weight: 600; color: #333; margin-bottom: 15px; font-size: 1rem; }
        .section-header-icon { color: #d63031; margin-right: 8px; }
        .action-footer { display: flex; justify-content: flex-end; gap: 15px; margin-top: 30px; }
        .btn-cancel { border: 1px solid #dee2e6; padding: 10px 30px; border-radius: 8px; font-weight: 500; }
        .btn-confirm { background-color: #ff0000; color: white; border: none; padding: 10px 30px; border-radius: 8px; font-weight: 600; }
        .btn-confirm:hover { background-color: #cc0000; }
    </style>
</head>
<body>

    <nav class="navbar navbar-light bg-white border-bottom py-3">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="bi bi-heart-fill me-2"></i> DonasiDarah</a>
        </div>
    </nav>

    <div class="main-container">
        <a href="dashboard.php" class="back-link"><i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Pusat Donor</a>
        
        <div class="card card-custom p-4">
            <h4 class="fw-bold mb-1">Bank Darah Rumah Sakit Pusat</h4>
            <p class="text-muted small mb-0">Jl. Sudirman No. 123, Jakarta, DKI Jakarta 10210</p>
        </div>
        
        <div class="info-pendonor mb-4">
            <h6 class="fw-bold text-primary mb-3">Informasi Pendonor</h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="info-label">Nama:</div>
                    <div class="info-value"><?= htmlspecialchars($username) ?></div>
                    
                    <div class="info-label">Telepon:</div>
                    <div class="info-value">-</div> 
                </div>
                <div class="col-md-6">
                    <div class="info-label">Email:</div>
                    <div class="info-value"><?= htmlspecialchars($email) ?></div>
                    
                    <div class="info-label">Golongan Darah:</div>
                    <div class="info-value">
                        <span class="badge bg-danger"><?= htmlspecialchars($goldar) ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-custom p-4">
            <div class="d-flex align-items-center mb-4">
                <i class="bi bi-calendar-event section-header-icon fs-4"></i>
                <h5 class="fw-bold mb-0">Pilih Waktu Janji Temu</h5>
            </div>

            <div class="date-title">Selasa, 3 Februari 2026</div>
            <div class="time-grid">
                <button type="button" class="btn btn-time active" data-date="2026-02-03" data-time="09:00">09:00</button>
                <button type="button" class="btn btn-time" data-date="2026-02-03" data-time="10:30">10:30</button>
                <button type="button" class="btn btn-time" data-date="2026-02-03" data-time="14:00">14:00</button>
                <button type="button" class="btn btn-time" data-date="2026-02-03" data-time="16:00">16:00</button>
            </div>

            <div class="date-title">Rabu, 4 Februari 2026</div>
            <div class="time-grid">
                <button type="button" class="btn btn-time" data-date="2026-02-04" data-time="09:00">09:00</button>
                <button type="button" class="btn btn-time" data-date="2026-02-04" data-time="11:00">11:00</button>
                <button type="button" class="btn btn-time" data-date="2026-02-04" data-time="15:00">15:00</button>
            </div>
        </div>

        <div class="action-footer">
            <a href="lokasi.php" class="btn btn-light btn-cancel">Batal</a>
            <form action="konfirmasi.php" method="POST" id="konfirmasiForm" class="d-flex flex-grow-1">
                <input type="hidden" name="lokasiRS" value="Bank Darah Rumah Sakit Pusat">
                <input type="hidden" id="tanggalDonor" name="tanggalDonor" value="2026-02-03">
                <input type="hidden" id="waktuDonor" name="waktuDonor" value="09:00">
                <button type="submit" class="btn btn-confirm w-100">Konfirmasi Janji Temu</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const dateInput = document.getElementById('tanggalDonor');
        const timeInput = document.getElementById('waktuDonor');

        document.querySelectorAll('.btn-time').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.btn-time').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                dateInput.value = this.dataset.date;
                timeInput.value = this.dataset.time;
            });
        });
    </script>
</body>
</html>