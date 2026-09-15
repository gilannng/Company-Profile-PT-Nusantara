<?php
require_once __DIR__ . '/../../config/koneksi.php';

$admin_title = "Edit Foto Galeri - CMS";
$active_menu = "galeri";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$query = mysqli_query($koneksi, "SELECT * FROM galeri WHERE id = $id LIMIT 1");

if (!$query || mysqli_num_rows($query) === 0) {
    set_flash_message('danger', 'Data foto galeri tidak ditemukan!');
    header("Location: index.php");
    exit;
}

$data = mysqli_fetch_assoc($query);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_update'])) {
    $judul = clean_input($_POST['judul'] ?? '');

    if (empty($judul)) {
        set_flash_message('danger', 'Judul foto dokumentasi wajib diisi!');
    } else {
        $nama_foto = $data['foto']; // Pertahankan foto lama

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $file_tmp  = $_FILES['foto']['tmp_name'];
            $file_name = $_FILES['foto']['name'];
            $file_size = $_FILES['foto']['size'];
            $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            $allowed_ext = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

            if (!in_array($file_ext, $allowed_ext)) {
                set_flash_message('danger', 'Format gambar tidak didukung! Gunakan format JPG, PNG, WEBP, atau SVG.');
                header("Location: edit.php?id=$id");
                exit;
            }

            if ($file_size > 3 * 1024 * 1024) {
                set_flash_message('danger', 'Ukuran foto maksimal adalah 3MB!');
                header("Location: edit.php?id=$id");
                exit;
            }

            $nama_foto = 'galeri_' . time() . '_' . rand(100, 999) . '.' . $file_ext;
            $upload_path = __DIR__ . '/../../assets/img/uploads/' . $nama_foto;

            if (move_uploaded_file($file_tmp, $upload_path)) {
                $old_file = __DIR__ . '/../../assets/img/uploads/' . $data['foto'];
                $default_presets = ['galeri_datacenter.svg','galeri_workshop.svg','galeri_meeting.svg','galeri_noc.svg','galeri_mou.svg','galeri_audit.svg'];
                if (file_exists($old_file) && !in_array($data['foto'], $default_presets)) {
                    @unlink($old_file);
                }
            }
        }

        $sql = "UPDATE galeri SET judul = '$judul', foto = '$nama_foto' WHERE id = $id";
        if (mysqli_query($koneksi, $sql)) {
            set_flash_message('success', 'Foto dokumentasi kegiatan berhasil diperbarui.');
            header("Location: index.php");
            exit;
        } else {
            set_flash_message('danger', 'Gagal memperbarui galeri: ' . mysqli_error($koneksi));
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
            Edit Foto Galeri
        </h4>
        <p class="text-muted small mb-0">Perbarui judul atau ganti file foto dokumentasi kegiatan.</p>
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
        <form action="edit.php?id=<?= $id; ?>" method="POST" enctype="multipart/form-data">
            <div class="row g-4">
                <div class="col-md-7">
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark small">Judul / Keterangan Foto Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control form-control-lg fs-6" value="<?= htmlspecialchars($data['judul']); ?>" required>
                    </div>

                    <div class="p-3 bg-light rounded-3 border">
                        <label class="form-label fw-semibold text-dark small">Ganti Berkas Foto</label>
                        <input type="file" name="foto" class="form-control image-upload-preview-input" data-preview-target="previewGaleri" accept=".jpg,.jpeg,.png,.webp,.svg">
                        <div class="form-text text-muted small mt-2">
                            Kosongkan jika tidak ingin mengubah foto. Format: JPG, PNG, WEBP, SVG (Maksimal 3MB).
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="p-3 bg-light rounded-3 border text-center h-100 d-flex flex-column justify-content-center">
                        <small class="text-muted fw-semibold d-block mb-2">Pratinjau Foto</small>
                        <img id="previewGaleri" src="../../assets/img/uploads/<?= htmlspecialchars($data['foto']); ?>" alt="Preview Foto" class="img-fluid rounded border shadow-sm mx-auto" style="max-height: 220px; width: 100%; object-fit: cover;">
                    </div>
                </div>

                <div class="col-12 text-end pt-3 border-top">
                    <a href="index.php" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" name="btn_update" class="btn btn-cyber px-4 py-2 fw-bold">
                        <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Perubahan Foto
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
