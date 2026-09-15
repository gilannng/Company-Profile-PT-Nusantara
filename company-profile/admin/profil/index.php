<?php
require_once __DIR__ . '/../../config/koneksi.php';

$admin_title = "Kelola Profil Perusahaan - CMS";
$active_menu = "profil";

// Ambil data profil yang ada
$q_profil = mysqli_query($koneksi, "SELECT * FROM profil LIMIT 1");
$profil = mysqli_fetch_assoc($q_profil);

// Tangani submit form edit profil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_simpan'])) {
    $nama_perusahaan   = clean_input($_POST['nama_perusahaan'] ?? '');
    $sejarah           = clean_input($_POST['sejarah'] ?? '');
    $visi              = clean_input($_POST['visi'] ?? '');
    $misi              = clean_input($_POST['misi'] ?? '');
    $nilai_perusahaan  = clean_input($_POST['nilai_perusahaan'] ?? '');
    $alamat            = clean_input($_POST['alamat'] ?? '');
    $telepon           = clean_input($_POST['telepon'] ?? '');
    $email             = clean_input($_POST['email'] ?? '');

    if (empty($nama_perusahaan) || empty($email) || empty($telepon)) {
        set_flash_message('danger', 'Nama perusahaan, nomor telepon, dan email wajib diisi!');
    } else {
        if ($profil) {
            $id = $profil['id'];
            $sql = "UPDATE profil SET 
                    nama_perusahaan = '$nama_perusahaan',
                    sejarah = '$sejarah',
                    visi = '$visi',
                    misi = '$misi',
                    nilai_perusahaan = '$nilai_perusahaan',
                    alamat = '$alamat',
                    telepon = '$telepon',
                    email = '$email'
                    WHERE id = $id";
        } else {
            $sql = "INSERT INTO profil (nama_perusahaan, sejarah, visi, misi, nilai_perusahaan, alamat, telepon, email)
                    VALUES ('$nama_perusahaan', '$sejarah', '$visi', '$misi', '$nilai_perusahaan', '$alamat', '$telepon', '$email')";
        }

        if (mysqli_query($koneksi, $sql)) {
            set_flash_message('success', 'Data profil perusahaan berhasil diperbarui secara permanen.');
            header("Location: index.php");
            exit;
        } else {
            set_flash_message('danger', 'Gagal menyimpan perubahan profil: ' . mysqli_error($koneksi));
        }
    }
}

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-2xl">corporate_fare</span>
            Profil Perusahaan
        </h4>
        <p class="text-muted small mb-0">Kelola identitas resmi, sejarah perjalanan, visi, misi, serta kontak utama perusahaan.</p>
    </div>
    <div>
        <a href="../../profil.php" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg bg-surface-container-low hover:bg-surface-container-high text-text-primary text-xs font-semibold border border-subtle-border transition-colors">
            <span class="material-symbols-outlined text-base">visibility</span>
            Pratinjau di Publik
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-xl overflow-hidden mb-4">
    <div class="card-header bg-white py-3 border-bottom">
        <span class="fw-bold text-dark flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-lg">edit_note</span>
            Formulir Data Perusahaan
        </span>
    </div>
    <div class="card-body p-4 sm:p-5 md:p-6">
        <form action="index.php" method="POST">
            <!-- 1. Identitas Dasar -->
            <div class="row g-4 mb-4 pb-4 border-bottom">
                <div class="col-12">
                    <h5 class="fw-bold text-dark mb-1"><i class="fa-solid fa-id-card text-info me-2"></i>Identitas Resmi</h5>
                    <p class="text-muted small mb-0">Informasi nama resmi dan alamat legal korporat.</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold small text-dark">Nama Perusahaan <span class="text-danger">*</span></label>
                    <input type="text" name="nama_perusahaan" class="form-control" value="<?= htmlspecialchars($profil['nama_perusahaan'] ?? ''); ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold small text-dark">Email Resmi <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($profil['email'] ?? ''); ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold small text-dark">Nomor Telepon / WhatsApp <span class="text-danger">*</span></label>
                    <input type="text" name="telepon" class="form-control" value="<?= htmlspecialchars($profil['telepon'] ?? ''); ?>" required>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold small text-dark">Alamat Lengkap Kantor <span class="text-danger">*</span></label>
                    <textarea name="alamat" rows="2" class="form-control" required><?= htmlspecialchars($profil['alamat'] ?? ''); ?></textarea>
                </div>
            </div>

            <!-- 2. Sejarah Perusahaan -->
            <div class="row g-4 mb-4 pb-4 border-bottom">
                <div class="col-12">
                    <h5 class="fw-bold text-dark mb-1"><i class="fa-solid fa-timeline text-info me-2"></i>Sejarah &amp; Rekam Jejak</h5>
                    <p class="text-muted small mb-0">Naratif perjalanan dan pengalaman profesional perusahaan.</p>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold small text-dark">Teks Sejarah Perusahaan</label>
                    <textarea name="sejarah" rows="5" class="form-control"><?= htmlspecialchars($profil['sejarah'] ?? ''); ?></textarea>
                </div>
            </div>

            <!-- 3. Visi & Misi -->
            <div class="row g-4 mb-4 pb-4 border-bottom">
                <div class="col-12">
                    <h5 class="fw-bold text-dark mb-1"><i class="fa-solid fa-bullseye text-info me-2"></i>Visi &amp; Misi Strategis</h5>
                    <p class="text-muted small mb-0">Arah haluan masa depan dan prinsip eksekusi bisnis.</p>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold small text-dark">Visi Perusahaan</label>
                    <textarea name="visi" rows="3" class="form-control"><?= htmlspecialchars($profil['visi'] ?? ''); ?></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold small text-dark">Misi Perusahaan (Daftar berbaris / nomor)</label>
                    <textarea name="misi" rows="5" class="form-control"><?= htmlspecialchars($profil['misi'] ?? ''); ?></textarea>
                    <div class="form-text small text-muted">Gunakan pemisah baris baru untuk setiap poin misi.</div>
                </div>
            </div>

            <!-- 4. Nilai-Nilai Korporat -->
            <div class="row g-4 mb-4 pb-4 border-bottom">
                <div class="col-12">
                    <h5 class="fw-bold text-dark mb-1"><i class="fa-solid fa-award text-info me-2"></i>Nilai-Nilai Perusahaan (Core Values)</h5>
                    <p class="text-muted small mb-0">Format: <code>Nama Nilai: Deskripsi</code> per baris (Integrity, Innovation, Reliability, Excellence).</p>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold small text-dark">Daftar Nilai Perusahaan</label>
                    <textarea name="nilai_perusahaan" rows="5" class="form-control"><?= htmlspecialchars($profil['nilai_perusahaan'] ?? ''); ?></textarea>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-end gap-2">
                <button type="submit" name="btn_simpan" class="btn btn-cyber px-4 py-2 fw-bold">
                    <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Perubahan Profil
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
