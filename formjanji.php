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
        
        /* Informasi Pendonor Section */
        .info-pendonor { background-color: #eef5ff; border: 1px solid #cce0ff; padding: 20px; border-radius: 12px; }
        .info-label { color: #0d6efd; font-weight: 600; font-size: 0.85rem; }
        .info-value { color: #333; font-size: 0.9rem; margin-bottom: 10px; }

        /* Time Slot Buttons */
        .time-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 12px; margin-bottom: 25px; }
        .btn-time { 
            border: 1px solid #dee2e6; 
            background: white; 
            padding: 10px; 
            border-radius: 8px; 
            font-size: 0.9rem;
            transition: 0.2s;
        }
        .btn-time:hover { border-color: #d63031; color: #d63031; }
        .btn-time.active { background-color: #d63031; color: white; border-color: #d63031; }

        .date-title { font-weight: 600; color: #333; margin-bottom: 15px; font-size: 1rem; }
        .section-header-icon { color: #d63031; margin-right: 8px; }

        /* Footer Buttons */
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
        <a href="#" class="back-link"><i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Pusat Donor</a>

        <div class="card card-custom p-4">
            <h4 class="fw-bold mb-1">Bank Darah Rumah Sakit Pusat</h4>
            <p class="text-muted small mb-0">Jl. Sudirman No. 123, Jakarta, DKI Jakarta 10210</p>
        </div>

        <div class="info-pendonor mb-4">
            <h6 class="fw-bold text-primary mb-3">Informasi Pendonor</h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="info-label">Nama: $nama</div>
                    <div class="info-value">luis luis</div>
                    <div class="info-label">Telepon:</div>
                    <div class="info-value">0858816424</div>
                </div>
                <div class="col-md-6">
                    <div class="info-label">Email:</div>
                    <div class="info-value">luis.spt90@gmail.com</div>
                    <div class="info-label">Golongan Darah:</div>
                    <div class="info-value">B-</div>
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
                <button class="btn btn-time">09:00</button>
                <button class="btn btn-time">10:30</button>
                <button class="btn btn-time">14:00</button>
                <button class="btn btn-time">16:00</button>
            </div>

            <div class="date-title">Rabu, 4 Februari 2026</div>
            <div class="time-grid">
                <button class="btn btn-time">09:00</button>
                <button class="btn btn-time">11:00</button>
                <button class="btn btn-time">15:00</button>
            </div>

            <div class="date-title">Kamis, 5 Februari 2026</div>
            <div class="time-grid">
                <button class="btn btn-time">10:00</button>
                <button class="btn btn-time">13:00</button>
                <button class="btn btn-time">15:30</button>
            </div>
        </div>

        <div class="action-footer">
            <a href="janjitemu.php" class="btn btn-light btn-cancel">Batal</a>
            <button class="btn btn-confirm">Konfirmasi Janji Temu</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Simple script untuk simulasi klik pada jam
        document.querySelectorAll('.btn-time').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.btn-time').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>