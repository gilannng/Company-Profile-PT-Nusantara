<?php
if (!isset($active_menu)) {
    $active_menu = 'dashboard';
}

$admin_nama = $_SESSION['admin_nama'] ?? 'Administrator';

// Hitung jumlah pesan yang belum dibaca
$unread_sidebar_count = 0;
if (isset($koneksi) && $koneksi) {
    $q_unread_sb = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pesan WHERE status = 'Belum Dibaca'");
    if ($q_unread_sb) {
        $r_unread_sb = mysqli_fetch_assoc($q_unread_sb);
        $unread_sidebar_count = (int)($r_unread_sb['total'] ?? 0);
    }
}
?>

<!-- Mobile Backdrop Overlay -->
<div id="adminSidebarBackdrop" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-40 hidden lg:hidden transition-opacity"></div>

<!-- Sidebar Navigasi Admin -->
<aside id="adminSidebar" class="fixed left-0 top-0 h-screen w-72 bg-surface-container-lowest shadow-xl lg:shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-50 flex flex-col justify-between py-6 px-4 border-r border-subtle-border transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <div class="flex flex-col gap-6">
        
        <!-- Brand Header with Close Button for Mobile -->
        <div class="flex items-center justify-between px-2">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-pale-mint border border-primary-container/30 flex items-center justify-center text-primary-container shrink-0">
                    <span class="material-symbols-outlined text-2xl">hub</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-headline-sm text-title-sm text-text-primary tracking-tight font-bold">DSN Admin</span>
                    <span class="font-label-sm text-label-sm text-text-secondary">Solusi Nusantara CMS</span>
                </div>
            </div>
            <button id="adminSidebarCloseBtn" type="button" class="lg:hidden p-1.5 rounded-lg text-text-secondary hover:bg-surface-container-low hover:text-text-primary transition-colors" aria-label="Tutup Menu">
                <span class="material-symbols-outlined text-xl">close</span>
            </button>
        </div>

        <div class="h-px bg-surface-variant w-full my-0.5"></div>

        <!-- Navigation Links -->
        <nav class="flex flex-col gap-1.5">
            <a href="<?= $admin_root; ?>dashboard.php" 
               class="flex items-center gap-3 px-3 py-2.5 transition-all <?= ($active_menu === 'dashboard') ? 'bg-pale-mint text-primary font-title-sm rounded-lg shadow-sm font-semibold' : 'rounded-lg text-text-secondary hover:bg-surface-container-low hover:text-text-primary'; ?>">
                <span class="material-symbols-outlined text-[20px]">grid_view</span>
                <span class="font-label-md text-label-md">Dashboard</span>
            </a>

            <a href="<?= $admin_root; ?>profil/index.php" 
               class="flex items-center gap-3 px-3 py-2.5 transition-all <?= ($active_menu === 'profil') ? 'bg-pale-mint text-primary font-title-sm rounded-lg shadow-sm font-semibold' : 'rounded-lg text-text-secondary hover:bg-surface-container-low hover:text-text-primary'; ?>">
                <span class="material-symbols-outlined text-[20px]">corporate_fare</span>
                <span class="font-label-md text-label-md">Profil Perusahaan</span>
            </a>

            <a href="<?= $admin_root; ?>produk/index.php" 
               class="flex items-center gap-3 px-3 py-2.5 transition-all <?= ($active_menu === 'produk') ? 'bg-pale-mint text-primary font-title-sm rounded-lg shadow-sm font-semibold' : 'rounded-lg text-text-secondary hover:bg-surface-container-low hover:text-text-primary'; ?>">
                <span class="material-symbols-outlined text-[20px]">inventory_2</span>
                <span class="font-label-md text-label-md">Layanan &amp; Produk</span>
            </a>

            <a href="<?= $admin_root; ?>artikel/index.php" 
               class="flex items-center gap-3 px-3 py-2.5 transition-all <?= ($active_menu === 'artikel') ? 'bg-pale-mint text-primary font-title-sm rounded-lg shadow-sm font-semibold' : 'rounded-lg text-text-secondary hover:bg-surface-container-low hover:text-text-primary'; ?>">
                <span class="material-symbols-outlined text-[20px]">newspaper</span>
                <span class="font-label-md text-label-md">Artikel &amp; Berita</span>
            </a>

            <a href="<?= $admin_root; ?>galeri/index.php" 
               class="flex items-center gap-3 px-3 py-2.5 transition-all <?= ($active_menu === 'galeri') ? 'bg-pale-mint text-primary font-title-sm rounded-lg shadow-sm font-semibold' : 'rounded-lg text-text-secondary hover:bg-surface-container-low hover:text-text-primary'; ?>">
                <span class="material-symbols-outlined text-[20px]">photo_library</span>
                <span class="font-label-md text-label-md">Galeri Foto</span>
            </a>

            <a href="<?= $admin_root; ?>pesan/index.php" 
               class="flex items-center justify-between px-3 py-2.5 transition-all <?= ($active_menu === 'pesan') ? 'bg-pale-mint text-primary font-title-sm rounded-lg shadow-sm font-semibold' : 'rounded-lg text-text-secondary hover:bg-surface-container-low hover:text-text-primary'; ?>">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[20px]">inbox</span>
                    <span class="font-label-md text-label-md">Pesan &amp; Masukan</span>
                </div>
                <?php if ($unread_sidebar_count > 0): ?>
                    <span class="px-2 py-0.5 text-[11px] font-bold rounded-full bg-primary-container text-pure-white shadow-xs">
                        <?= $unread_sidebar_count; ?>
                    </span>
                <?php endif; ?>
            </a>
        </nav>
    </div>

    <!-- Bottom Actions: View Site & Logout -->
    <div class="pt-4 flex flex-col gap-2">
        <a href="<?= $site_root; ?>index.php" target="_blank" 
           class="flex items-center gap-3 px-3 py-2 rounded-lg text-text-secondary hover:bg-surface-container-low hover:text-text-primary transition-all font-label-md text-sm">
            <span class="material-symbols-outlined text-[18px]">open_in_new</span>
            <span>Lihat Web Publik</span>
        </a>

        <div class="h-px bg-surface-variant w-full my-1"></div>

        <a href="<?= $admin_root; ?>logout.php" 
           onclick="return confirm('Apakah Anda yakin ingin keluar (logout) dari panel administrator?');" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-error hover:bg-error-container hover:text-on-error-container transition-colors font-label-md text-label-md font-semibold">
            <span class="material-symbols-outlined text-[20px]">logout</span>
            <span>Logout</span>
        </a>
    </div>
</aside>

<!-- Content Area Wrapper (Offset for lg:72 Sidebar) -->
<div class="min-h-screen flex flex-col w-full lg:pl-72 transition-all duration-300">
    <!-- Top Header Bar -->
    <header class="fixed top-0 left-0 lg:left-72 right-0 h-16 sm:h-20 bg-surface/95 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-30 flex items-center justify-between px-4 sm:px-8 border-b border-subtle-border transition-all">
        <!-- Left: Hamburger Button (Mobile) & Greeting -->
        <div class="flex items-center gap-2.5 sm:gap-3">
            <button id="adminSidebarToggleBtn" type="button" class="lg:hidden p-2 rounded-lg text-text-primary hover:bg-surface-container-low hover:text-primary transition-colors border border-subtle-border flex items-center justify-center shrink-0" aria-label="Buka Menu Navigasi">
                <span class="material-symbols-outlined text-2xl">menu</span>
            </button>
            <div class="flex flex-col gap-0.5">
                <div class="flex items-center text-xs sm:text-label-sm">
                    <span class="font-label-sm text-text-secondary hidden sm:inline">Portal Admin</span>
                    <span class="mx-2 text-text-secondary hidden sm:inline">/</span>
                    <span class="font-semibold text-text-primary truncate max-w-[140px] sm:max-w-none">Halo, <?= htmlspecialchars($admin_nama); ?></span>
                </div>
                <div class="hidden sm:flex items-center gap-1.5 text-text-secondary">
                    <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                    <span class="text-xs font-medium"><?= date('l, d F Y'); ?> • Sistem Aktif</span>
                </div>
            </div>
        </div>

        <!-- Right: Actions & Profile -->
        <div class="flex items-center gap-2 sm:gap-4">
            <a href="<?= $site_root; ?>index.php" target="_blank" 
               class="inline-flex items-center gap-1.5 px-2.5 sm:px-3 py-1.5 rounded-md bg-surface-container-low hover:bg-surface-container-high text-text-primary text-xs font-semibold transition-colors border border-subtle-border">
                <span class="material-symbols-outlined text-[16px]">visibility</span>
                <span class="hidden sm:inline">Web Publik</span>
            </a>

            <div class="h-6 w-px bg-surface-variant hidden sm:block"></div>

            <div class="flex items-center gap-2 sm:gap-3">
                <div class="hidden sm:flex flex-col text-right">
                    <span class="font-label-md text-label-md text-text-primary font-semibold leading-tight"><?= htmlspecialchars($admin_nama); ?></span>
                    <span class="font-label-sm text-label-sm text-primary font-medium">Super Administrator</span>
                </div>
                <div class="w-8 sm:w-9 h-8 sm:h-9 rounded-full bg-primary flex items-center justify-center text-on-primary shadow-sm font-semibold shrink-0">
                    <span class="material-symbols-outlined text-[18px] sm:text-[20px]">person</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Body (Cukup padding-top agar tidak tertutup header fixed) -->
    <main class="w-full bg-background min-h-screen px-4 sm:px-8 pb-16 flex-1 pt-28 sm:pt-32" style="padding-top: max(6.75rem, 108px);">
        <div class="flex flex-col w-full gap-5 sm:gap-6 pb-12 max-w-full">
            <?php show_flash_message(); ?>
