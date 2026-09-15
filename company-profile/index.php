<?php
require_once __DIR__ . '/config/koneksi.php';

$active_page = "home";
$page_title  = "PT Digital Solusi Nusantara - Solusi Teknologi Digital Terpercaya";

// Ambil data profil perusahaan
$q_profil = mysqli_query($koneksi, "SELECT * FROM profil LIMIT 1");
$profil   = ($q_profil && mysqli_num_rows($q_profil) > 0) ? mysqli_fetch_assoc($q_profil) : null;

// Ambil 3 layanan unggulan teratas
$q_produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id ASC LIMIT 3");

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<main class="w-full bg-background">
    <div class="flex flex-col w-full">

        <!-- Bagian Hero Banner -->
        <section class="w-full bg-surface py-space-xl lg:py-20 shadow-sm relative overflow-hidden">
            <div class="max-w-[1320px] mx-auto px-margin">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-center">
                    
                    <!-- Kolom kiri: keunggulan & penawaran utama -->
                    <div class="lg:col-span-7 flex flex-col items-start gap-space-md" data-aos="fade-right" data-aos-duration="800">
                        <div class="inline-flex items-center gap-space-xs bg-pale-mint px-3 py-1 rounded-full">
                            <span class="material-symbols-outlined text-primary text-[18px]">verified</span>
                            <span class="font-label-sm text-label-sm text-primary font-semibold">Resmi &amp; Berbadan Hukum RI</span>
                        </div>
                        
                        <h1 class="font-display text-display text-text-primary tracking-tight">
                            Solusi Teknologi Digital Terpercaya untuk Kemajuan Bisnis Indonesia
                        </h1>
                        
                        <p class="font-body-lg text-body-lg text-text-secondary leading-relaxed max-w-2xl">
                            Akselerasi transformasi operasional Anda bersama mitra IT berpengalaman. Kami merancang arsitektur web tangguh, cloud modern, serta aplikasi mobile berkinerja tinggi untuk enterprise dan UMKM.
                        </p>
                        
                        <div class="flex flex-wrap items-center gap-space-md pt-space-xs w-full sm:w-auto">
                            <a class="inline-flex items-center justify-center bg-primary-container hover:bg-brand-green-hover text-pure-white font-label-md text-label-md px-6 py-3 rounded-[6px] shadow-sm transition-all duration-200 hover:-translate-y-0.5" href="kontak.php">
                                Konsultasi Gratis
                                <span class="material-symbols-outlined text-[18px] ml-2">arrow_forward</span>
                            </a>
                            <a class="inline-flex items-center justify-center bg-pure-white hover:bg-surface-container-low text-text-primary font-label-md text-label-md px-6 py-3 rounded-[6px] shadow-sm transition-all duration-200 border border-border-secondary hover:-translate-y-0.5" href="produk.php">
                                Jelajahi Layanan
                            </a>
                        </div>
                        
                        <!-- Lencana sertifikasi & standar -->
                        <div class="pt-space-md flex items-center gap-space-lg text-text-secondary">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-[20px]">shield</span>
                                <span class="font-label-sm text-label-sm font-medium">Standar ISO/IEC 27001</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-[20px]">support_agent</span>
                                <span class="font-label-sm text-label-sm font-medium">Dukungan SLA 99.9%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom kanan: mockup metrik sistem -->
                    <div class="lg:col-span-5 relative w-full" data-aos="fade-left" data-aos-duration="800">
                        <div class="bg-pure-white rounded-xl shadow-md p-space-lg flex flex-col gap-space-md relative z-10 border border-subtle-border">
                            <!-- Header mockup peramban -->
                            <div class="flex items-center justify-between pb-space-sm bg-surface-container-low p-3 rounded-lg">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full bg-error inline-block"></span>
                                    <span class="w-3 h-3 rounded-full bg-tertiary-fixed-dim inline-block"></span>
                                    <span class="w-3 h-3 rounded-full bg-primary inline-block"></span>
                                    <span class="font-label-sm text-label-sm text-text-secondary ml-2 font-mono">dsn-dashboard.enterprise.id</span>
                                </div>
                                <span class="material-symbols-outlined text-text-secondary text-[18px]">lock</span>
                            </div>

                            <!-- Metrik performa sistem -->
                            <div class="flex items-center justify-between pt-2">
                                <div>
                                    <span class="font-label-sm text-label-sm text-text-secondary block">Efisiensi Sistem Terintegrasi</span>
                                    <span class="font-headline-md text-headline-md text-text-primary font-bold">+74.8%</span>
                                </div>
                                <span class="bg-pale-mint text-primary font-label-md text-label-md px-2.5 py-1 rounded-full flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">trending_up</span> Optimal
                                </span>
                            </div>

                            <!-- Grafik visual performa -->
                            <div class="w-full h-28 bg-surface-container-low rounded-lg p-2 flex items-end justify-between gap-1 overflow-hidden">
                                <div class="w-[7%] bg-primary-container rounded-t h-[40%] opacity-70"></div>
                                <div class="w-[7%] bg-primary-container rounded-t h-[52%] opacity-75"></div>
                                <div class="w-[7%] bg-primary-container rounded-t h-[48%] opacity-80"></div>
                                <div class="w-[7%] bg-primary-container rounded-t h-[65%] opacity-85"></div>
                                <div class="w-[7%] bg-primary-container rounded-t h-[58%] opacity-80"></div>
                                <div class="w-[7%] bg-primary-container rounded-t h-[72%] opacity-90"></div>
                                <div class="w-[7%] bg-primary-container rounded-t h-[80%] opacity-95"></div>
                                <div class="w-[7%] bg-primary-container rounded-t h-[68%] opacity-85"></div>
                                <div class="w-[7%] bg-primary-container rounded-t h-[84%] opacity-90"></div>
                                <div class="w-[7%] bg-primary-container rounded-t h-[92%] opacity-95"></div>
                                <div class="w-[7%] bg-primary-container rounded-t h-[88%] opacity-90"></div>
                                <div class="w-[7%] bg-primary rounded-t h-[100%]"></div>
                            </div>

                            <!-- Ringkasan server dan latensi -->
                            <div class="grid grid-cols-2 gap-space-sm pt-2">
                                <div class="bg-surface-container-low p-3 rounded-lg">
                                    <div class="flex items-center gap-2 text-primary mb-1">
                                        <span class="material-symbols-outlined text-[18px]">dns</span>
                                        <span class="font-label-sm text-label-sm text-text-secondary">Uptime Server</span>
                                    </div>
                                    <span class="font-title-md text-title-md text-text-primary font-bold">99.98%</span>
                                </div>
                                <div class="bg-surface-container-low p-3 rounded-lg">
                                    <div class="flex items-center gap-2 text-tertiary-container mb-1">
                                        <span class="material-symbols-outlined text-[18px]">speed</span>
                                        <span class="font-label-sm text-label-sm text-text-secondary">Response Time</span>
                                    </div>
                                    <span class="font-title-md text-title-md text-text-primary font-bold">142 ms</span>
                                </div>
                            </div>

                            <!-- Status integrasi keamanan -->
                            <div class="flex items-center justify-between bg-pale-mint p-3 rounded-lg text-on-primary-container">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary text-[20px]">check_circle</span>
                                    <span class="font-label-md text-label-md font-semibold">Integrasi Cloud Aktif</span>
                                </div>
                                <span class="font-label-sm text-label-sm text-text-secondary">Terproteksi 256-bit</span>
                            </div>
                        </div>

                        <!-- Elemen dekoratif latar -->
                        <div class="absolute -bottom-4 -right-4 w-full h-full bg-pale-mint rounded-xl -z-0 hidden sm:block"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Seksi Tentang Kami -->
        <section class="w-full py-space-xl lg:py-20 bg-pure-white">
            <div class="max-w-[1320px] mx-auto px-margin">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-center">
                    
                    <!-- Ringkasan sejarah & profil -->
                    <div class="lg:col-span-6 flex flex-col items-start gap-space-md" data-aos="fade-up" data-aos-duration="700">
                        <span class="bg-pale-mint text-primary font-label-sm text-label-sm font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                            Tentang Kami
                        </span>
                        <h2 class="font-headline-lg text-headline-lg text-text-primary tracking-tight">
                            Membangun Ekosistem Digital Berkelanjutan Sejak 2018
                        </h2>
                        <p class="font-body-md text-body-md text-text-secondary leading-relaxed">
                            <?php if ($profil && !empty($profil['sejarah'])): ?>
                                <?= htmlspecialchars(mb_substr($profil['sejarah'], 0, 260)) . '...'; ?>
                            <?php else: ?>
                                PT Digital Solusi Nusantara hadir dengan satu komitmen tegas: menjembatani kesenjangan digital pada dunia usaha di Indonesia. Kami merekayasa solusi teknologi tangkas mulai dari arsitektur backend berskala masif hingga platform digital ramah pengguna.
                            <?php endif; ?>
                        </p>
                        <p class="font-body-md text-body-md text-text-secondary leading-relaxed">
                            Berbekal metodologi pengembangan agile dan prinsip continuous delivery, kami memastikan setiap baris kode yang kami rilis memberikan efisiensi nyata pada neraca bisnis dan operasional harian Anda.
                        </p>
                        <a class="inline-flex items-center justify-center bg-pure-white hover:bg-surface-container-low text-text-primary font-label-md text-label-md px-6 py-3 rounded-[6px] shadow-sm transition-all duration-200 mt-space-xs border border-border-secondary hover:-translate-y-0.5" href="profil.php">
                            Baca Selengkapnya
                            <span class="material-symbols-outlined text-[18px] ml-2">chevron_right</span>
                        </a>
                    </div>

                    <!-- Kartu capaian perusahaan -->
                    <div class="lg:col-span-6 grid grid-cols-1 sm:grid-cols-2 gap-space-md">
                        <!-- Jumlah proyek sukses -->
                        <div class="bg-surface-container-low p-space-lg rounded-xl flex flex-col justify-between shadow-sm border border-subtle-border card-hover-lift" data-aos="zoom-in" data-aos-delay="100">
                            <div class="w-12 h-12 rounded-full bg-pale-mint flex items-center justify-center mb-space-md text-primary">
                                <span class="material-symbols-outlined text-[26px]">task_alt</span>
                            </div>
                            <div>
                                <span class="font-display text-display text-text-primary font-bold block mb-1">150+</span>
                                <h3 class="font-title-sm text-title-sm text-text-primary font-semibold mb-1">Proyek Selesai</h3>
                                <p class="font-body-sm text-body-sm text-text-secondary">Sistem ERP, aplikasi SaaS, e-commerce, &amp; portal web multi-platform tepat sasaran.</p>
                            </div>
                        </div>

                        <!-- Tingkat kepuasan klien -->
                        <div class="bg-surface-container-low p-space-lg rounded-xl flex flex-col justify-between shadow-sm border border-subtle-border card-hover-lift" data-aos="zoom-in" data-aos-delay="200">
                            <div class="w-12 h-12 rounded-full bg-tertiary-fixed flex items-center justify-center mb-space-md text-tertiary">
                                <span class="material-symbols-outlined text-[26px]">sentiment_satisfied</span>
                            </div>
                            <div>
                                <span class="font-display text-display text-text-primary font-bold block mb-1">98%</span>
                                <h3 class="font-title-sm text-title-sm text-text-primary font-semibold mb-1">Kepuasan Klien</h3>
                                <p class="font-body-sm text-body-sm text-text-secondary">Evaluasi positif atas akurasi implementasi, ketepatan tenggat, dan reliabilitas servis.</p>
                            </div>
                        </div>

                        <!-- Tim ahli bersertifikasi -->
                        <div class="sm:col-span-2 bg-pale-mint p-space-lg rounded-xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-space-md shadow-sm border border-primary-container/20 card-hover-lift" data-aos="zoom-in" data-aos-delay="300">
                            <div class="flex items-center gap-space-md">
                                <div class="w-12 h-12 rounded-full bg-pure-white flex items-center justify-center shrink-0 text-primary shadow-sm">
                                    <span class="material-symbols-outlined text-[26px]">group</span>
                                </div>
                                <div>
                                    <span class="font-headline-md text-headline-md text-text-primary font-bold">12+ Tim Ahli Profesional</span>
                                    <p class="font-body-sm text-body-sm text-text-body">Software Engineer, Cloud Solutions Architect, &amp; QA bersertifikasi industri.</p>
                                </div>
                            </div>
                            <span class="bg-pure-white text-primary font-label-md text-label-md px-3 py-1.5 rounded-full font-semibold shrink-0 shadow-sm border border-subtle-border">
                                Sertifikasi Global
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Seksi Layanan Unggulan -->
        <section class="w-full py-space-xl lg:py-20 bg-surface">
            <div class="max-w-[1320px] mx-auto px-margin">
                <!-- Judul seksi layanan -->
                <div class="flex flex-col items-center text-center max-w-2xl mx-auto mb-space-xl" data-aos="fade-up">
                    <span class="bg-pale-mint text-primary font-label-sm text-label-sm font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-space-xs">
                        Layanan Kami
                    </span>
                    <h2 class="font-headline-lg text-headline-lg text-text-primary tracking-tight mb-space-xs">
                        Solusi Komprehensif Sesuai Skala Bisnis Anda
                    </h2>
                    <p class="font-body-md text-body-md text-text-secondary">
                        Layanan teknologi informasi yang dirancang terstruktur, scalable, dan mudah diintegrasikan dengan infrastruktur yang sudah berjalan.
                    </p>
                </div>

                <!-- Daftar layanan dari database -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-space-lg">
                    <?php 
                    $service_icons = [
                        1 => 'terminal',
                        2 => 'layers',
                        3 => 'cloud_sync',
                        4 => 'security',
                        5 => 'insights',
                        6 => 'support_agent'
                    ];

                    $service_features = [
                        1 => [
                            'Progressive Web Apps (PWA) & Native Mobile',
                            'Integrasi Gateway Pembayaran & API Pihak Ketiga',
                            'Penerapan UI/UX Responsif Berstandar Aksesibilitas'
                        ],
                        2 => [
                            'Modul Supply Chain & Pelaporan Finansial Real-Time',
                            'Hierarki Kontrol Otoritas & Role Access Akurat',
                            'Migrasi Basis Data Warisan (Legacy) Tanpa Downtime'
                        ],
                        3 => [
                            'Setup CI/CD Pipeline & Containerization (Docker/K8s)',
                            'Audit Kerentanan (Pen-test) & Mitigasi DDoS',
                            'Penyusunan Rencana Disaster Recovery & Backup Rutin'
                        ]
                    ];

                    if ($q_produk && mysqli_num_rows($q_produk) > 0):
                        $p_idx = 1;
                        while ($item = mysqli_fetch_assoc($q_produk)): 
                            $icon_name = $service_icons[$item['id']] ?? 'build';
                            $features  = $service_features[$p_idx] ?? [
                                'Arsitektur kode bersih & berkinerja tinggi',
                                'Dukungan SLA dan pemeliharaan berkesinambungan',
                                'Standar dokumentasi teknis rapi dan teruji'
                            ];
                            $target_service_url = 'produk.php?id=' . $item['id'] . '#layanan-' . $item['id'];
                    ?>
                    <div class="bg-pure-white rounded-lg p-space-lg shadow-sm hover:-translate-y-1.5 hover:shadow-md transition-all duration-300 flex flex-col justify-between border border-subtle-border card-hover-lift" data-aos="fade-up" data-aos-delay="<?= ($p_idx - 1) * 150; ?>">
                        <div>
                            <div class="w-12 h-12 rounded-full bg-pale-mint flex items-center justify-center mb-space-md group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-primary text-[24px]"><?= $icon_name; ?></span>
                            </div>
                            <h3 class="font-headline-sm text-headline-sm text-text-primary mb-space-xs">
                                <a href="<?= $target_service_url; ?>" class="hover:text-primary transition-colors">
                                    <?= htmlspecialchars($item['nama_layanan']); ?>
                                </a>
                            </h3>
                            <p class="font-body-sm text-body-sm text-text-secondary mb-space-md leading-relaxed">
                                <?= htmlspecialchars($item['deskripsi']); ?>
                            </p>
                            <ul class="flex flex-col gap-space-xs font-body-sm text-body-sm text-text-body mb-space-lg">
                                <?php foreach ($features as $f): ?>
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary text-[18px]">check_circle</span>
                                    <span><?= htmlspecialchars($f); ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <a class="font-label-md text-label-md text-primary hover:text-brand-green-hover font-semibold inline-flex items-center group pt-2" href="<?= $target_service_url; ?>">
                            Pelajari Selengkapnya
                            <span class="material-symbols-outlined text-[18px] ml-1 group-hover:translate-x-1.5 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                    <?php 
                        $p_idx++;
                        endwhile; 
                    endif; 
                    ?>
                </div>
            </div>
        </section>

        <!-- Banner Ajakan Konsultasi (CTA) -->
        <section class="w-full py-space-xl bg-surface" data-aos="fade-up">
            <div class="max-w-[1320px] mx-auto px-margin">
                <div class="bg-pale-mint rounded-xl p-space-lg sm:p-space-xl shadow-sm flex flex-col lg:flex-row items-center justify-between gap-space-lg relative overflow-hidden border border-primary-container/20">
                    <!-- Deskripsi ajakan konsultasi -->
                    <div class="flex flex-col gap-space-xs text-center lg:text-left max-w-2xl relative z-10">
                        <div class="inline-flex items-center gap-2 text-primary font-label-sm text-label-sm font-semibold justify-center lg:justify-start">
                            <span class="material-symbols-outlined text-[18px]">handshake</span>
                            <span>Kemitraan Jangka Panjang</span>
                        </div>
                        <h2 class="font-headline-lg text-headline-lg text-text-primary tracking-tight">
                            Siap Mengembangkan Bisnis Anda ke Ranah Digital?
                        </h2>
                        <p class="font-body-md text-body-md text-text-body">
                            Jadwalkan sesi konsultasi 30 menit tanpa biaya bersama tim arsitek solusi kami untuk mengidentifikasi potensi percepatan teknologi perusahaan Anda.
                        </p>
                    </div>
                    <!-- Tombol aksi kontak -->
                    <div class="shrink-0 relative z-10 w-full sm:w-auto text-center">
                        <a class="inline-flex items-center justify-center bg-primary-container hover:bg-brand-green-hover text-pure-white font-label-md text-label-md px-8 py-4 rounded-[6px] shadow-sm transition-all duration-200 w-full sm:w-auto font-semibold hover:-translate-y-0.5" href="kontak.php">
                            Hubungi Tim Kami Sekarang
                            <span class="material-symbols-outlined text-[20px] ml-2">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
