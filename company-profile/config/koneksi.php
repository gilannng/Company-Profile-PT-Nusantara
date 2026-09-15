<?php
// Inisialisasi Sesi secara aman
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Konfigurasi Kredensial Database
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "db_companyprofile";

// Menonaktifkan laporan error bawaan driver mysqli yang bisa memicu fatal crash
mysqli_report(MYSQLI_REPORT_OFF);

// Melakukan koneksi ke database MySQL
$koneksi = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Penanganan Jika Koneksi Gagal (User-Friendly Diagnostic untuk Presentasi)
if (!$koneksi) {
    $error_msg = mysqli_connect_error();
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Koneksi Database Belum Terhubung - PT Digital Solusi Nusantara</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <style>
            body {
                background-color: #F8F9FA;
                color: #212529;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            .diagnostic-card {
                background: #FFFFFF;
                border-radius: 16px;
                border: 1px solid #E2E8F0;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
                max-width: 650px;
                width: 100%;
                padding: 35px;
            }
            .tech-badge {
                background: #E8F5E9;
                color: #03AC0E;
                border: 1px solid rgba(3, 172, 14, 0.3);
                padding: 6px 14px;
                border-radius: 50px;
                font-size: 0.85rem;
                font-weight: 600;
                display: inline-block;
            }
            .code-box {
                background: #F1F5F9;
                border: 1px solid #CBD5E1;
                border-radius: 8px;
                padding: 12px 16px;
                color: #B91C1C;
                font-family: monospace;
                font-size: 0.85rem;
            }
        </style>
    </head>
    <body>
        <div class="diagnostic-card text-center">
            <div class="mb-3">
                <span class="tech-badge"><i class="fa-solid fa-database me-2"></i>Status Koneksi Database</span>
            </div>
            <h3 class="fw-bold mb-3 text-dark">Database Belum Terhubung</h3>
            <p class="text-muted mb-4">
                Sistem mendeteksi bahwa basis data <code>db_companyprofile</code> belum aktif atau service MySQL belum dijalankan.
            </p>
            <div class="text-start mb-4 p-3 bg-light rounded-3 border">
                <h6 class="text-dark fw-semibold mb-2"><i class="fa-solid fa-circle-check text-success me-2"></i>Panduan Penyiapan:</h6>
                <ol class="text-muted ps-3 mb-0" style="line-height: 1.8; font-size: 0.95rem;">
                    <li>Buka <strong>XAMPP Control Panel</strong> lalu klik <strong>Start</strong> pada modul <strong>MySQL</strong>.</li>
                    <li>Buka <code>http://localhost/phpmyadmin</code> di peramban.</li>
                    <li>Buat basis data baru bernama <code>db_companyprofile</code>.</li>
                    <li>Impor berkas <code>database.sql</code> yang tersedia di folder proyek ini.</li>
                    <li>Muat ulang (Refresh) halaman ini.</li>
                </ol>
            </div>
            <div class="code-box text-start mb-4">
                <small class="text-secondary d-block mb-1 font-sans">Rincian Error MySQL:</small>
                <span><?= htmlspecialchars($error_msg); ?></span>
            </div>
            <button onclick="window.location.reload();" class="btn text-white px-4 py-2 fw-semibold shadow-sm" style="background-color: #03AC0E; border: none; border-radius: 8px;">
                <i class="fa-solid fa-rotate-right me-2"></i>Coba Hubungkan Kembali
            </button>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Set karakter encoding ke utf8mb4
mysqli_set_charset($koneksi, "utf8mb4");

// Inisialisasi Otomatis Tabel Pesan / Kontak Masuk jika belum ada
mysqli_query($koneksi, "CREATE TABLE IF NOT EXISTS `pesan` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(150) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `telepon` VARCHAR(50) DEFAULT NULL,
  `perusahaan` VARCHAR(150) DEFAULT NULL,
  `layanan` VARCHAR(150) DEFAULT NULL,
  `subjek` VARCHAR(200) DEFAULT NULL,
  `pesan` TEXT NOT NULL,
  `status` VARCHAR(20) NOT NULL DEFAULT 'Belum Dibaca',
  `tanggal` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

/**
 * Helper Fungsi Sanitasi Input untuk mencegah SQL Injection & XSS
 */
function clean_input($data) {
    global $koneksi;
    if (is_array($data)) {
        return array_map('clean_input', $data);
    }
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return mysqli_real_escape_string($koneksi, $data);
}

/**
 * Helper Menampilkan Pesan Flash Alert
 */
function set_flash_message($type, $message) {
    $_SESSION['flash_message'] = [
        'type' => $type, // 'success', 'danger', 'warning', 'info'
        'text' => $message
    ];
}

function show_flash_message() {
    if (isset($_SESSION['flash_message'])) {
        $msg = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        $alert_type = $msg['type'];
        $icon = 'fa-info-circle';
        if ($alert_type === 'success') $icon = 'fa-check-circle';
        if ($alert_type === 'danger') $icon = 'fa-circle-exclamation';
        if ($alert_type === 'warning') $icon = 'fa-triangle-exclamation';

        echo '<div class="alert alert-' . $alert_type . ' alert-dismissible fade show shadow-sm border-0 d-flex align-items-center" role="alert">';
        echo '  <i class="fa-solid ' . $icon . ' me-2 fs-5"></i>';
        echo '  <div>' . $msg['text'] . '</div>';
        echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
}
