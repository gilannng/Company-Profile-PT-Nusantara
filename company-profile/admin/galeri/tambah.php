<?php
require_once __DIR__ . '/../../config/koneksi.php';

$admin_title = "Unggah Foto Galeri - CMS";
$active_menu = "galeri";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_simpan'])) {
    $judul = clean_input($_POST['judul'] ?? '');

    if (empty($judul)) {
        set_flash_message('danger', 'Judul foto dokumentasi wajib diisi!');
    } else {
        $nama_foto = 'galeri_datacenter.svg'; // Default fallback

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $file_tmp  = $_FILES['foto']['tmp_name'];
            $file_name = $_FILES['foto']['name'];
            $file_size = $_FILES['foto']['size'];
            $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            $allowed_ext = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

            if (!in_array($file_ext, $allowed_ext)) {
                set_flash_message('danger', 'Format gambar tidak didukung! Gunakan format JPG, PNG, WEBP, atau SVG.');
                header("Location: tambah.php");
                exit;
            }

            if ($file_size > 3 * 1024 * 1024) { // 3MB
                set_flash_message('danger', 'Ukuran gambar maksimal adalah 3MB!');
                header("Location: tambah.php");
                exit;
            }

            $nama_foto = 'galeri_' . time() . '_' . rand(100, 999) . '.' . $file_ext;
            $upload_path = __DIR__ . '/../../assets/img/uploads/' . $nama_foto;

            if (!move_uploaded_file($file_tmp, $upload_path)) {
                set_flash_message('danger', 'Gagal memindahkan file upload foto ke direktori server.');
                header("Location: tambah.php");
                exit;
            }
        }

        $sql = "INSERT INTO galeri (judul, foto) VALUES ('$judul', '$nama_foto')";
        if (mysqli_query($koneksi, $sql)) {
            set_flash_message('success', 'Foto dokumentasi baru berhasil ditambahkan ke galeri.');
            header("Location: index.php");
            exit;
        } else {
            set_flash_message('danger', 'Gagal menyimpan foto galeri: ' . mysqli_error($koneksi));
        }
    }
}

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-2xl">add_photo_alternate</span>
            Unggah Foto Galeri
        </h4>
        <p class="text-muted small mb-0">Tambahkan dokumentasi foto kegiatan teknis dan proyek ke dalam sistem.</p>
    </div>
    <div>
        <a href="index.php" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg bg-surface-container-low hover:bg-surface-container-high text-text-primary text-xs font-semibold border border-subtle-border transition-colors">
            <span class="material-symbols-outlined text-base">arrow_back</span>
            Kembali ke Galeri
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-xl overflow-hidden mb-4">
    <div class="card-body p-4 sm:p-5 md:p-6">
        <form action="tambah.php" method="POST" enctype="multipart/form-data">
            <div class="row g-4">
                <div class="col-md-7">
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark small">Judul / Keterangan Foto Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control form-control-lg fs-6" placeholder="Contoh: Implementasi Firewall Perimeter dan Router Core di Bank BUMN" required>
                    </div>

                    <div class="p-3 bg-light rounded-3 border">
                        <label class="form-label fw-semibold text-dark small">Pilih Berkas Foto <span class="text-danger">*</span></label>
                        <input type="file" name="foto" class="form-control image-upload-preview-input" data-preview-target="previewGaleri" accept=".jpg,.jpeg,.png,.webp,.svg" required>
                        <div class="form-text text-muted small mt-2">
                            Format yang didukung: JPG, JPEG, PNG, WEBP, SVG. Maksimal ukuran 3MB.
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="p-3 bg-light rounded-3 border text-center h-100 d-flex flex-column justify-content-center">
                        <small class="text-muted fw-semibold d-block mb-2">Pratinjau Foto</small>
                        <img id="previewGaleri" src="../../assets/img/uploads/galeri_datacenter.svg" alt="Preview Foto" class="img-fluid rounded border shadow-sm mx-auto" style="max-height: 220px; width: 100%; object-fit: cover;">
                    </div>
                </div>

                <div class="col-12 text-end pt-3 border-top">
                    <a href="index.php" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" name="btn_simpan" class="btn btn-cyber px-4 py-2 fw-bold">
                        <i class="fa-solid fa-cloud-arrow-up me-2"></i> Unggah Foto
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
