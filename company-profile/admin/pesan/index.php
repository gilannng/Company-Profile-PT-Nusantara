<?php
require_once __DIR__ . '/../../config/koneksi.php';
require_once __DIR__ . '/../auth_check.php';

$admin_title = "Pesan & Masukan Klien - DSN Admin";
$active_menu = "pesan";

// Tandai satu pesan sudah dibaca
if (isset($_GET['mark_read'])) {
    $rid = (int)$_GET['mark_read'];
    if ($rid > 0) {
        mysqli_query($koneksi, "UPDATE pesan SET status = 'Sudah Dibaca' WHERE id = $rid");
    }
    header("Location: index.php");
    exit;
}

// Tandai semua pesan sudah dibaca
if (isset($_GET['mark_all_read'])) {
    mysqli_query($koneksi, "UPDATE pesan SET status = 'Sudah Dibaca'");
    header("Location: index.php");
    exit;
}

// Filter Status
$filter_status = clean_input($_GET['status'] ?? 'semua');
$search_q = clean_input($_GET['q'] ?? '');

// Susun Query
$where_clauses = [];
if ($filter_status === 'belum_dibaca') {
    $where_clauses[] = "status = 'Belum Dibaca'";
} elseif ($filter_status === 'sudah_dibaca') {
    $where_clauses[] = "status = 'Sudah Dibaca'";
}

if (!empty($search_q)) {
    $where_clauses[] = "(nama LIKE '%$search_q%' OR email LIKE '%$search_q%' OR perusahaan LIKE '%$search_q%' OR subjek LIKE '%$search_q%' OR pesan LIKE '%$search_q%')";
}

$where_sql = count($where_clauses) > 0 ? "WHERE " . implode(" AND ", $where_clauses) : "";
$q_pesan = mysqli_query($koneksi, "SELECT * FROM pesan $where_sql ORDER BY id DESC");

// Hitung Statistik
$total_all = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM pesan"));
$total_unread = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM pesan WHERE status = 'Belum Dibaca'"));
$total_read = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM pesan WHERE status = 'Sudah Dibaca'"));

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<!-- Header Halaman: Kotak Masuk (Read-Only) -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <div class="flex items-center gap-2.5">
            <h1 class="font-headline-md text-headline-md text-text-primary tracking-tight font-bold">Kotak Masuk &amp; Pesan Klien</h1>
            <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-semibold bg-pale-mint text-primary-container border border-primary-container/20">
                <span class="material-symbols-outlined text-[14px]">lock</span>
                Mode Read-Only
            </span>
        </div>
        <p class="font-body-sm text-body-sm text-text-secondary mt-1">
            Daftar masukan, pertanyaan, dan permintaan konsultasi yang dikirim oleh pengunjung melalui formulir Kontak Kami.
        </p>
    </div>
    
    <!-- Aksi Tandai Semua Dibaca -->
    <?php if ($total_unread > 0): ?>
    <div class="shrink-0">
        <a href="index.php?mark_all_read=1" 
           onclick="return confirm('Tandai seluruh <?= $total_unread; ?> pesan belum dibaca sebagai sudah dibaca?');"
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-surface-container-low hover:bg-surface-container text-text-primary border border-subtle-border font-label-md text-label-md font-semibold transition-all shadow-xs">
            <span class="material-symbols-outlined text-[18px] text-primary-container">done_all</span>
            <span>Tandai Semua Sudah Dibaca</span>
        </a>
    </div>
    <?php endif; ?>
</div>

<!-- Banner Info: Sifat Menu Read-Only -->
<div class="p-4 rounded-xl bg-surface-container-low border border-subtle-border flex items-start sm:items-center justify-between gap-4">
    <div class="flex items-start sm:items-center gap-3">
        <div class="w-9 h-9 rounded-lg bg-pale-mint flex items-center justify-center text-primary-container shrink-0">
            <span class="material-symbols-outlined text-[20px]">info</span>
        </div>
        <p class="font-body-sm text-body-sm text-text-body">
            <strong>Catatan Administrator:</strong> Halaman ini bersifat <em>Read-Only</em> (hanya membaca masukan dari pengunjung). Administrator tidak perlu menambahkan pesan secara manual di sini.
        </p>
    </div>
</div>

<!-- Tab Filter & Pencarian -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
    <!-- Filter Tabs -->
    <div class="flex items-center gap-2 overflow-x-auto pb-1 md:pb-0">
        <a href="index.php?status=semua<?= !empty($search_q) ? '&q=' . urlencode($search_q) : ''; ?>" 
           class="px-4 py-2 rounded-lg font-label-md text-sm transition-all whitespace-nowrap <?= ($filter_status === 'semua') ? 'bg-primary-container text-pure-white font-semibold shadow-xs' : 'bg-surface-container-lowest text-text-secondary hover:text-text-primary border border-subtle-border'; ?>">
            Semua (<?= $total_all; ?>)
        </a>
        <a href="index.php?status=belum_dibaca<?= !empty($search_q) ? '&q=' . urlencode($search_q) : ''; ?>" 
           class="px-4 py-2 rounded-lg font-label-md text-sm transition-all whitespace-nowrap flex items-center gap-1.5 <?= ($filter_status === 'belum_dibaca') ? 'bg-primary-container text-pure-white font-semibold shadow-xs' : 'bg-surface-container-lowest text-text-secondary hover:text-text-primary border border-subtle-border'; ?>">
            <?php if ($total_unread > 0): ?>
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
            <?php endif; ?>
            <span>Belum Dibaca (<?= $total_unread; ?>)</span>
        </a>
        <a href="index.php?status=sudah_dibaca<?= !empty($search_q) ? '&q=' . urlencode($search_q) : ''; ?>" 
           class="px-4 py-2 rounded-lg font-label-md text-sm transition-all whitespace-nowrap <?= ($filter_status === 'sudah_dibaca') ? 'bg-primary-container text-pure-white font-semibold shadow-xs' : 'bg-surface-container-lowest text-text-secondary hover:text-text-primary border border-subtle-border'; ?>">
            Sudah Dibaca (<?= $total_read; ?>)
        </a>
    </div>

    <!-- Kotak Pencarian -->
    <form method="GET" action="index.php" class="relative w-full md:w-80">
        <input type="hidden" name="status" value="<?= htmlspecialchars($filter_status); ?>">
        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-text-secondary text-[18px]">search</span>
        <input name="q" 
               value="<?= htmlspecialchars($search_q); ?>"
               placeholder="Cari pengirim, email, subjek..." 
               class="w-full pl-10 pr-10 py-2 text-sm bg-surface-container-lowest rounded-lg text-text-primary border border-subtle-border focus:outline-none focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 shadow-xs transition-all">
        <?php if (!empty($search_q)): ?>
            <a href="index.php?status=<?= htmlspecialchars($filter_status); ?>" class="absolute right-3 top-1/2 -translate-y-1/2 text-text-secondary hover:text-text-primary">
                <span class="material-symbols-outlined text-[16px]">close</span>
            </a>
        <?php endif; ?>
    </form>
</div>

<!-- Tabel Kotak Masuk (Read-Only) -->
<div class="bg-surface-container-lowest rounded-xl shadow-sm border border-subtle-border overflow-hidden">
    <div class="p-5 border-b border-subtle-border flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-surface-bright">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-[20px]">inbox</span>
            <span class="font-title-sm text-title-sm text-text-primary font-bold">Daftar Masukan &amp; Konsultasi Masuk</span>
        </div>
        <span class="text-xs text-text-secondary font-medium">
            Menampilkan <?= mysqli_num_rows($q_pesan); ?> pesan
        </span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left font-body-sm text-body-sm">
            <thead class="bg-surface-container-low text-text-secondary font-label-sm text-label-sm uppercase tracking-wider border-b border-subtle-border">
                <tr>
                    <th class="py-3.5 px-5 font-semibold w-14 text-center">No</th>
                    <th class="py-3.5 px-5 font-semibold min-w-[200px]">Pengirim &amp; Kontak</th>
                    <th class="py-3.5 px-5 font-semibold min-w-[160px]">Instansi / Perusahaan</th>
                    <th class="py-3.5 px-5 font-semibold min-w-[220px]">Subjek &amp; Cuplikan Pesan</th>
                    <th class="py-3.5 px-5 font-semibold w-36">Waktu Masuk</th>
                    <th class="py-3.5 px-5 font-semibold w-32 text-center">Status</th>
                    <th class="py-3.5 px-5 font-semibold text-right w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-subtle-border text-text-primary">
                <?php 
                $no = 1;
                if ($q_pesan && mysqli_num_rows($q_pesan) > 0):
                    while ($row = mysqli_fetch_assoc($q_pesan)):
                        $is_unread = ($row['status'] === 'Belum Dibaca');
                        $tgl_masuk = !empty($row['tanggal']) ? date('d M Y, H:i', strtotime($row['tanggal'])) : '-';

                        // Format nomor WA untuk balasan cepat langsung
                        $wa_reply_digits = preg_replace('/[^0-9]/', '', $row['telepon'] ?? '');
                        if (str_starts_with($wa_reply_digits, '0')) {
                            $wa_reply_digits = '62' . substr($wa_reply_digits, 1);
                        }
                        $wa_reply_url = !empty($wa_reply_digits) 
                            ? "https://wa.me/{$wa_reply_digits}?text=" . rawurlencode("Halo Bapak/Ibu " . $row['nama'] . ", terima kasih telah menghubungi PT Digital Solusi Nusantara mengenai " . ($row['subjek'] ?: 'layanan kami') . ".")
                            : "";
                ?>
                <tr class="transition-colors <?= $is_unread ? 'bg-pale-mint/25 font-medium hover:bg-pale-mint/40' : 'hover:bg-surface-container-low/50'; ?>">
                    <td class="py-4 px-5 text-center text-text-secondary"><?= $no++; ?></td>
                    
                    <!-- Kolom Pengirim -->
                    <td class="py-4 px-5">
                        <div class="font-title-sm text-title-sm text-text-primary font-bold">
                            <?= htmlspecialchars($row['nama']); ?>
                        </div>
                        <div class="text-xs text-text-secondary mt-0.5 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[14px]">mail</span>
                            <a href="mailto:<?= htmlspecialchars($row['email']); ?>" class="hover:text-primary-container transition-colors"><?= htmlspecialchars($row['email']); ?></a>
                        </div>
                        <?php if (!empty($row['telepon'])): ?>
                        <div class="text-xs text-text-secondary mt-0.5 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[14px]">call</span>
                            <span><?= htmlspecialchars($row['telepon']); ?></span>
                        </div>
                        <?php endif; ?>
                    </td>

                    <!-- Kolom Instansi / Perusahaan -->
                    <td class="py-4 px-5">
                        <div class="font-semibold text-text-primary">
                            <?= !empty($row['perusahaan']) ? htmlspecialchars($row['perusahaan']) : '<span class="text-text-secondary/60 italic font-normal">Perorangan</span>'; ?>
                        </div>
                        <?php if (!empty($row['layanan'])): ?>
                        <span class="inline-block mt-1 px-2 py-0.5 rounded text-[11px] font-medium bg-surface-container text-text-secondary">
                            <?= htmlspecialchars($row['layanan']); ?>
                        </span>
                        <?php endif; ?>
                    </td>

                    <!-- Kolom Subjek & Cuplikan -->
                    <td class="py-4 px-5">
                        <div class="font-semibold text-text-primary text-sm line-clamp-1">
                            <?= htmlspecialchars($row['subjek'] ?: 'Tanpa Subjek'); ?>
                        </div>
                        <p class="text-xs text-text-secondary mt-1 line-clamp-2 leading-relaxed">
                            <?= htmlspecialchars($row['pesan']); ?>
                        </p>
                    </td>

                    <!-- Waktu Masuk -->
                    <td class="py-4 px-5 text-xs text-text-secondary whitespace-nowrap">
                        <?= $tgl_masuk; ?> WIB
                    </td>

                    <!-- Status -->
                    <td class="py-4 px-5 text-center whitespace-nowrap">
                        <?php if ($is_unread): ?>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 border border-amber-300">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                            Belum Dibaca
                        </span>
                        <?php else: ?>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-surface-container text-text-secondary border border-subtle-border">
                            <span class="material-symbols-outlined text-[14px] text-primary-container">done</span>
                            Sudah Dibaca
                        </span>
                        <?php endif; ?>
                    </td>

                    <!-- Aksi -->
                    <td class="py-4 px-5 text-right whitespace-nowrap">
                        <div class="inline-flex items-center gap-1.5">
                            <!-- Tombol Buka Detail (Read) -->
                            <button type="button"
                                    onclick='bukaDetailPesan(<?= json_encode([
                                        "id" => $row["id"],
                                        "nama" => $row["nama"],
                                        "email" => $row["email"],
                                        "telepon" => $row["telepon"] ?? "-",
                                        "perusahaan" => $row["perusahaan"] ?? "-",
                                        "layanan" => $row["layanan"] ?? "-",
                                        "subjek" => $row["subjek"] ?: "Tanpa Subjek",
                                        "pesan" => $row["pesan"],
                                        "status" => $row["status"],
                                        "tanggal" => $tgl_masuk . " WIB",
                                        "wa_reply" => $wa_reply_url
                                    ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>)'
                                    class="p-2 rounded-lg bg-surface-container-low hover:bg-primary-container hover:text-pure-white text-primary-container transition-all shadow-xs" 
                                    title="Baca Rincian Masukan">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                            </button>

                            <!-- Tombol Hapus Arsip -->
                            <a href="hapus.php?id=<?= $row['id']; ?>" 
                               onclick="return confirm('Apakah Anda yakin ingin menghapus pesan dari <?= addslashes(htmlspecialchars($row['nama'])); ?>? Tindakan ini tidak dapat dibatalkan.');" 
                               class="p-2 rounded-lg bg-surface-container-low hover:bg-error/10 text-error transition-all shadow-xs" 
                               title="Hapus Pesan">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php 
                    endwhile;
                else:
                ?>
                <tr>
                    <td colspan="7" class="py-14 text-center text-text-secondary">
                        <div class="w-14 h-14 rounded-full bg-surface-container-low flex items-center justify-center text-text-secondary mx-auto mb-3">
                            <span class="material-symbols-outlined text-3xl">inbox</span>
                        </div>
                        <div class="font-title-sm text-title-sm text-text-primary font-bold">Tidak ada pesan yang ditemukan</div>
                        <p class="text-sm text-text-secondary mt-1 max-w-md mx-auto">
                            <?= !empty($search_q) ? 'Tidak ditemukan pesan dengan kata kunci "' . htmlspecialchars($search_q) . '".' : 'Belum ada pesan atau masukan masuk dari formulir Kontak Kami website.'; ?>
                        </p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Baca Rincian Pesan (Read-Only) -->
<div id="modalDetailPesan" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4 transition-opacity duration-200">
    <div class="bg-surface-container-lowest rounded-2xl max-w-2xl w-full shadow-2xl border border-subtle-border overflow-hidden transform transition-transform duration-200 scale-95" id="modalDetailContainer">
        
        <!-- Modal Header -->
        <div class="p-6 border-b border-subtle-border flex items-center justify-between bg-surface-bright">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-pale-mint flex items-center justify-center text-primary-container shrink-0">
                    <span class="material-symbols-outlined text-[22px]">mark_email_read</span>
                </div>
                <div>
                    <h3 class="font-title-md text-title-md text-text-primary font-bold">Rincian Masukan &amp; Konsultasi</h3>
                    <p class="text-xs text-text-secondary" id="modalTanggal">-</p>
                </div>
            </div>
            <button type="button" onclick="tutupDetailPesan()" class="p-1.5 rounded-lg text-text-secondary hover:bg-surface-container-low hover:text-text-primary transition-colors">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <!-- Modal Body (Informasi Lengkap Read-Only) -->
        <div class="p-6 space-y-5 max-h-[70vh] overflow-y-auto">
            
            <!-- Grid Metadata Pengirim -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-xl bg-surface-container-low border border-subtle-border text-sm">
                <div>
                    <span class="text-xs text-text-secondary uppercase font-semibold">Nama Lengkap</span>
                    <div class="font-bold text-text-primary text-base mt-0.5" id="modalNama">-</div>
                </div>
                <div>
                    <span class="text-xs text-text-secondary uppercase font-semibold">Perusahaan / Instansi</span>
                    <div class="font-semibold text-text-primary mt-0.5" id="modalPerusahaan">-</div>
                </div>
                <div>
                    <span class="text-xs text-text-secondary uppercase font-semibold">Email Perusahaan</span>
                    <div class="mt-0.5">
                        <a id="modalEmailLink" href="#" class="text-primary-container hover:underline font-medium break-all"></a>
                    </div>
                </div>
                <div>
                    <span class="text-xs text-text-secondary uppercase font-semibold">Nomor Telepon / WA</span>
                    <div class="font-medium text-text-primary mt-0.5" id="modalTelepon">-</div>
                </div>
                <div class="sm:col-span-2 pt-2 border-t border-subtle-border">
                    <span class="text-xs text-text-secondary uppercase font-semibold">Layanan yang Diminati</span>
                    <div class="font-semibold text-text-primary mt-0.5" id="modalLayanan">-</div>
                </div>
            </div>

            <!-- Subjek -->
            <div class="space-y-1">
                <span class="text-xs text-text-secondary uppercase font-semibold">Subjek Pesan</span>
                <div class="font-title-sm text-title-sm text-text-primary font-bold p-3 rounded-lg bg-surface-container-low/50 border border-subtle-border" id="modalSubjek">
                    -
                </div>
            </div>

            <!-- Isi Pesan Lengkap -->
            <div class="space-y-1">
                <span class="text-xs text-text-secondary uppercase font-semibold">Isi Pesan / Rincian Kebutuhan</span>
                <div class="p-4 rounded-xl bg-surface-container-lowest border border-subtle-border text-text-primary text-sm whitespace-pre-wrap leading-relaxed min-h-[120px] font-normal" id="modalPesan">
                    -
                </div>
            </div>

        </div>

        <!-- Modal Footer: Quick Response Actions -->
        <div class="p-5 border-t border-subtle-border bg-surface-bright flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="flex items-center gap-2 w-full sm:w-auto">
                <a id="modalBtnWA" href="#" target="_blank" rel="noopener noreferrer" class="hidden flex-1 sm:flex-initial inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-lg bg-[#25D366] hover:bg-[#1EBE5D] text-pure-white text-xs font-semibold shadow-xs transition-colors">
                    <span class="material-symbols-outlined text-[16px]">chat</span>
                    <span>Balas via WhatsApp</span>
                </a>
                <a id="modalBtnEmail" href="#" class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-lg bg-primary-container hover:bg-brand-green-hover text-pure-white text-xs font-semibold shadow-xs transition-colors">
                    <span class="material-symbols-outlined text-[16px]">mail</span>
                    <span>Balas via Email</span>
                </a>
            </div>

            <button type="button" onclick="tutupDetailPesan()" class="w-full sm:w-auto px-5 py-2 rounded-lg bg-surface-container-low hover:bg-surface-container text-text-primary border border-subtle-border text-xs font-semibold transition-colors">
                Tutup Jendela
            </button>
        </div>

    </div>
</div>

<script>
function bukaDetailPesan(data) {
    document.getElementById('modalNama').textContent = data.nama;
    document.getElementById('modalPerusahaan').textContent = data.perusahaan || '-';
    
    const emailLink = document.getElementById('modalEmailLink');
    emailLink.textContent = data.email;
    emailLink.href = 'mailto:' + encodeURIComponent(data.email) + '?subject=' + encodeURIComponent('Tanggapan: ' + data.subjek);

    document.getElementById('modalTelepon').textContent = data.telepon || '-';
    document.getElementById('modalLayanan').textContent = data.layanan || '-';
    document.getElementById('modalSubjek').textContent = data.subjek || '-';
    document.getElementById('modalPesan').textContent = data.pesan || '-';
    document.getElementById('modalTanggal').textContent = 'Diterima pada ' + data.tanggal;

    // Tombol Balas Email
    document.getElementById('modalBtnEmail').href = 'mailto:' + encodeURIComponent(data.email) + '?subject=' + encodeURIComponent('Tanggapan: ' + data.subjek);

    // Tombol Balas WhatsApp
    const btnWA = document.getElementById('modalBtnWA');
    if (data.wa_reply) {
        btnWA.href = data.wa_reply;
        btnWA.classList.remove('hidden');
    } else {
        btnWA.classList.add('hidden');
    }

    const modal = document.getElementById('modalDetailPesan');
    const container = document.getElementById('modalDetailContainer');
    modal.classList.remove('hidden');
    setTimeout(() => {
        container.classList.remove('scale-95');
        container.classList.add('scale-100');
    }, 10);

    // Otomatis tandai sebagai sudah dibaca di background jika belum dibaca
    if (data.status === 'Belum Dibaca') {
        fetch('index.php?mark_read=' + data.id);
    }
}

function tutupDetailPesan() {
    const modal = document.getElementById('modalDetailPesan');
    const container = document.getElementById('modalDetailContainer');
    container.classList.remove('scale-100');
    container.classList.add('scale-95');
    setTimeout(() => {
        modal.classList.add('hidden');
        // Refresh ringan agar badge unread sinkron
        window.location.reload();
    }, 150);
}

// Tutup modal jika klik di luar container
document.getElementById('modalDetailPesan')?.addEventListener('click', function(e) {
    if (e.target === this) {
        tutupDetailPesan();
    }
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
