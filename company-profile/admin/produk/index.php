<?php
require_once __DIR__ . '/../../config/koneksi.php';

$admin_title = "Kelola Layanan IT - CMS";
$active_menu = "produk";

$q_produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id DESC");

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h1 class="font-headline-md text-headline-md text-text-primary tracking-tight font-bold">Layanan &amp; Solusi IT</h1>
        <p class="font-body-sm text-body-sm text-text-secondary mt-0.5">Kelola portofolio kapabilitas teknologi yang ditampilkan pada halaman publik.</p>
    </div>
    <div class="shrink-0">
        <a href="tambah.php" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-primary-container hover:bg-brand-green-hover text-pure-white font-label-md text-label-md font-semibold shadow-sm transition-all">
            <span class="material-symbols-outlined text-[18px]">add</span>
            <span>Tambah Layanan Baru</span>
        </a>
    </div>
</div>

<div class="bg-surface-container-lowest rounded-xl shadow-sm border border-subtle-border overflow-hidden">
    <div class="p-5 border-b border-subtle-border flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-surface-bright">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-[20px]">inventory_2</span>
            <span class="font-title-sm text-title-sm text-text-primary font-bold">Daftar Layanan Terdaftar</span>
        </div>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-pale-mint text-primary-container border border-primary-container/20">
            <?= mysqli_num_rows($q_produk); ?> Total Layanan
        </span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left font-body-sm text-body-sm">
            <thead class="bg-surface-container-low text-text-secondary font-label-sm text-label-sm uppercase tracking-wider border-b border-subtle-border">
                <tr>
                    <th class="py-3.5 px-6 font-semibold w-16 text-center">No</th>
                    <th class="py-3.5 px-6 font-semibold w-32">Gambar</th>
                    <th class="py-3.5 px-6 font-semibold min-w-[200px]">Nama Layanan</th>
                    <th class="py-3.5 px-6 font-semibold min-w-[280px]">Deskripsi Singkat</th>
                    <th class="py-3.5 px-6 font-semibold text-right w-36">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-subtle-border text-text-primary">
                <?php 
                $no = 1;
                if ($q_produk && mysqli_num_rows($q_produk) > 0):
                    while ($row = mysqli_fetch_assoc($q_produk)):
                        $img_path = '../../assets/img/uploads/' . htmlspecialchars($row['gambar']);
                        $img_src = (!empty($row['gambar']) && file_exists(__DIR__ . '/' . $img_path))
                            ? $img_path
                            : '../../assets/img/uploads/layanan_webdev.svg';
                ?>
                <tr class="hover:bg-surface-container-low/50 transition-colors">
                    <td class="py-4 px-6 text-center text-text-secondary font-medium"><?= $no++; ?></td>
                    <td class="py-4 px-6">
                        <img src="<?= $img_src; ?>" alt="" class="rounded-lg border border-subtle-border w-20 h-12 object-cover bg-slate-900">
                    </td>
                    <td class="py-4 px-6">
                        <div class="font-title-sm text-title-sm text-text-primary font-bold leading-snug"><?= htmlspecialchars($row['nama_layanan']); ?></div>
                    </td>
                    <td class="py-4 px-6 text-text-secondary leading-relaxed text-sm">
                        <?= htmlspecialchars(substr($row['deskripsi'], 0, 130)) . (strlen($row['deskripsi']) > 130 ? '...' : ''); ?>
                    </td>
                    <td class="py-4 px-6 text-right whitespace-nowrap">
                        <div class="inline-flex items-center gap-1.5">
                            <a href="edit.php?id=<?= $row['id']; ?>" 
                               class="p-2 rounded-lg bg-surface-container-low hover:bg-surface-container-high text-primary hover:text-brand-green-hover transition-colors" 
                               title="Ubah Data">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </a>
                            <a href="hapus.php?id=<?= $row['id']; ?>" 
                               onclick="return confirm('Apakah Anda yakin ingin menghapus layanan: <?= addslashes(htmlspecialchars($row['nama_layanan'])); ?>?');" 
                               class="p-2 rounded-lg bg-surface-container-low hover:bg-error/10 text-error transition-colors" 
                               title="Hapus Data">
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
                    <td colspan="5" class="py-12 text-center text-text-secondary">
                        <span class="material-symbols-outlined text-4xl text-text-secondary/50 mb-2 block">inventory_2</span>
                        <div class="font-semibold text-text-primary">Belum ada data layanan IT</div>
                        <p class="text-sm mt-1">Klik tombol "+ Tambah Layanan Baru" di atas untuk menambahkan portofolio solusi pertama.</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
