<?php
require_once __DIR__ . '/../config/koneksi.php';

$admin_title = "Dashboard - DSN Admin";
$active_menu = "dashboard";

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/sidebar.php';

// Hitung Metrik Data
$total_produk  = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM produk"));
$total_artikel = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM artikel"));
$total_galeri  = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM galeri"));
$total_pesan   = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM pesan"));
$unread_pesan  = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM pesan WHERE status = 'Belum Dibaca'"));

// Ambil Daftar Layanan untuk Tabel Kelola Cepat
$q_layanan_table = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id ASC");
// Ambil 5 Pesan Terkini (Read-Only)
$q_pesan_recent = mysqli_query($koneksi, "SELECT * FROM pesan ORDER BY id DESC LIMIT 5");
?>

<!-- Top Greeting Bar / Welcome Banner -->
<div class="bg-surface-container-lowest rounded-lg p-6 shadow-sm flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 border border-subtle-border">
    <div class="flex flex-col gap-1.5">
        <div class="flex items-center gap-3 flex-wrap">
            <h1 class="font-headline-md text-headline-md text-text-primary tracking-tight">
                Selamat Datang Kembali, <?= htmlspecialchars($_SESSION['admin_nama'] ?? 'Administrator'); ?>
            </h1>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-label-sm font-label-sm bg-pale-mint text-primary font-semibold">
                Super Admin
            </span>
        </div>
        <p class="font-body-md text-text-secondary">
            Kelola konten website, katalog layanan IT, dan pantau aktivitas masukan klien PT Digital Solusi Nusantara.
        </p>
    </div>
    
    <div class="flex items-center gap-3.5 flex-wrap self-start lg:self-auto">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-surface-container-low border border-subtle-border">
            <span class="relative flex h-2.5 w-2.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-primary"></span>
            </span>
            <span class="font-label-sm text-label-sm text-text-primary font-semibold">Sistem Normal</span>
        </div>
        <div class="hidden sm:flex items-center gap-1.5 text-text-secondary px-2">
            <span class="material-symbols-outlined text-[18px]">event</span>
            <span class="font-label-sm text-label-sm font-medium"><?= date('d M Y'); ?></span>
        </div>
        <a class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-surface-container-low text-text-primary font-label-md text-label-md hover:bg-surface-container-high transition-colors border border-subtle-border" href="../index.php" target="_blank">
            <span class="material-symbols-outlined text-[18px]">open_in_new</span>
            Lihat Website Utama
        </a>
    </div>
</div>

<!-- 4 Summary Metric Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
    <!-- Card 1: Total Layanan Aktif -->
    <div class="bg-surface-container-lowest rounded-lg p-5 shadow-sm flex flex-col justify-between hover:-translate-y-0.5 transition-transform duration-200 border border-subtle-border">
        <div class="flex items-start justify-between">
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary uppercase tracking-wider font-semibold">Total Layanan Aktif</span>
                <div class="mt-2 font-headline-lg text-headline-lg text-text-primary tracking-tight font-bold"><?= $total_produk; ?> Layanan</div>
            </div>
            <div class="w-11 h-11 rounded-full bg-pale-mint flex items-center justify-center text-primary shrink-0">
                <span class="material-symbols-outlined text-[22px]">layers</span>
            </div>
        </div>
        <div class="mt-4 pt-3 flex items-center justify-between border-t border-subtle-border">
            <div class="flex items-center gap-1.5 text-primary text-xs font-semibold">
                <span class="material-symbols-outlined text-[16px]">trending_up</span>
                <span>Katalog terpublikasi</span>
            </div>
            <a href="produk/index.php" class="text-xs text-primary hover:text-brand-green-hover font-semibold inline-flex items-center gap-1">
                Kelola <span class="material-symbols-outlined text-xs">arrow_forward</span>
            </a>
        </div>
    </div>

    <!-- Card 2: Total Artikel & Berita -->
    <div class="bg-surface-container-lowest rounded-lg p-5 shadow-sm flex flex-col justify-between hover:-translate-y-0.5 transition-transform duration-200 border border-subtle-border">
        <div class="flex items-start justify-between">
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary uppercase tracking-wider font-semibold">Artikel &amp; Edukasi</span>
                <div class="mt-2 font-headline-lg text-headline-lg text-text-primary tracking-tight font-bold"><?= $total_artikel; ?> Artikel</div>
            </div>
            <div class="w-11 h-11 rounded-full bg-tertiary-fixed flex items-center justify-center text-tertiary shrink-0">
                <span class="material-symbols-outlined text-[22px]">newspaper</span>
            </div>
        </div>
        <div class="mt-4 pt-3 flex items-center justify-between border-t border-subtle-border">
            <div class="flex items-center gap-1.5 text-tertiary text-xs font-semibold">
                <span class="material-symbols-outlined text-[16px]">schedule</span>
                <span>Wawasan TI terkini</span>
            </div>
            <a href="artikel/index.php" class="text-xs text-primary hover:text-brand-green-hover font-semibold inline-flex items-center gap-1">
                Kelola <span class="material-symbols-outlined text-xs">arrow_forward</span>
            </a>
        </div>
    </div>

    <!-- Card 3: Dokumentasi & Galeri -->
    <div class="bg-surface-container-lowest rounded-lg p-5 shadow-sm flex flex-col justify-between hover:-translate-y-0.5 transition-transform duration-200 border border-subtle-border">
        <div class="flex items-start justify-between">
            <div>
                <span class="font-label-sm text-label-sm text-text-secondary uppercase tracking-wider font-semibold">Dokumentasi Galeri</span>
                <div class="mt-2 font-headline-lg text-headline-lg text-text-primary tracking-tight font-bold"><?= $total_galeri; ?> Foto</div>
            </div>
            <div class="w-11 h-11 rounded-full bg-secondary-fixed flex items-center justify-center text-secondary shrink-0">
                <span class="material-symbols-outlined text-[22px]">photo_library</span>
            </div>
        </div>
        <div class="mt-4 pt-3 flex items-center justify-between border-t border-subtle-border">
            <div class="flex items-center gap-1.5 text-text-secondary text-xs font-semibold">
                <span class="material-symbols-outlined text-[16px]">verified</span>
                <span>Arsip foto terverifikasi</span>
            </div>
            <a href="galeri/index.php" class="text-xs text-primary hover:text-brand-green-hover font-semibold inline-flex items-center gap-1">
                Kelola <span class="material-symbols-outlined text-xs">arrow_forward</span>
            </a>
        </div>
    </div>

    <!-- Card 4: Masukan & Pesan Klien (Read-Only) -->
    <div class="bg-surface-container-lowest rounded-lg p-5 shadow-sm flex flex-col justify-between hover:-translate-y-0.5 transition-transform duration-200 border border-subtle-border">
        <div class="flex items-start justify-between">
            <div>
                <div class="flex items-center gap-2">
                    <span class="font-label-sm text-label-sm text-text-secondary uppercase tracking-wider font-semibold">Masukan &amp; Pesan</span>
                    <span class="px-1.5 py-0.5 text-[10px] font-bold rounded bg-surface-container text-text-secondary">Read-Only</span>
                </div>
                <div class="mt-2 font-headline-lg text-headline-lg text-text-primary tracking-tight font-bold"><?= $total_pesan; ?> Pesan</div>
            </div>
            <div class="w-11 h-11 rounded-full bg-amber-100 flex items-center justify-center text-amber-700 shrink-0">
                <span class="material-symbols-outlined text-[22px]">inbox</span>
            </div>
        </div>
        <div class="mt-4 pt-3 flex items-center justify-between border-t border-subtle-border">
            <div class="flex items-center gap-1.5 text-xs font-semibold <?= ($unread_pesan > 0) ? 'text-amber-700' : 'text-text-secondary'; ?>">
                <?php if ($unread_pesan > 0): ?>
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                    <span><?= $unread_pesan; ?> Belum Dibaca</span>
                <?php else: ?>
                    <span class="material-symbols-outlined text-[16px] text-primary-container">done_all</span>
                    <span>Semua terbaca</span>
                <?php endif; ?>
            </div>
            <a href="pesan/index.php" class="text-xs text-primary hover:text-brand-green-hover font-semibold inline-flex items-center gap-1">
                Lihat Inbox <span class="material-symbols-outlined text-xs">arrow_forward</span>
            </a>
        </div>
    </div>
</div>

<!-- Quick Action Shortcuts (Aksi Cepat Tambah Konten) -->
<div class="bg-surface-container-lowest rounded-lg p-5 shadow-sm border border-subtle-border flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-lg bg-pale-mint flex items-center justify-center text-primary-container shrink-0">
            <span class="material-symbols-outlined text-[24px]">add_circle</span>
        </div>
        <div>
            <h3 class="font-title-sm text-title-sm text-text-primary font-bold">Aksi Cepat Tambah Konten Baru</h3>
            <p class="font-body-sm text-body-sm text-text-secondary">Pilih modul untuk menerbitkan konten baru ke website secara instan.</p>
        </div>
    </div>
    <div class="flex items-center gap-3 flex-wrap">
        <a href="artikel/tambah.php" 
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-primary-container hover:bg-brand-green-hover text-pure-white font-label-md text-label-md transition-all shadow-sm font-semibold">
            <span class="material-symbols-outlined text-[18px]">post_add</span>
            <span>+ Tulis Artikel Baru</span>
        </a>
        <a href="galeri/tambah.php" 
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-pure-white hover:bg-surface-container-low text-text-primary border border-border-secondary font-label-md text-label-md transition-all shadow-xs font-semibold">
            <span class="material-symbols-outlined text-[18px] text-secondary">add_photo_alternate</span>
            <span>+ Unggah Foto Galeri</span>
        </a>
        <a href="produk/tambah.php" 
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-pure-white hover:bg-surface-container-low text-text-primary border border-border-secondary font-label-md text-label-md transition-all shadow-xs font-semibold">
            <span class="material-symbols-outlined text-[18px] text-secondary">add_box</span>
            <span>+ Tambah Layanan IT</span>
        </a>
    </div>
</div>

<!-- Service Management Section -->
<div class="bg-surface-container-lowest rounded-lg shadow-sm overflow-hidden flex flex-col border border-subtle-border">
    <!-- Header Controls -->
    <div class="p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-subtle-border">
        <div class="flex flex-col gap-1">
            <h2 class="font-headline-sm text-headline-sm text-text-primary tracking-tight">Daftar Layanan IT &amp; Status</h2>
            <p class="font-body-sm text-body-sm text-text-secondary">Kelola katalog solusi dan spesifikasi teknis yang tampil pada halaman publik.</p>
        </div>
        <div class="flex items-center gap-3 flex-wrap sm:flex-nowrap">
            <div class="relative w-full sm:w-64">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary text-[18px]">search</span>
                <input id="serviceSearchInput" 
                       class="w-full pl-9 pr-3.5 py-2 text-body-sm font-body-sm bg-surface-container-low rounded-md text-text-primary placeholder:text-text-secondary focus:bg-surface-container-lowest focus:outline-none focus:ring-2 focus:ring-primary/20 border border-subtle-border" 
                       placeholder="Cari kode atau layanan..." 
                       type="text" 
                       onkeyup="filterServiceTable()"/>
            </div>
            <a href="produk/tambah.php" 
               class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-md bg-primary-container hover:bg-brand-green-hover text-on-primary font-label-md text-label-md transition-colors shrink-0 shadow-sm font-semibold">
                <span class="material-symbols-outlined text-[18px]">add</span>
                Tambah Layanan Baru
            </a>
        </div>
    </div>

    <!-- Data Table Container -->
    <div class="w-full overflow-x-auto">
        <table class="w-full text-left font-body-sm text-body-sm" id="serviceTable">
            <thead class="bg-surface-container-low text-text-secondary font-label-sm text-label-sm uppercase tracking-wider border-b border-subtle-border">
                <tr>
                    <th class="py-3.5 px-6 font-semibold w-16 text-center" scope="col">No</th>
                    <th class="py-3.5 px-4 font-semibold w-32" scope="col">Kode</th>
                    <th class="py-3.5 px-4 font-semibold min-w-[220px]" scope="col">Nama Layanan</th>
                    <th class="py-3.5 px-4 font-semibold" scope="col">Kategori</th>
                    <th class="py-3.5 px-4 font-semibold" scope="col">Estimasi Waktu</th>
                    <th class="py-3.5 px-4 font-semibold" scope="col">Status</th>
                    <th class="py-3.5 px-6 font-semibold text-right" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-text-primary divide-y divide-subtle-border">
                <?php 
                $no = 1;
                $cat_map = [
                    1 => ['cat' => 'Software Engineering', 'time' => '4 - 12 Minggu'],
                    2 => ['cat' => 'Infrastruktur', 'time' => '2 - 6 Minggu'],
                    3 => ['cat' => 'Advisory & Security', 'time' => '3 - 8 Minggu'],
                    4 => ['cat' => 'Infrastruktur & Cloud', 'time' => '3 - 8 Minggu'],
                    5 => ['cat' => 'Advisory & Security', 'time' => '4 - 10 Minggu'],
                    6 => ['cat' => 'Enterprise SLA', 'time' => 'Kontrak Tahunan']
                ];

                if ($q_layanan_table && mysqli_num_rows($q_layanan_table) > 0):
                    while ($row = mysqli_fetch_assoc($q_layanan_table)):
                        $cid   = $row['id'];
                        $code  = sprintf("SRV-%02d", $cid);
                        $meta  = $cat_map[$cid] ?? ['cat' => 'IT Enterprise', 'time' => 'Sesuai Scope'];
                ?>
                <tr class="hover:bg-surface-container-low/60 transition-colors">
                    <td class="py-4 px-6 text-center font-semibold text-text-secondary"><?= sprintf("%02d", $no++); ?></td>
                    <td class="py-4 px-4 font-mono font-semibold text-text-primary"><?= $code; ?></td>
                    <td class="py-4 px-4 font-title-sm text-title-sm text-text-primary font-semibold">
                        <?= htmlspecialchars($row['nama_layanan']); ?>
                    </td>
                    <td class="py-4 px-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-label-sm font-label-sm bg-surface-container text-text-secondary">
                            <?= $meta['cat']; ?>
                        </span>
                    </td>
                    <td class="py-4 px-4 text-text-secondary"><?= $meta['time']; ?></td>
                    <td class="py-4 px-4">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-label-sm font-label-sm bg-pale-mint text-primary font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                            Aktif
                        </span>
                    </td>
                    <td class="py-4 px-6 text-right">
                        <div class="inline-flex items-center gap-2">
                            <a href="produk/edit.php?id=<?= $row['id']; ?>" 
                               class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-md bg-surface-container-low hover:bg-surface-container-high text-text-primary font-label-sm text-label-sm transition-colors border border-subtle-border">
                                <span class="material-symbols-outlined text-[16px]">edit</span>
                                Edit
                            </a>
                            <a href="produk/hapus.php?id=<?= $row['id']; ?>" 
                               onclick="return confirm('Apakah Anda yakin ingin menghapus layanan \'<?= addslashes(htmlspecialchars($row['nama_layanan'])); ?>\'? Data yang terhapus tidak dapat dikembalikan.');"
                               class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-md bg-error-container/30 hover:bg-error-container text-error font-label-sm text-label-sm transition-colors border border-error-container">
                                <span class="material-symbols-outlined text-[16px]">delete</span>
                                Hapus
                            </a>
                        </div>
                    </td>
                </tr>
                <?php 
                    endwhile;
                else:
                ?>
                <tr>
                    <td colspan="7" class="py-8 text-center text-text-secondary">
                        Belum ada data layanan IT. Silakan klik tombol "Tambah Layanan Baru".
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Clean Summary Footer -->
    <div class="p-6 bg-surface-container-lowest flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-subtle-border">
        <span class="font-body-sm text-body-sm text-text-secondary">
            Menampilkan <span class="font-semibold text-text-primary"><?= $total_produk; ?></span> Layanan IT Terdaftar
        </span>
        <div class="inline-flex items-center gap-1">
            <a href="produk/index.php" class="px-3.5 py-1.5 rounded-md text-label-sm font-label-sm bg-surface-container-low hover:bg-surface-container-high text-text-primary transition-colors font-medium border border-subtle-border flex items-center gap-1">
                <span>Kelola Semua di Modul Produk</span>
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
    </div>
</div>

<!-- Recent Messages & Inquiries Section (Read-Only) -->
<div class="bg-surface-container-lowest rounded-lg shadow-sm overflow-hidden flex flex-col border border-subtle-border">
    <div class="p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-subtle-border bg-surface-bright">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center text-amber-700 shrink-0">
                <span class="material-symbols-outlined text-[22px]">inbox</span>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="font-headline-sm text-title-md text-text-primary tracking-tight font-bold">Masukan &amp; Pesan Klien Terbaru</h2>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-pale-mint text-primary-container border border-primary-container/20">
                        Read-Only
                    </span>
                </div>
                <p class="font-body-sm text-body-sm text-text-secondary">Pesan dan konsultasi yang baru saja dikirimkan pengunjung dari halaman Kontak Kami.</p>
            </div>
        </div>
        <a href="pesan/index.php" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-surface-container-low hover:bg-surface-container text-text-primary font-label-md text-label-md font-semibold transition-all border border-subtle-border shrink-0 shadow-xs">
            <span>Buka Seluruh Pesan Masuk</span>
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
    </div>

    <div class="w-full overflow-x-auto">
        <table class="w-full text-left font-body-sm text-body-sm">
            <thead class="bg-surface-container-low text-text-secondary font-label-sm text-label-sm uppercase tracking-wider border-b border-subtle-border">
                <tr>
                    <th class="py-3 px-6 font-semibold min-w-[200px]">Pengirim</th>
                    <th class="py-3 px-4 font-semibold min-w-[150px]">Perusahaan</th>
                    <th class="py-3 px-4 font-semibold min-w-[220px]">Subjek</th>
                    <th class="py-3 px-4 font-semibold w-36">Waktu</th>
                    <th class="py-3 px-4 font-semibold w-28 text-center">Status</th>
                    <th class="py-3 px-6 font-semibold text-right w-24">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-subtle-border text-text-primary">
                <?php 
                if ($q_pesan_recent && mysqli_num_rows($q_pesan_recent) > 0):
                    while ($m = mysqli_fetch_assoc($q_pesan_recent)):
                        $is_un = ($m['status'] === 'Belum Dibaca');
                        $tgl_m = !empty($m['tanggal']) ? date('d M, H:i', strtotime($m['tanggal'])) : '-';
                ?>
                <tr class="hover:bg-surface-container-low/50 transition-colors <?= $is_un ? 'bg-pale-mint/20 font-medium' : ''; ?>">
                    <td class="py-3.5 px-6">
                        <div class="font-semibold text-text-primary"><?= htmlspecialchars($m['nama']); ?></div>
                        <div class="text-xs text-text-secondary"><?= htmlspecialchars($m['email']); ?></div>
                    </td>
                    <td class="py-3.5 px-4 text-text-secondary">
                        <?= !empty($m['perusahaan']) ? htmlspecialchars($m['perusahaan']) : '<span class="italic text-text-secondary/60">Perorangan</span>'; ?>
                    </td>
                    <td class="py-3.5 px-4">
                        <div class="text-text-primary line-clamp-1 font-medium"><?= htmlspecialchars($m['subjek'] ?: 'Tanpa Subjek'); ?></div>
                        <div class="text-xs text-text-secondary line-clamp-1"><?= htmlspecialchars(substr($m['pesan'], 0, 80)); ?></div>
                    </td>
                    <td class="py-3.5 px-4 text-xs text-text-secondary whitespace-nowrap">
                        <?= $tgl_m; ?> WIB
                    </td>
                    <td class="py-3.5 px-4 text-center whitespace-nowrap">
                        <?php if ($is_un): ?>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-semibold bg-amber-100 text-amber-800">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                            Baru
                        </span>
                        <?php else: ?>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-surface-container text-text-secondary">
                            Dibaca
                        </span>
                        <?php endif; ?>
                    </td>
                    <td class="py-3.5 px-6 text-right whitespace-nowrap">
                        <a href="pesan/index.php" class="p-1.5 rounded-lg bg-surface-container-low hover:bg-primary-container hover:text-pure-white text-primary-container inline-flex items-center justify-center transition-colors shadow-xs" title="Buka di Kotak Masuk">
                            <span class="material-symbols-outlined text-[18px]">visibility</span>
                        </a>
                    </td>
                </tr>
                <?php 
                    endwhile;
                else:
                ?>
                <tr>
                    <td colspan="6" class="py-8 text-center text-text-secondary">
                        Belum ada pesan atau masukan baru dari formulir Kontak Kami.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function filterServiceTable() {
    const input = document.getElementById('serviceSearchInput');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('serviceTable');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
        const row = rows[i];
        const text = row.textContent || row.innerText;
        if (text.toLowerCase().indexOf(filter) > -1) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
