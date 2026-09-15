<?php
require_once __DIR__ . '/../../config/koneksi.php';

$admin_title = "Tambah Layanan IT - CMS";
$active_menu = "produk";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_simpan'])) {
    $nama_layanan = clean_input($_POST['nama_layanan'] ?? '');
    $deskripsi    = clean_input($_POST['deskripsi'] ?? '');

    if (empty($nama_layanan) || empty($deskripsi)) {
        set_flash_message('danger', 'Nama layanan dan deskripsi wajib diisi!');
    } else {
        $nama_gambar = 'layanan_webdev.svg'; // Default fallback

        // Cek apakah ada file yang diunggah
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $file_tmp  = $_FILES['gambar']['tmp_name'];
            $file_name = $_FILES['gambar']['name'];
            $file_size = $_FILES['gambar']['size'];
            $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            $allowed_ext = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

            if (!in_array($file_ext, $allowed_ext)) {
                set_flash_message('danger', 'Format gambar tidak didukung! Gunakan format JPG, PNG, WEBP, atau SVG.');
                header("Location: tambah.php");
                exit;
            }

            if ($file_size > 2 * 1024 * 1024) { // 2MB
                set_flash_message('danger', 'Ukuran gambar maksimal adalah 2MB!');
                header("Location: tambah.php");
                exit;
            }

            $nama_gambar = 'layanan_' . time() . '_' . rand(100, 999) . '.' . $file_ext;
            $upload_path = __DIR__ . '/../../assets/img/uploads/' . $nama_gambar;

            if (!move_uploaded_file($file_tmp, $upload_path)) {
                set_flash_message('danger', 'Gagal memindahkan file upload gambar ke server.');
                header("Location: tambah.php");
                exit;
            }
        }

        $sql = "INSERT INTO produk (nama_layanan, deskripsi, gambar) VALUES ('$nama_layanan', '$deskripsi', '$nama_gambar')";
        if (mysqli_query($koneksi, $sql)) {
            set_flash_message('success', 'Layanan IT baru berhasil ditambahkan.');
            header("Location: index.php");
            exit;
        } else {
            set_flash_message('danger', 'Gagal menambahkan layanan: ' . mysqli_error($koneksi));
        }
    }
}

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-2xl">add_circle</span>
            Tambah Layanan Baru
        </h4>
        <p class="text-muted small mb-0">Tambahkan portofolio layanan IT baru ke dalam sistem.</p>
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
        <form action="tambah.php" method="POST" enctype="multipart/form-data">
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Nama Layanan IT <span class="text-danger">*</span></label>
                        <input type="text" name="nama_layanan" class="form-control form-control-lg fs-6" placeholder="Contoh: Cloud Migration & Kubernetes Orchestration" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Deskripsi Lengkap Solusi <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" rows="6" class="form-control fs-6" placeholder="Jelaskan spesifikasi layanan, fitur utama, dan nilai tambah yang diberikan bagi klien..." required></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 bg-light rounded-3 border">
                        <label class="form-label fw-semibold text-dark small">Unggah Gambar Thumbnail</label>
                        <input type="file" name="gambar" class="form-control image-upload-preview-input mb-3" data-preview-target="previewUpload" accept=".jpg,.jpeg,.png,.webp,.svg">
                        <small class="text-muted d-block mb-3">Format: JPG, PNG, WEBP, atau SVG. Maksimal 2MB.</small>
                        
                        <div class="text-center">
                            <img id="previewUpload" src="../../assets/img/uploads/layanan_webdev.svg" alt="Preview Gambar" class="img-fluid rounded border shadow-sm" style="max-height: 180px; object-fit: cover;">
                        </div>
                    </div>
                </div>

                <div class="col-12 text-end pt-3 border-top">
                    <a href="index.php" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" name="btn_simpan" class="btn btn-cyber px-4 py-2 fw-bold">
                        <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Layanan Baru
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
