<?php
require_once __DIR__ . '/../../config/koneksi.php';

$admin_title = "Tulis Artikel Baru - CMS";
$active_menu = "artikel";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_simpan'])) {
    $judul     = clean_input($_POST['judul'] ?? '');
    $ringkasan = clean_input($_POST['ringkasan'] ?? '');
    $tanggal   = clean_input($_POST['tanggal'] ?? date('Y-m-d'));

    if (empty($judul) || empty($ringkasan) || empty($tanggal)) {
        set_flash_message('danger', 'Judul, ringkasan/isi, dan tanggal artikel wajib diisi!');
    } else {
        $sql = "INSERT INTO artikel (judul, ringkasan, tanggal) VALUES ('$judul', '$ringkasan', '$tanggal')";
        if (mysqli_query($koneksi, $sql)) {
            set_flash_message('success', 'Artikel teknologi baru berhasil diterbitkan.');
            header("Location: index.php");
            exit;
        } else {
            set_flash_message('danger', 'Gagal menyimpan artikel: ' . mysqli_error($koneksi));
        }
    }
}

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-2xl">post_add</span>
            Tulis Artikel Baru
        </h4>
        <p class="text-muted small mb-0">Publikasikan wawasan teknologi informasi atau ulasan teknis terkini.</p>
    </div>
    <div>
        <a href="index.php" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg bg-surface-container-low hover:bg-surface-container-high text-text-primary text-xs font-semibold border border-subtle-border transition-colors">
            <span class="material-symbols-outlined text-base">arrow_back</span>
            Kembali ke Daftar
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-xl overflow-hidden mb-4">
    <div class="card-body p-4 sm:p-5 md:p-6">
        <form action="tambah.php" method="POST">
            <div class="row g-4">
                <div class="col-md-9">
                    <label class="form-label fw-semibold text-dark small">Judul Artikel <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control form-control-lg fs-6" placeholder="Contoh: Mengoptimalkan Performa Database Relasional untuk Beban Kerja Tinggi" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold text-dark small">Tanggal Publikasi <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" class="form-control form-control-lg fs-6" value="<?= date('Y-m-d'); ?>" required>
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold text-dark small">Konten / Ringkasan Edukasi Lengkap <span class="text-danger">*</span></label>
                    <textarea name="ringkasan" rows="8" class="form-control fs-6" placeholder="Tuliskan ulasan, latar belakang masalah, metodologi pemecahan, dan rekomendasi teknis secara komprehensif..." required></textarea>
                </div>

                <div class="col-12 text-end pt-3 border-top">
                    <a href="index.php" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" name="btn_simpan" class="btn btn-cyber px-4 py-2 fw-bold">
                        <i class="fa-solid fa-paper-plane me-2"></i> Terbitkan Artikel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
