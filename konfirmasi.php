<?php
session_start();
include 'config/app.php';

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

$idUser = isset($_SESSION['idUser']) ? intval($_SESSION['idUser']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lokasiRS = mysqli_real_escape_string($db, $_POST['lokasiRS'] ?? '');
    $tanggalDonor = mysqli_real_escape_string($db, $_POST['tanggalDonor'] ?? '');
    $waktuDonor = mysqli_real_escape_string($db, $_POST['waktuDonor'] ?? '');

    $kodeTiket = strtoupper(substr(md5(uniqid($idUser . time() . $tanggalDonor . $waktuDonor, true)), 0, 12));
    $status = 'Terkonfirmasi';

    $query = "INSERT INTO konfirmasi_donor (idUser, kodeTiket, lokasiRS, tanggalDonor, waktuDonor, status) VALUES ('$idUser', '$kodeTiket', '$lokasiRS', '$tanggalDonor', '$waktuDonor', '$status')";
    if (mysqli_query($db, $query)) {
        $idKonfirmasi = mysqli_insert_id($db);
        header("Location: konfirmasi.php?id=$idKonfirmasi");
        exit;
    } else {
        $errorMessage = 'Gagal menyimpan konfirmasi: ' . mysqli_error($db);
    }
}

$idKonfirmasi = isset($_GET['id']) ? intval($_GET['id']) : 0;
$ticket = null;
if ($idKonfirmasi > 0) {
    $sql = "SELECT kd.*, u.username FROM konfirmasi_donor kd LEFT JOIN users u ON kd.idUser = u.idUser WHERE kd.idKonfirmasi = '$idKonfirmasi' AND kd.idUser = '$idUser' LIMIT 1";
    $result = mysqli_query($db, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $ticket = mysqli_fetch_assoc($result);
    }
}

if (!$ticket && empty($errorMessage)) {
    $errorMessage = 'Data e-ticket tidak ditemukan. Pastikan Anda telah melakukan konfirmasi janji temu.';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticket Donor Darah - Terkonfirmasi</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --red-gradient: linear-gradient(135deg, #ff4d4d, #d32f2f);
            --bg-light: #f4f7fa;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Inter', sans-serif;
            padding-bottom: 50px;
        }

        .ticket-wrapper {
            max-width: 480px;
            margin: 40px auto;
            padding: 0 15px;
        }

        .status-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .icon-check-wrapper {
            width: 70px;
            height: 70px;
            background-color: #d1fae5;
            color: #10b981;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 32px;
        }

        /* Card Ticket Design */
        .card-ticket {
            border: none;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
            background: white;
        }

        .ticket-top {
            background: var(--red-gradient);
            color: white;
            padding: 30px 20px;
            text-align: center;
            position: relative;
        }

        .ticket-top i.fa-heart {
            font-size: 2.5rem;
            margin-bottom: 10px;
            opacity: 0.9;
        }

        .ticket-top h3 {
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .ticket-body {
            padding: 30px;
            text-align: center;
        }

        .badge-status {
            background-color: #ecfdf5;
            color: #059669;
            border: 1px solid #d1fae5;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
            margin-bottom: 25px;
        }

        .qr-code-area {
            width: 160px;
            height: 160px;
            background: #ffffff;
            border: 2px dashed #e2e8f0;
            border-radius: 20px;
            margin: 0 auto 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
        }

        .ticket-id {
            font-weight: 700;
            color: #1e293b;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .ticket-date-created {
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 25px;
        }

        /* Detail Grid */
        .detail-row {
            display: flex;
            flex-wrap: wrap;
            text-align: left;
            border-top: 1px solid #f1f5f9;
            padding-top: 20px;
        }

        .detail-item {
            width: 50%;
            margin-bottom: 20px;
        }

        .detail-item.full-width {
            width: 100%;
        }

        .label {
            font-size: 0.75rem;
            color: #94a3b8;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .value {
            font-weight: 700;
            color: #334155;
            font-size: 0.95rem;
        }

        .value i.fa-droplet {
            color: #ef4444;
        }

        /* Warning Box */
        .warning-card {
            background-color: #fffbeb;
            border-left: 4px solid #f59e0b;
            border-radius: 12px;
            padding: 15px;
            text-align: left;
            display: flex;
            align-items: flex-start;
            margin-top: 10px;
        }

        .warning-card i {
            color: #d97706;
            margin-right: 12px;
            margin-top: 3px;
        }

        .warning-card p {
            margin: 0;
            font-size: 0.85rem;
            color: #92400e;
            line-height: 1.4;
        }

        /* PDF Button */
        .btn-download {
            margin-top: 25px;
            width: 100%;
            border: 2px solid #ef4444;
            color: #ef4444;
            background: transparent;
            font-weight: 700;
            padding: 12px;
            border-radius: 15px;
            transition: 0.3s;
        }

        .btn-download:hover {
            background: #ef4444;
            color: white;
        }

        /* Tips Section */
        .tips-container {
            background: #eff6ff;
            border-radius: 20px;
            padding: 25px;
            margin-top: 25px;
        }

        .tips-container h5 {
            color: #1e40af;
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 15px;
        }

        .tips-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .tips-list li {
            font-size: 0.85rem;
            color: #3b82f6;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .tips-list li i {
            margin-right: 10px;
            font-size: 0.75rem;
        }

        /* Navigation Buttons */
        .nav-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-nav-primary {
            flex: 1;
            background: #ef4444;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 15px;
            font-weight: 600;
        }

        .btn-nav-secondary {
            flex: 1;
            background: #ffffff;
            color: #64748b;
            border: 1px solid #e2e8f0;
            padding: 14px;
            border-radius: 15px;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="ticket-wrapper">
    <?php if (!empty($errorMessage)): ?>
        <div class="alert alert-danger mb-4" role="alert"><?= htmlspecialchars($errorMessage) ?></div>
        <div class="text-center">
            <a href="fromjanjitemu.php" class="btn btn-nav-primary">Kembali Pilih Jadwal</a>
            <a href="dashboard.php" class="btn btn-nav-secondary">Kembali ke Dashboard</a>
        </div>
    <?php else: ?>
    <div class="status-header">
        <div class="icon-check-wrapper">
            <i class="fas fa-check"></i>
        </div>
        <h2 class="fw-bold text-dark mb-1">Janji Temu Terkonfirmasi!</h2>
        <p class="text-muted">E-Ticket Anda telah berhasil dibuat</p>
    </div>

    <div class="card-ticket">
        <div class="ticket-top">
            <i class="fas fa-heart"></i>
            <h3>E-TIKET DONOR</h3>
            <p class="small mb-0 opacity-75">Tunjukkan tiket ini saat tiba di lokasi</p>
        </div>
        
        <div class="ticket-body">
            <div class="badge-status">
                <i class="fas fa-circle-check me-1"></i> Terkonfirmasi
            </div>

            <div class="qr-code-area">
                <i class="fas fa-qrcode fa-5x"></i>
                <span class="mt-2 small fw-bold">QR CODE</span>
            </div>

            <div class="ticket-id">Kode Tiket: <?= htmlspecialchars($ticket['kodeTiket'] ?? '-') ?></div>
            <div class="ticket-date-created">Dibuat pada <?= isset($ticket['createdAt']) ? date('d M Y', strtotime($ticket['createdAt'])) : date('d M Y') ?></div>

            <div class="detail-row">
                <div class="detail-item">
                    <div class="label">Nama Pendonor</div>
                    <div class="value"><?= htmlspecialchars($ticket['username'] ?? '-') ?></div>
                </div>
                <div class="detail-item">
                    <div class="label">Golongan Darah</div>
                    <div class="value"><i class="fas fa-droplet me-1"></i> <?= htmlspecialchars($ticket['golonganDarah'] ?? '-') ?></div>
                </div>
                <div class="detail-item full-width">
                    <div class="label">Lokasi Rumah Sakit</div>
                    <div class="value"><?= htmlspecialchars($ticket['lokasiRS'] ?? '-') ?></div>
                </div>
                <div class="detail-item">
                    <div class="label">Tanggal</div>
                    <div class="value"><?= isset($ticket['tanggalDonor']) ? date('l, d M Y', strtotime($ticket['tanggalDonor'])) : '-' ?></div>
                </div>
                <div class="detail-item">
                    <div class="label">Waktu</div>
                    <div class="value"><?= htmlspecialchars($ticket['waktuDonor'] ? $ticket['waktuDonor'] . ' WIB' : '-') ?></div>
                </div>
            </div>

            <div class="warning-card">
                <i class="fas fa-triangle-exclamation"></i>
                <p><strong>Penting:</strong> Jangan makan makanan berlemak tinggi 3 jam sebelum donor.</p>
            </div>

            <button class="btn btn-download">
                <i class="fas fa-file-pdf me-2"></i> Simpan sebagai PDF
            </button>
        </div>
    </div>

    <div class="tips-container">
        <h5>Tips Sebelum Donor Darah</h5>
        <ul class="tips-list">
            <li><i class="fas fa-check"></i> Makan makanan sehat & minum banyak air</li>
            <li><i class="fas fa-check"></i> Bawa kartu identitas yang masih berlaku</li>
            <li><i class="fas fa-check"></i> Gunakan pakaian nyaman (lengan bisa digulung)</li>
            <li><i class="fas fa-check"></i> Datang 10-15 menit lebih awal untuk registrasi</li>
            <li><i class="fas fa-check"></i> Tidur minimal 5 jam malam sebelumnya</li>
        </ul>
    </div>

    <div class="actions-footer">
        <a href="janjitemu.php" class="btn btn-nav-primary">Lihat Janji Saya</a>
        <a href="dashboard.php" class="btn btn-nav-secondary">Kembali ke Dashboard</a>    
    </div>
    <?php endif; ?>
</div>

</body>
</html>