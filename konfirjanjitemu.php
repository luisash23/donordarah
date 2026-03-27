<?php
// konfirmanjitemu.php - Halaman Konfirmasi Janji Temu Donasi Darah

session_start();

// Data dummy - dalam aplikasi nyata akan dari database
$appointment = [
    'id' => '#BD-1773330970882',
    'status' => 'Terkonfirmasi',
    'donor_name' => 'cc cc',
    'blood_type' => 'A-',
    'location' => 'Bank Darah Rumah Sakit Pusat',
    'date' => 'Kamis, 5 Februari 2026',
    'time' => '15:30 WIB',
    'created_date' => '12 Mar 2026',
    'qr_code' => 'data:image/svg+xml;base64,...', // QR Code image
];

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Janji Temu - Donasi Darah</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            width: 100%;
        }

        .ticket {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .ticket-header {
            background: linear-gradient(135deg, #e63946 0%, #d62828 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .ticket-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .ticket-header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .ticket-body {
            padding: 30px 20px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #d4edda;
            color: #155724;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .status-badge::before {
            content: '✓';
            display: inline-block;
        }

        .qr-section {
            text-align: center;
            margin: 30px 0;
            padding: 20px 0;
            border-top: 1px dashed #ddd;
            border-bottom: 1px dashed #ddd;
        }

        .qr-code {
            width: 150px;
            height: 150px;
            margin: 0 auto;
            background: #f5f5f5;
            border: 2px dashed #ccc;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #999;
        }

        .qr-code img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .id-section {
            text-align: center;
            margin: 20px 0;
        }

        .ticket-id {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }

        .created-date {
            font-size: 12px;
            color: #999;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin: 25px 0;
        }

        .info-section {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            font-weight: 600;
        }

        .info-value {
            font-size: 16px;
            color: #333;
            font-weight: 500;
        }

        .blood-type {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .blood-icon {
            color: #e63946;
            font-size: 20px;
        }

        .donor-name {
            font-size: 14px;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        button {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #e63946;
            color: white;
        }

        .btn-primary:hover {
            background: #d62828;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(230, 57, 70, 0.3);
        }

        .btn-secondary {
            background: #f5f5f5;
            color: #333;
            border: 1px solid #ddd;
        }

        .btn-secondary:hover {
            background: #efefef;
        }

        .divider {
            height: 1px;
            background: #eee;
            margin: 20px 0;
        }

        .notes {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
            font-size: 13px;
            color: #856404;
        }

        .notes strong {
            display: block;
            margin-bottom: 5px;
        }

        @media (max-width: 480px) {
            .ticket-header h1 {
                font-size: 24px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="ticket">
            <!-- Header -->
            <div class="ticket-header">
                <h1>❤️ E-TIKET DONOR</h1>
                <p>Tunjukkan tiket ini saat tiba di lokasi</p>
            </div>

            <!-- Body -->
            <div class="ticket-body">
                <!-- Status -->
                <div class="status-badge">Terkonfirmasi</div>

                <!-- QR Code Section -->
                <div class="qr-section">
                    <div class="qr-code">
                        <!-- QR Code akan ditampilkan di sini -->
                        📱 QR Code
                    </div>
                </div>

                <!-- ID Section -->
                <div class="id-section">
                    <div class="ticket-id">ID: <?php echo $appointment['id']; ?></div>
                    <div class="created-date">Dibuat pada <?php echo $appointment['created_date']; ?></div>
                </div>

                <div class="divider"></div>

                <!-- Info Grid -->
                <div class="info-grid">
                    <!-- Donor Info -->
                    <div>
                        <div class="info-label">Nama Pendonor</div>
                        <div class="info-value donor-name">
                            <?php echo htmlspecialchars($appointment['donor_name']); ?>
                        </div>
                    </div>

                    <!-- Blood Type -->
                    <div>
                        <div class="info-label">Golongan Darah</div>
                        <div class="info-value blood-type">
                            <span class="blood-icon">🩸</span>
                            <?php echo htmlspecialchars($appointment['blood_type']); ?>
                        </div>
                    </div>

                    <!-- Location -->
                    <div>
                        <div class="info-label">Lokasi Rumah Sakit</div>
                        <div class="info-value">
                            <?php echo htmlspecialchars($appointment['location']); ?>
                        </div>
                    </div>

                    <!-- Date -->
                    <div>
                        <div class="info-label">Tanggal</div>
                        <div class="info-value">
                            <?php echo htmlspecialchars($appointment['date']); ?>
                        </div>
                    </div>

                    <!-- Time -->
                    <div>
                        <div class="info-label">Waktu</div>
                        <div class="info-value">
                            <?php echo htmlspecialchars($appointment['time']); ?>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="divider"></div>

                <!-- Important Notes -->
                <div class="notes">
                    <strong>⚠️ Catatan Penting:</strong>
                    Harap datang 15 menit sebelum jadwal yang ditentukan. Bawa identitas diri dan kartu donor jika ada.
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button class="btn-primary" onclick="printTicket()">Cetak Tiket</button>
                    <button class="btn-secondary" onclick="shareTicket()">Bagikan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printTicket() {
            window.print();
        }

        function shareTicket() {
            if (navigator.share) {
                navigator.share({
                    title: 'E-Tiket Donor Darah',
                    text: 'Janji temu donasi darah saya - ID: #BD-1773330970882',
                    url: window.location.href
                });
            } else {
                alert('Fitur bagikan tidak tersedia di browser Anda');
            }
        }

        // Redirect if not confirmed
        document.addEventListener('DOMContentLoaded', function() {
            // Bisa ditambahkan validasi session di sini
            console.log('Halaman konfirmasi janji temu dimuat');
        });
    </script>
</body>
</html>