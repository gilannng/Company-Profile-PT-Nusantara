<?php
require_once __DIR__ . '/../config/koneksi.php';

// Jika sudah login, langsung alihkan ke dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: dashboard.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = clean_input($_POST['username'] ?? '');
    $password = clean_input($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $error = 'Username dan kata sandi wajib diisi!';
    } else {
        // Enkripsi MD5 sesuai skema tabel admin database.sql
        $password_hash = md5($password);

        $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password_hash' LIMIT 1";
        $result = mysqli_query($koneksi, $query);

        if ($result && mysqli_num_rows($result) === 1) {
            $admin = mysqli_fetch_assoc($result);

            // Simpan identitas ke dalam sesi
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_logged']    = true;
            $_SESSION['admin_id']        = $admin['id'];
            $_SESSION['admin_username']  = $admin['username'];
            $_SESSION['admin_nama']      = $admin['nama_lengkap'];

            set_flash_message('success', 'Selamat datang kembali, <strong>' . htmlspecialchars($admin['nama_lengkap']) . '</strong> di Panel CMS PT Digital Solusi Nusantara.');
            header("Location: dashboard.php");
            exit;
        } else {
            $error = 'Kombinasi username atau kata sandi tidak valid. Silakan periksa kembali.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Administrator - PT Digital Solusi Nusantara</title>
  
  <!-- Google Fonts: Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="../assets/img/logo.svg">

  <style>
    :root {
      --dsn-primary-green: #03AC0E;
      --dsn-green-hover: #00880D;
      --dsn-green-mint: #E8F5E9;
      --dsn-bg-slate: #F1F5F9;
      --dsn-text-dark: #212529;
      --dsn-text-muted: #64748B;
      --dsn-border-subtle: #E2E8F0;
    }

    body {
      font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
      background-color: var(--dsn-bg-slate);
      color: var(--dsn-text-dark);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      margin: 0;
      padding: 0;
    }

    .login-container {
      flex: 1 0 auto;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2.5rem 1.25rem;
    }

    .auth-card {
      background: #FFFFFF;
      border: 1px solid var(--dsn-border-subtle);
      border-radius: 12px;
      box-shadow: 0 4px 20px -4px rgba(0, 0, 0, 0.06), 0 2px 6px -1px rgba(0, 0, 0, 0.04);
      width: 100%;
      max-width: 440px;
      padding: 2.5rem 2.25rem;
      transition: all 0.2s ease-in-out;
    }

    .brand-header-link {
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.65rem;
      margin-bottom: 1.75rem;
    }

    .brand-icon-box {
      width: 38px;
      height: 38px;
      background-color: var(--dsn-primary-green);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #FFFFFF;
      font-weight: 800;
      font-size: 1.25rem;
      box-shadow: 0 2px 6px rgba(3, 172, 14, 0.25);
    }

    .brand-meta {
      text-align: left;
    }

    .brand-name {
      font-weight: 700;
      font-size: 1.05rem;
      color: var(--dsn-text-dark);
      line-height: 1.2;
    }

    .brand-tagline {
      font-size: 0.72rem;
      color: var(--dsn-text-muted);
      letter-spacing: 0.02em;
    }

    .icon-circle-badge {
      width: 52px;
      height: 52px;
      background-color: var(--dsn-green-mint);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.25rem;
      color: var(--dsn-primary-green);
      font-size: 1.45rem;
    }

    .form-label {
      font-weight: 600;
      font-size: 0.865rem;
      color: #334155;
      margin-bottom: 0.45rem;
    }

    .input-group-text {
      background-color: #FFFFFF;
      border-color: var(--dsn-border-subtle);
      color: var(--dsn-text-muted);
      border-right: none;
      padding-left: 0.9rem;
      padding-right: 0.6rem;
    }

    .form-control {
      border-color: var(--dsn-border-subtle);
      border-left: none;
      font-size: 0.925rem;
      padding: 0.68rem 0.9rem 0.68rem 0.25rem;
      color: var(--dsn-text-dark);
    }

    .form-control:focus {
      border-color: var(--dsn-primary-green);
      box-shadow: 0 0 0 3px rgba(3, 172, 14, 0.12);
    }

    .input-group:focus-within .input-group-text {
      border-color: var(--dsn-primary-green);
      color: var(--dsn-primary-green);
    }

    .btn-toggle-password {
      border-color: var(--dsn-border-subtle);
      border-left: none;
      background: #FFFFFF;
      color: var(--dsn-text-muted);
      font-size: 0.95rem;
      padding: 0 0.85rem;
    }

    .btn-toggle-password:hover {
      color: var(--dsn-text-dark);
    }

    .btn-primary-green {
      background-color: var(--dsn-primary-green);
      color: #FFFFFF;
      font-weight: 600;
      font-size: 0.95rem;
      padding: 0.72rem 1.25rem;
      border-radius: 8px;
      border: 1px solid var(--dsn-primary-green);
      transition: all 0.2s ease-in-out;
      box-shadow: 0 2px 6px rgba(3, 172, 14, 0.2);
    }

    .btn-primary-green:hover, .btn-primary-green:focus {
      background-color: var(--dsn-green-hover);
      border-color: var(--dsn-green-hover);
      color: #FFFFFF;
      box-shadow: 0 4px 10px rgba(0, 136, 13, 0.3);
    }

    .back-home-link {
      color: var(--dsn-text-muted);
      font-weight: 600;
      font-size: 0.875rem;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      transition: color 0.15s ease;
    }

    .back-home-link:hover {
      color: var(--dsn-primary-green);
      text-decoration: none;
    }

    .auth-footer-notice {
      border-top: 1px solid var(--dsn-border-subtle);
      padding-top: 1.25rem;
      margin-top: 1.5rem;
      font-size: 0.775rem;
      color: #94A3B8;
      text-align: center;
    }

    .security-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
      font-size: 0.75rem;
      color: #047857;
      background: #ECFDF5;
      padding: 0.25rem 0.65rem;
      border-radius: 20px;
      border: 1px solid #A7F3D0;
      margin-bottom: 1.25rem;
    }
  </style>
</head>
<body>

  <!-- Bagian formulir login -->
  <div class="login-container">
    <div class="auth-card text-center">
      
      <!-- Identitas perusahaan -->
      <a href="../index.php" class="brand-header-link" title="Kembali ke PT Digital Solusi Nusantara">
        <div class="brand-icon-box">
          <i class="bi bi-cpu-fill" style="font-size: 1.15rem;"></i>
        </div>
        <div class="brand-meta">
          <div class="brand-name">Digital Solusi Nusantara</div>
          <div class="brand-tagline">Enterprise Technology &amp; IT Solutions</div>
        </div>
      </a>

      <!-- Status enkripsi & keamanan -->
      <div>
        <div class="security-badge">
          <i class="bi bi-shield-check"></i> Enkripsi TLS 1.3 &amp; Sistem Aman
        </div>
      </div>

      <!-- Ikon gembok & judul login -->
      <div class="icon-circle-badge">
        <i class="bi bi-lock-fill"></i>
      </div>
      
      <h1 class="h4 fw-bold text-dark mb-1" style="letter-spacing: -0.01em;">Login Administrator</h1>
      <p class="text-muted small mb-4">Masuk ke panel manajemen konten dan operasional sistem perusahaan.</p>

      <?php show_flash_message(); ?>

      <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show text-start py-2 px-3 mb-3 border-0 d-flex align-items-center" role="alert" style="background-color: #FEE2E2; color: #991B1B; font-size: 0.85rem;">
          <i class="bi bi-exclamation-triangle-fill me-2 fs-6"></i>
          <div><?= $error; ?></div>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 0.75rem;"></button>
        </div>
      <?php endif; ?>

      <!-- Formulir login admin -->
      <form class="text-start" action="login.php" method="POST">
        
        <!-- Input username -->
        <div class="mb-3">
          <label for="usernameInput" class="form-label">Username atau Email Resmi</label>
          <div class="input-group">
            <span class="input-group-text" id="user-addon">
              <i class="bi bi-person"></i>
            </span>
            <input type="text" 
                   name="username" 
                   class="form-control" 
                   id="usernameInput" 
                   placeholder="Masukkan username" 
                   value="<?= htmlspecialchars($_POST['username'] ?? ''); ?>" 
                   aria-describedby="user-addon" 
                   required 
                   autocomplete="username" 
                   autofocus>
          </div>
        </div>

        <!-- Input kata sandi -->
        <div class="mb-3">
          <div class="d-flex justify-content-between align-items-center mb-1">
            <label for="passwordInput" class="form-label mb-0">Kata Sandi</label>
          </div>
          <div class="input-group">
            <span class="input-group-text" id="lock-addon">
              <i class="bi bi-key"></i>
            </span>
            <input type="password" 
                   name="password" 
                   class="form-control" 
                   id="passwordInput" 
                   placeholder="Masukkan kata sandi" 
                   aria-describedby="lock-addon" 
                   required 
                   autocomplete="current-password">
            <button class="btn btn-outline-secondary btn-toggle-password" 
                    type="button" 
                    onclick="togglePasswordVisibility()">
              <i id="eyeIcon" class="bi bi-eye"></i>
            </button>
          </div>
        </div>

        <!-- Opsi ingat saya & status 2FA -->
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember_me" style="accent-color: var(--dsn-primary-green);">
            <label class="form-check-label text-muted small" for="rememberMe" style="font-size: 0.82rem;">
              Ingat perangkat ini
            </label>
          </div>
          <span class="badge bg-light text-secondary border px-2 py-1" style="font-size: 0.7rem; font-weight: 500;">
            <i class="bi bi-fingerprint"></i> 2FA Ready
          </span>
        </div>

        <!-- Tombol kirim login -->
        <button type="submit" name="btn_login" class="btn btn-primary-green w-100 mb-3 d-flex align-items-center justify-content-center gap-2">
          <span>Masuk ke Panel Admin</span>
          <i class="bi bi-arrow-right-short fs-5"></i>
        </button>

      </form>

      <!-- Tombol kembali ke beranda -->
      <div class="mt-3 text-center">
        <a href="../index.php" class="back-home-link">
          <i class="bi bi-arrow-left"></i>
          <span>Kembali ke Beranda Utama</span>
        </a>
      </div>

      <!-- Catatan hak cipta & akses sistem -->
      <div class="auth-footer-notice">
        <div class="d-flex justify-content-center align-items-center gap-2 mb-1">
          <i class="bi bi-shield-lock text-success"></i>
          <span>Akses Terbatas: Hanya Karyawan Terotorisasi</span>
        </div>
        <div>&copy; <?= date('Y'); ?> PT Digital Solusi Nusantara. Hak Cipta Dilindungi.</div>
      </div>

    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  function togglePasswordVisibility() {
      const p = document.getElementById('passwordInput');
      const icon = document.getElementById('eyeIcon');
      if (p.type === 'password') {
          p.type = 'text';
          icon.classList.replace('bi-eye', 'bi-eye-slash');
      } else {
          p.type = 'password';
          icon.classList.replace('bi-eye-slash', 'bi-eye');
      }
  }
  </script>
</body>
</html>
