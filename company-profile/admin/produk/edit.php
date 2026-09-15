<?php
require_once __DIR__ . '/../../config/koneksi.php';

$admin_title = "Edit Layanan IT - CMS";
$active_menu = "produk";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id = $id LIMIT 1");

if (!$query || mysqli_num_rows($query) === 0) {
    set_flash_message('danger', 'Data layanan tidak ditemukan!');
    header("Location: index.php");
    exit;
}

$data = mysqli_fetch_assoc($query);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_update'])) {
    $nama_layanan = clean_input($_POST['nama_layanan'] ?? '');
    $deskripsi = clean_input($_POST['deskripsi'] ?? '');

    if (empty($nama_layanan) || empty($deskripsi)) {
        set_flash_message('danger', 'Nama layanan dan deskripsi wajib diisi!');
    } else {
        $nama_gambar = $data['gambar']; // Pertahankan gambar lama secara default

        // Jika pengguna mengunggah gambar baru
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['gambar']['tmp_name'];
            $file_name = $_FILES['gambar']['name'];
            $file_size = $_FILES['gambar']['size'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            $allowed_ext = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

            if (!in_array($file_ext, $allowed_ext)) {
                set_flash_message('danger', 'Format gambar tidak didukung! Gunakan format JPG, PNG, WEBP, atau SVG.');
                header("Location: edit.php?id=$id");
                exit;
            }

            if ($file_size > 2 * 1024 * 1024) {
                set_flash_message('danger', 'Ukuran gambar maksimal adalah 2MB!');
                header("Location: edit.php?id=$id");
                exit;
            }

            $nama_gambar = 'layanan_' . time() . '_' . rand(100, 999) . '.' . $file_ext;
            $upload_path = __DIR__ . '/../../assets/img/uploads/' . $nama_gambar;

            if (move_uploaded_file($file_tmp, $upload_path)) {
                // Hapus gambar lama jika ada dan bukan berkas SVG preset default
                $old_file = __DIR__ . '/../../assets/img/uploads/' . $data['gambar'];
                if (file_exists($old_file) && strpos($data['gambar'], 'layanan_') === 0 && strpos($data['gambar'], '_') !== false && !in_array($data['gambar'], ['layanan_webdev.svg', 'layanan_jaringan.svg', 'layanan_security.svg', 'layanan_cloud.svg', 'layanan_konsultan.svg', 'layanan_managed.svg'])) {
                    @unlink($old_file);
                }
            }
        }

        $sql = "UPDATE produk SET nama_layanan = '$nama_layanan', deskripsi = '$deskripsi', gambar = '$nama_gambar' WHERE id = $id";
        if (mysqli_query($koneksi, $sql)) {
            set_flash_message('success', 'Data layanan IT berhasil diperbarui.');
            header("Location: index.php");
            exit;
        } else {
            set_flash_message('danger', 'Gagal memperbarui layanan: ' . mysqli_error($koneksi));
        }
    }
}

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-2xl">edit_square</span>
            Edit Layanan IT
        </h4>
        <p class="text-muted small mb-0">Perbarui rincian atau ganti foto pendukung layanan.</p>
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
        <form action="edit.php?id=<?= $id; ?>" method="POST" enctype="multipart/form-data">
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Nama Layanan IT <span
                                class="text-danger">*</span></label>
                        <input type="text" name="nama_layanan" class="form-control form-control-lg fs-6"
                            value="<?= htmlspecialchars($data['nama_layanan']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Deskripsi Lengkap Solusi <span
                                class="text-danger">*</span></label>
                        <textarea name="deskripsi" rows="6" class="form-control fs-6"
                            required><?= htmlspecialchars($data['deskripsi']); ?></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 bg-light rounded-3 border">
                        <label class="form-label fw-semibold text-dark small">Ganti Gambar Thumbnail</label>
                        <input type="file" name="gambar" class="form-control image-upload-preview-input mb-3"
                            data-preview-target="previewUpload" accept=".jpg,.jpeg,.png,.webp,.svg">
                        <small class="text-muted d-block mb-3">Biarkan kosong jika tidak ingin mengubah gambar.</small>

                        <div class="text-center">
                            <img id="previewUpload"
                                src="../../assets/img/uploads/<?= htmlspecialchars($data['gambar']); ?>"
                                alt="Preview Gambar" class="img-fluid rounded border shadow-sm"
                                style="max-height: 180px; object-fit: cover;">
                        </div>
                    </div>
                </div>

                <div class="col-12 text-end pt-3 border-top">
                    <a href="index.php" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" name="btn_update" class="btn btn-cyber px-4 py-2 fw-bold">
                        <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>