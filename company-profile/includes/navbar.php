<?php
if (!isset($active_page)) {
    $active_page = basename($_SERVER['PHP_SELF'], '.php');
    if ($active_page == 'index') {
        $active_page = 'home';
    }
}
?>
<!-- Header & Sticky Navbar -->
<header class="sticky top-0 z-50 bg-pure-white border-b border-subtle-border shadow-[0_2px_4px_rgba(0,0,0,0.05)]">
    <div class="h-16 sm:h-20 max-w-[1320px] mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-3 sm:gap-4">
        
        <!-- Brand Logo & Nama Perusahaan -->
        <a href="index.php" class="flex items-center gap-2.5 sm:gap-3 shrink-0 group" style="text-decoration: none;">
            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-pale-mint border border-primary-container/30 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-primary text-[22px] sm:text-[24px]">hub</span>
            </div>
            <div class="flex flex-col">
                <span class="text-sm sm:text-headline-sm font-bold text-text-primary leading-tight tracking-tight group-hover:text-primary-container transition-colors">
                    Digital Solusi Nusantara
                </span>
                <span class="text-[10px] sm:text-label-sm text-text-secondary tracking-normal hidden sm:block">
                    IT Enterprise &amp; Solution Partner
                </span>
            </div>
        </a>

        <!-- Desktop Navigation Links -->
        <nav class="hidden lg:flex items-center gap-space-lg h-full">
            <a class="h-full flex items-center transition-colors <?= ($active_page == 'home') ? 'text-primary-container border-b-2 border-primary-container font-title-sm' : 'font-title-sm text-title-sm text-text-primary hover:text-primary-container'; ?>" href="index.php">
                Home
            </a>
            <a class="h-full flex items-center transition-colors <?= ($active_page == 'profil') ? 'text-primary-container border-b-2 border-primary-container font-title-sm' : 'font-title-sm text-title-sm text-text-primary hover:text-primary-container'; ?>" href="profil.php">
                Profil
            </a>
            <a class="h-full flex items-center transition-colors <?= ($active_page == 'produk' || $active_page == 'layanan') ? 'text-primary-container border-b-2 border-primary-container font-title-sm' : 'font-title-sm text-title-sm text-text-primary hover:text-primary-container'; ?>" href="produk.php">
                Layanan
            </a>
            <a class="h-full flex items-center transition-colors <?= ($active_page == 'artikel') ? 'text-primary-container border-b-2 border-primary-container font-title-sm' : 'font-title-sm text-title-sm text-text-primary hover:text-primary-container'; ?>" href="artikel.php">
                Artikel
            </a>
            <a class="h-full flex items-center transition-colors <?= ($active_page == 'galeri') ? 'text-primary-container border-b-2 border-primary-container font-title-sm' : 'font-title-sm text-title-sm text-text-primary hover:text-primary-container'; ?>" href="galeri.php">
                Galeri
            </a>
            <a class="h-full flex items-center transition-colors <?= ($active_page == 'kontak') ? 'text-primary-container border-b-2 border-primary-container font-title-sm' : 'font-title-sm text-title-sm text-text-primary hover:text-primary-container'; ?>" href="kontak.php">
                Kontak
            </a>
        </nav>

        <!-- Right: CTA Konsultasi & Mobile Toggle (Login Admin tersembunyi dari publik) -->
        <div class="flex items-center gap-2 sm:gap-3 shrink-0">
            <a href="kontak.php" class="hidden sm:inline-flex items-center justify-center bg-primary-container hover:bg-brand-green-hover text-pure-white font-label-md text-label-md px-4 py-2 rounded-[6px] shadow-sm font-semibold transition-all">
                <span>Konsultasi</span>
            </a>
            
            <!-- Mobile Menu Button -->
            <button id="mobileMenuBtn" type="button" class="lg:hidden p-2 rounded-md text-text-primary hover:bg-surface-container-low transition-colors" aria-label="Menu Navigasi">
                <span class="material-symbols-outlined text-[24px]">menu</span>
            </button>
        </div>
    </div>

    <!-- Mobile Dropdown Navigation -->
    <div id="mobileMenu" class="hidden lg:hidden bg-pure-white border-t border-subtle-border px-margin py-space-md shadow-md">
        <nav class="flex flex-col gap-1">
            <a class="py-2.5 px-3 rounded-md font-title-sm text-sm <?= ($active_page == 'home') ? 'bg-pale-mint text-primary-container font-bold' : 'text-text-primary hover:bg-surface-container-low'; ?>" href="index.php">
                Home
            </a>
            <a class="py-2.5 px-3 rounded-md font-title-sm text-sm <?= ($active_page == 'profil') ? 'bg-pale-mint text-primary-container font-bold' : 'text-text-primary hover:bg-surface-container-low'; ?>" href="profil.php">
                Profil
            </a>
            <a class="py-2.5 px-3 rounded-md font-title-sm text-sm <?= ($active_page == 'produk' || $active_page == 'layanan') ? 'bg-pale-mint text-primary-container font-bold' : 'text-text-primary hover:bg-surface-container-low'; ?>" href="produk.php">
                Layanan
            </a>
            <a class="py-2.5 px-3 rounded-md font-title-sm text-sm <?= ($active_page == 'artikel') ? 'bg-pale-mint text-primary-container font-bold' : 'text-text-primary hover:bg-surface-container-low'; ?>" href="artikel.php">
                Artikel
            </a>
            <a class="py-2.5 px-3 rounded-md font-title-sm text-sm <?= ($active_page == 'galeri') ? 'bg-pale-mint text-primary-container font-bold' : 'text-text-primary hover:bg-surface-container-low'; ?>" href="galeri.php">
                Galeri
            </a>
            <a class="py-2.5 px-3 rounded-md font-title-sm text-sm <?= ($active_page == 'kontak') ? 'bg-pale-mint text-primary-container font-bold' : 'text-text-primary hover:bg-surface-container-low'; ?>" href="kontak.php">
                Kontak
            </a>
            <div class="pt-2 mt-2 border-t border-subtle-border">
                <a class="inline-flex w-full items-center justify-center bg-primary-container hover:bg-brand-green-hover text-pure-white font-label-md py-2.5 rounded-[6px] font-semibold transition-colors" href="kontak.php">
                    <span>Hubungi Tim Ahli</span>
                </a>
            </div>
        </nav>
    </div>
</header>
