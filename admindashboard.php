<?php
session_start();
include 'config/app.php';

// Cek login & role
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'ADMIN') {
    header("Location: login.php");
    exit;
}

// --- LOGIKA ACTION JANJI TEMU ---

// 1. Proses ACC (Konfirmasi)
if (isset($_GET['acc'])) {
    $id = $_GET['acc'];
    mysqli_query($db, "UPDATE konfirmasi_donor SET status='Terkonfirmasi' WHERE idKonfirmasi=$id");
    header("Location: admindashboard.php"); 
}

// 2. Proses TOLAK
if (isset($_GET['tolak'])) {
    $id = $_GET['tolak'];
    // Mengubah status menjadi 'Ditolak'
    mysqli_query($db, "UPDATE konfirmasi_donor SET status='Ditolak' WHERE idKonfirmasi=$id");
    header("Location: admindashboard.php");
}

// --- LOGIKA KELOLA LOKASI ---

// 3. Proses TAMBAH TEMPAT
if (isset($_POST['nama_tempat'])) {
    $nama = mysqli_real_escape_string($db, $_POST['nama_tempat']);
    $alamat = mysqli_real_escape_string($db, $_POST['alamat']);
    mysqli_query($db, "INSERT INTO tempat_donor (nama_tempat, alamat) VALUES ('$nama','$alamat')");
    echo "<script>alert('Tempat berhasil ditambahkan'); window.location='admin_dashboard.php';</script>";
}

// 4. Proses HAPUS LOKASI
if (isset($_GET['hapus_lokasi'])) {
    $id = $_GET['hapus_lokasi'];
    mysqli_query($db, "DELETE FROM tempat_donor WHERE idTempat=$id");
    header("Location: admin_dashboard.php");
}

// AMBIL DATA UNTUK DITAMPILKAN
$janji = mysqli_query($db, "SELECT kd.*, u.username, u.golonganDarah FROM konfirmasi_donor kd JOIN users u ON kd.idUser = u.idUser ORDER BY kd.idKonfirmasi DESC");
$data_tempat = mysqli_query($db, "SELECT * FROM tempat_donor ORDER BY idTempat DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | BloodLife</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .sidebar { min-width: 260px; max-width: 260px; min-height: 100vh; background: #212529; color: #fff; position: sticky; top: 0; }
        .sidebar .sidebar-header { padding: 20px; background: #dc3545; text-align: center; }
        .sidebar ul li a { padding: 12px 20px; display: block; color: #adb5bd; text-decoration: none; transition: 0.3s; font-weight: 500; }
        .sidebar ul li a:hover, .sidebar ul li a.active { color: #fff; background: rgba(255, 255, 255, 0.1); border-left: 4px solid #dc3545; }
        .content { width: 100%; padding: 30px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .btn-custom { border-radius: 8px; font-weight: 500; }
    </style>
</head>
<body class="d-flex">

    <nav class="sidebar shadow">
        <div class="sidebar-header">
            <h4 class="mb-0"><i class="fas fa-heartbeat"></i> BloodAdmin</h4>
        </div>
        <ul class="list-unstyled components">
            <li><a href="#" class="active"><i class="fas fa-calendar-check"></i> Janji Temu</a></li>
            <li><a href="#tambah"><i class="fas fa-map-marker-alt"></i> Kelola Lokasi</a></li>
            <hr class="mx-3 bg-secondary">
            <li><a href="logout.php" class="text-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
        </ul>
    </nav>

    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark">Data Janji Temu</h2>
            <div class="text-secondary small">Halo, Admin | <?php echo date('d M Y'); ?></div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-white p-3 border-start border-danger border-4 h-100">
                    <div class="text-secondary small fw-bold">TOTAL PENGAJUAN</div>
                    <div class="h3 fw-bold mb-0 text-danger"><?= mysqli_num_rows($janji); ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-white p-3 border-start border-primary border-4 h-100">
                    <div class="text-secondary small fw-bold">TOTAL LOKASI</div>
                    <div class="h3 fw-bold mb-0 text-primary"><?= mysqli_num_rows($data_tempat); ?></div>
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold"><i class="fas fa-table me-2 text-danger"></i>Daftar Konfirmasi Donor</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr class="table-light">
                                <th class="ps-4">Nama Pendonor</th>
                                <th>Golongan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($janji)) : ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold"><?= $row['username']; ?></div>
                                    <small class="text-muted">Kode: <?= $row['kodeTiket']; ?></small>
                                </td>
                                <td><span class="badge bg-light text-danger border border-danger"><?= $row['golonganDarah']; ?></span></td>
                                <td><?= date('d M Y', strtotime($row['tanggalDonor'])); ?></td>
                                <td>
                                    <?php if($row['status'] == 'Pending'): ?>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    <?php elseif($row['status'] == 'Terkonfirmasi'): ?>
                                        <span class="badge bg-success">Terkonfirmasi</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Ditolak</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($row['status'] == 'Pending') : ?>
                                        <a href="?acc=<?= $row['idKonfirmasi']; ?>" class="btn btn-sm btn-success btn-custom me-1">Terima</a>
                                        <a href="?tolak=<?= $row['idKonfirmasi']; ?>" 
                                           class="btn btn-sm btn-outline-danger btn-custom"
                                           onclick="return confirm('Tolak janji temu ini?')">Tolak</a>
                                    <?php else : ?>
                                        <span class="text-muted small">- Selesai -</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row g-4" id="tambah">
            <div class="col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="fw-bold mb-4"><i class="fas fa-plus-square text-danger me-2"></i>Tambah Lokasi</h4>
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Tempat</label>
                                <input type="text" name="nama_tempat" class="form-control" placeholder="Nama RS/PMI" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control" rows="3" placeholder="Jl. Raya..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger w-100 btn-custom py-2">Simpan Lokasi</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-map-marked-alt me-2 text-primary"></i>Daftar Lokasi Tersedia</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="sticky-top bg-light">
                                    <tr>
                                        <th class="ps-4">Nama Tempat</th>
                                        <th>Alamat</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($t = mysqli_fetch_assoc($data_tempat)) : ?>
                                    <tr>
                                        <td class="ps-4 fw-bold text-primary small"><?= $t['nama_tempat']; ?></td>
                                        <td class="text-secondary small"><?= $t['alamat']; ?></td>
                                        <td class="text-center">
                                            <a href="?hapus_lokasi=<?= $t['idTempat']; ?>" 
                                               class="btn btn-sm btn-light text-danger"
                                               onclick="return confirm('Hapus lokasi ini?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>