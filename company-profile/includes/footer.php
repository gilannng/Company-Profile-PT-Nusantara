<?php
// Ambil info kontak perusahaan dari database
$footer_profil = null;
if (isset($koneksi) && $koneksi) {
    $q_profil_footer = mysqli_query($koneksi, "SELECT nama_perusahaan, alamat, telepon, email FROM profil LIMIT 1");
    if ($q_profil_footer && mysqli_num_rows($q_profil_footer) > 0) {
        $footer_profil = mysqli_fetch_assoc($q_profil_footer);
    }
}
$company_name = $footer_profil['nama_perusahaan'] ?? 'PT Digital Solusi Nusantara';
$company_address = $footer_profil['alamat'] ?? 'Gedung Graha Nusantara Lt. 8, Jl. TB Simatupang No. 18, Cilandak, Jakarta Selatan 12430';
$company_phone = $footer_profil['telepon'] ?? '+62 21 555 1234';
$company_email = $footer_profil['email'] ?? 'info@digitalsolusi.co.id';
?>

<!-- Footer -->
<footer
    class="w-full bg-[#1E293B] text-footer-text pt-space-xl pb-space-lg mt-auto border-t border-[rgba(255,255,255,0.1)]">
    <div class="max-w-[1320px] mx-auto px-margin">
        <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-space-xl pb-space-xl border-b border-[rgba(255,255,255,0.1)]">

            <!-- Kolom 1: Ringkasan Perusahaan -->
            <div class="flex flex-col gap-space-md">
                <div class="flex items-center gap-space-sm">
                    <div class="w-8 h-8 rounded bg-primary-container flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-on-primary text-[20px]">hub</span>
                    </div>
                    <span class="font-headline-sm text-headline-sm text-pure-white leading-none">
                        <?= htmlspecialchars($company_name); ?>
                    </span>
                </div>
                <p class="font-body-sm text-body-sm text-footer-text leading-relaxed">
                    Mitra transformasi digital terpercaya untuk UMKM dan enterprise di Indonesia dengan arsitektur
                    tangguh dan berstandar internasional.
                </p>
                <div class="flex items-center gap-space-sm mt-space-xs">
                    <span class="material-symbols-outlined text-primary-fixed-dim text-[20px]">verified</span>
                    <span class="font-label-sm text-label-sm text-footer-text">Terdaftar &amp; Berizin Resmi
                        Kominfo</span>
                </div>
            </div>

            <!-- Kolom 2: Tautan Cepat -->
            <div class="flex flex-col gap-space-md">
                <h3 class="font-title-sm text-title-sm text-pure-white tracking-wide">Tautan Cepat</h3>
                <nav class="flex flex-col gap-space-sm">
                    <a class="font-body-sm text-body-sm <?= ($active_page == 'home') ? 'text-primary-fixed font-semibold' : 'text-footer-text hover:text-pure-white transition-colors'; ?>"
                        href="index.php">Home</a>
                    <a class="font-body-sm text-body-sm <?= ($active_page == 'profil') ? 'text-primary-fixed font-semibold' : 'text-footer-text hover:text-pure-white transition-colors'; ?>"
                        href="profil.php">Profil Perusahaan</a>
                    <a class="font-body-sm text-body-sm <?= ($active_page == 'produk' || $active_page == 'layanan') ? 'text-primary-fixed font-semibold' : 'text-footer-text hover:text-pure-white transition-colors'; ?>"
                        href="produk.php">Layanan IT</a>
                    <a class="font-body-sm text-body-sm <?= ($active_page == 'artikel') ? 'text-primary-fixed font-semibold' : 'text-footer-text hover:text-pure-white transition-colors'; ?>"
                        href="artikel.php">Artikel &amp; Edukasi</a>
                    <a class="font-body-sm text-body-sm <?= ($active_page == 'galeri') ? 'text-primary-fixed font-semibold' : 'text-footer-text hover:text-pure-white transition-colors'; ?>"
                        href="galeri.php">Galeri Proyek</a>
                    <a class="font-body-sm text-body-sm <?= ($active_page == 'kontak') ? 'text-primary-fixed font-semibold' : 'text-footer-text hover:text-pure-white transition-colors'; ?>"
                        href="kontak.php">Kontak</a>
                </nav>
            </div>

            <!-- Kolom 3: Layanan Unggulan -->
            <div class="flex flex-col gap-space-md">
                <h3 class="font-title-sm text-title-sm text-pure-white tracking-wide">Layanan Unggulan</h3>
                <ul class="flex flex-col gap-space-sm font-body-sm text-body-sm text-footer-text">
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary-container shrink-0"></span>
                        <span>Pengembangan Web &amp; Mobile</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary-container shrink-0"></span>
                        <span>Sistem Informasi Enterprise</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary-container shrink-0"></span>
                        <span>Cloud &amp; Infrastruktur</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary-container shrink-0"></span>
                        <span>Keamanan Siber &amp; Audit TI</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary-container shrink-0"></span>
                        <span>Integrasi API &amp; Payment Gateway</span>
                    </li>
                </ul>
            </div>

            <!-- Kolom 4: Hubungi Kami -->
            <div class="flex flex-col gap-space-md">
                <h3 class="font-title-sm text-title-sm text-pure-white tracking-wide">Hubungi Kami</h3>
                <div class="flex flex-col gap-space-md font-body-sm text-body-sm text-footer-text">
                    <div class="flex items-start gap-space-sm">
                        <span
                            class="material-symbols-outlined text-primary-fixed-dim text-[20px] shrink-0 mt-0.5">location_on</span>
                        <span><?= nl2br(htmlspecialchars($company_address)); ?></span>
                    </div>
                    <div class="flex items-center gap-space-sm">
                        <span class="material-symbols-outlined text-primary-fixed-dim text-[20px] shrink-0">mail</span>
                        <span><?= htmlspecialchars($company_email); ?></span>
                    </div>
                    <div class="flex items-center gap-space-sm">
                        <span class="material-symbols-outlined text-primary-fixed-dim text-[20px] shrink-0">call</span>
                        <span><?= htmlspecialchars($company_phone); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian Bawah: Copyright Resmi Perusahaan -->
        <div
            class="pt-space-md flex flex-col sm:flex-row items-center justify-between gap-space-sm text-center sm:text-left">
            <p class="font-body-sm text-body-sm text-footer-text">
                &copy; <?= date('Y'); ?> <?= htmlspecialchars($company_name); ?>. Seluruh hak cipta dilindungi.
            </p>
            <div class="flex items-center gap-space-md font-label-sm text-label-sm text-footer-text">
                <span>Kebijakan Privasi</span>
                <span>•</span>
                <span>Syarat &amp; Ketentuan Layanan</span>
            </div>
        </div>
    </div>
</footer>

<!-- AOS (Animate On Scroll) Library -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('mobileMenuBtn');
        const menu = document.getElementById('mobileMenu');
        if (btn && menu) {
            btn.addEventListener('click', function () {
                menu.classList.toggle('hidden');
            });
        }

        // Inisialisasi AOS Animation
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 700,
                easing: 'ease-out-cubic',
                once: true,
                offset: 50,
                delay: 50
            });
        }
    });
</script>
<script src="assets/js/main.js"></script>
</body>

</html>