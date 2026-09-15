<?php
require_once __DIR__ . '/config/koneksi.php';

$page_title  = "Profil Perusahaan - PT Digital Solusi Nusantara";
$active_page = "profil";

// Ambil data profil dari database
$q_profil = mysqli_query($koneksi, "SELECT * FROM profil LIMIT 1");
$profil   = ($q_profil && mysqli_num_rows($q_profil) > 0) ? mysqli_fetch_assoc($q_profil) : null;

// Parse Misi per baris
$misi_list = [];
if ($profil && !empty($profil['misi'])) {
    $misi_raw = explode("\n", str_replace("\r", "", $profil['misi']));
    foreach ($misi_raw as $item) {
        $clean = trim($item);
        if (!empty($clean)) {
            $misi_list[] = preg_replace('/^\d+\.\s*/', '', $clean);
        }
    }
}
if (empty($misi_list)) {
    $misi_list = [
        "Mengembangkan perangkat lunak dan arsitektur TI berkualitas tinggi yang mudah diakses dan berdaya guna tinggi.",
        "Memberikan pelayanan konsultasi dan implementasi teknologi berstandar enterprise dengan biaya yang efisien.",
        "Menjamin integritas, keamanan data, serta kepatuhan regulasi dalam setiap produk dan layanan rekayasa.",
        "Memberdayakan talenta digital Indonesia melalui transfer pengetahuan dan kolaborasi berkelanjutan."
    ];
}

// Parse Nilai Perusahaan per baris
$nilai_list = [];
if ($profil && !empty($profil['nilai_perusahaan'])) {
    $nilai_raw = explode("\n", str_replace("\r", "", $profil['nilai_perusahaan']));
    foreach ($nilai_raw as $item) {
        $clean = trim($item);
        if (!empty($clean)) {
            $parts = explode(':', $clean, 2);
            $nilai_list[] = [
                'title' => trim($parts[0]),
                'desc'  => isset($parts[1]) ? trim($parts[1]) : ''
            ];
        }
    }
}
if (empty($nilai_list)) {
    $nilai_list = [
        ['title' => 'Integritas', 'desc' => 'Menjunjung tinggi transparansi, kejujuran kode etik, dan kepatuhan penuh dalam setiap kontrak serta kemitraan yang kami bina.'],
        ['title' => 'Inovasi', 'desc' => 'Selalu mengeksplorasi teknologi modern yang relevan untuk memberikan solusi paling efektif, adaptif, dan tepat sasaran.'],
        ['title' => 'Kehandalan', 'desc' => 'Memastikan sistem dan produk kami bekerja secara optimal, stabil, dan minim downtime demi kelancaran operasional klien.'],
        ['title' => 'Keamanan', 'desc' => 'Mengutamakan perlindungan data sensitif dan infrastruktur digital dengan standar enkripsi serta tata kelola informasi kelas dunia.']
    ];
}

$nilai_icons = [
    'Integritas' => 'verified_user',
    'Integrity'  => 'verified_user',
    'Inovasi'    => 'lightbulb',
    'Innovation' => 'lightbulb',
    'Kehandalan' => 'dns',
    'Reliability'=> 'dns',
    'Keamanan'   => 'lock',
    'Excellence' => 'workspace_premium'
];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<main class="w-full bg-surface min-h-[calc(100vh-20rem)]">
    <div class="flex flex-col w-full">

        <!-- Header halaman & breadcrumb -->
        <section class="w-full bg-surface py-space-lg shadow-sm border-b border-subtle-border">
            <div class="max-w-[1320px] mx-auto px-margin">
                <!-- Navigasi breadcrumb -->
                <nav aria-label="Breadcrumb" class="mb-space-xs">
                    <ol class="flex items-center gap-space-xs font-label-sm text-label-sm text-text-secondary">
                        <li>
                            <a class="hover:text-primary-container transition-colors flex items-center gap-1" href="index.php">
                                <span class="material-symbols-outlined text-[16px]">home</span>
                                <span>Beranda</span>
                            </a>
                        </li>
                        <li class="flex items-center text-text-secondary opacity-60">/</li>
                        <li class="text-text-primary font-label-md text-label-md">Profil Perusahaan</li>
                    </ol>
                </nav>

                <!-- Judul dan deskripsi halaman -->
                <div class="max-w-3xl">
                    <h1 class="font-headline-lg text-headline-lg text-text-primary tracking-tight mb-space-xs">
                        Profil Perusahaan
                    </h1>
                    <p class="font-body-md text-body-md text-text-body leading-relaxed">
                        Mengenal lebih dekat dedikasi, rekam jejak, dan komitmen PT Digital Solusi Nusantara dalam memajukan ekosistem teknologi Indonesia.
                    </p>
                </div>
            </div>
        </section>

        <!-- Konten Utama Profil -->
        <div class="max-w-[1320px] mx-auto px-margin w-full py-space-xl">
            
            <!-- Bagian sejarah perjalanan perusahaan -->
            <section class="bg-pure-white rounded-lg p-space-lg md:p-space-xl mb-space-xl shadow-sm border border-subtle-border overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-start">
                    
                    <!-- Kolom narasi sejarah -->
                    <div class="lg:col-span-7 flex flex-col items-start" data-aos="fade-right" data-aos-duration="700">
                        <div class="inline-flex items-center gap-space-xs px-3 py-1 rounded-full bg-pale-mint text-primary-container font-label-md text-label-md mb-space-md">
                            <span class="material-symbols-outlined text-[16px]">business_center</span>
                            <span>Tentang Kami</span>
                        </div>
                        <h2 class="font-headline-md text-headline-md text-text-primary mb-space-md tracking-tight leading-snug">
                            Perjalanan Membangun Solusi Digital Terpercaya Sejak 2018
                        </h2>
                        <div class="flex flex-col gap-space-md font-body-md text-body-md text-text-body leading-relaxed">
                            <?php if ($profil && !empty($profil['sejarah'])): ?>
                                <p><?= nl2br(htmlspecialchars($profil['sejarah'])); ?></p>
                            <?php else: ?>
                                <p>
                                    PT Digital Solusi Nusantara didirikan pada tahun 2018 sebagai respon terhadap kebutuhan percepatan integrasi teknologi pada sektor bisnis dan layanan publik di Indonesia. Kami memulai langkah dengan tim rekayasa kecil berdedikasi tinggi yang fokus pada arsitektur sistem berbasis cloud dan rekayasa piranti lunak berstandar enterprise.
                                </p>
                                <p>
                                    Dengan lebih dari 150+ proyek sukses yang diimplementasikan di berbagai provinsi, kami terus berkembang menjadi mitra strategis dalam pengembangan aplikasi web dinamis, integrasi cloud, dan keamanan data nasional. Kami percaya bahwa ketahanan infrastruktur komputasi lokal adalah kunci kemandirian ekonomi digital masa depan.
                                </p>
                            <?php endif; ?>
                        </div>

                        <!-- Mini Stats Row -->
                        <div class="grid grid-cols-3 gap-space-md w-full mt-space-lg pt-space-lg bg-surface-container-low p-space-md rounded-lg border border-subtle-border">
                            <div class="flex flex-col">
                                <span class="font-headline-md text-headline-md text-primary-container font-bold">150+</span>
                                <span class="font-body-sm text-body-sm text-text-secondary">Proyek Sukses</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-headline-md text-headline-md text-primary-container font-bold">34</span>
                                <span class="font-body-sm text-body-sm text-text-secondary">Provinsi Jangkauan</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-headline-md text-headline-md text-primary-container font-bold">99.8%</span>
                                <span class="font-body-sm text-body-sm text-text-secondary">SLA Kehandalan</span>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom foto & tonggak sejarah -->
                    <div class="lg:col-span-5 flex flex-col gap-space-md" data-aos="fade-left" data-aos-duration="700">
                        <div class="w-full h-52 rounded-lg overflow-hidden relative shadow-sm border border-subtle-border">
                            <img class="w-full h-full object-cover" 
                                 src="assets/img/galeri_meeting.jpg" 
                                 alt="Kantor PT Digital Solusi Nusantara">
                        </div>

                        <!-- Daftar tonggak pencapaian -->
                        <div class="flex flex-col gap-space-sm bg-surface-container-lowest rounded-lg p-space-md shadow-sm border border-subtle-border">
                            <h3 class="font-title-sm text-title-sm text-text-primary mb-space-xs flex items-center gap-space-xs">
                                <span class="material-symbols-outlined text-primary-container text-[20px]">history_edu</span>
                                <span>Tonggak Sejarah Utama</span>
                            </h3>

                            <!-- Tahun 2018 -->
                            <div class="flex items-start gap-space-md p-space-xs rounded transition-colors hover:bg-surface-container-low">
                                <span class="px-2 py-1 rounded bg-pale-mint text-primary-container font-label-md text-label-md font-semibold shrink-0">2018</span>
                                <div class="flex flex-col">
                                    <span class="font-label-md text-label-md text-text-primary font-semibold">Pendirian Perusahaan</span>
                                    <span class="font-body-sm text-body-sm text-text-secondary">Dimulai dengan 10 insinyur inti di Jakarta Selatan melayani modernisasi sistem instansi.</span>
                                </div>
                            </div>

                            <!-- Tahun 2020 -->
                            <div class="flex items-start gap-space-md p-space-xs rounded transition-colors hover:bg-surface-container-low">
                                <span class="px-2 py-1 rounded bg-pale-mint text-primary-container font-label-md text-label-md font-semibold shrink-0">2020</span>
                                <div class="flex flex-col">
                                    <span class="font-label-md text-label-md text-text-primary font-semibold">Ekspansi Nasional</span>
                                    <span class="font-body-sm text-body-sm text-text-secondary">Penyebaran infrastruktur awan regional ke Sumatera, Jawa, dan Kalimantan.</span>
                                </div>
                            </div>

                            <!-- Tahun 2022 -->
                            <div class="flex items-start gap-space-md p-space-xs rounded transition-colors hover:bg-surface-container-low">
                                <span class="px-2 py-1 rounded bg-pale-mint text-primary-container font-label-md text-label-md font-semibold shrink-0">2023</span>
                                <div class="flex flex-col">
                                    <span class="font-label-md text-label-md text-text-primary font-semibold">Sertifikasi ISO 27001</span>
                                    <span class="font-body-sm text-body-sm text-text-secondary">Standarisasi penuh Manajemen Keamanan Informasi tingkat internasional.</span>
                                </div>
                            </div>

                            <!-- Tahun 2024 -->
                            <div class="flex items-start gap-space-md p-space-xs rounded transition-colors hover:bg-surface-container-low">
                                <span class="px-2 py-1 rounded bg-pale-mint text-primary-container font-label-md text-label-md font-semibold shrink-0">2025</span>
                                <div class="flex flex-col">
                                    <span class="font-label-md text-label-md text-text-primary font-semibold">Mitra Terdepan Digital</span>
                                    <span class="font-body-sm text-body-sm text-text-secondary">Pengembangan ekosistem integrasi AI dan Arsitektur Komputasi Skala Enterprise.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <!-- Bagian Visi & Misi Perusahaan -->
            <section class="w-full mb-space-xl">
                <div class="text-center max-w-2xl mx-auto mb-space-lg">
                    <div class="inline-flex items-center gap-space-xs px-3 py-1 rounded-full bg-pale-mint text-primary-container font-label-md text-label-md mb-space-xs">
                        <span class="material-symbols-outlined text-[16px]">visibility</span>
                        <span>Arah Strategis</span>
                    </div>
                    <h2 class="font-headline-lg text-headline-lg text-text-primary tracking-tight mb-space-xs">
                        Visi &amp; Misi Perusahaan
                    </h2>
                    <p class="font-body-md text-body-md text-text-secondary">
                        Pedoman langkah kami dalam mempersembahkan nilai terbaik bagi klien, pemangku kepentingan, dan bangsa.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
                    <!-- Kartu Visi -->
                    <div class="bg-pure-white rounded-lg p-space-lg md:p-space-xl shadow-sm flex flex-col justify-between relative overflow-hidden border border-subtle-border card-hover-lift" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-full h-1.5 bg-primary-container absolute top-0 left-0 right-0"></div>
                        <div>
                            <div class="flex items-center gap-space-md mb-space-md">
                                <div class="w-12 h-12 rounded-full bg-pale-mint flex items-center justify-center text-primary-container shrink-0">
                                    <span class="material-symbols-outlined text-[26px]">explore</span>
                                </div>
                                <div>
                                    <span class="font-label-sm text-label-sm text-text-secondary uppercase tracking-wider font-semibold">Tujuan Jangka Panjang</span>
                                    <h3 class="font-headline-sm text-headline-sm text-text-primary">Visi Kami</h3>
                                </div>
                            </div>
                            <p class="font-body-lg text-body-lg text-text-body leading-relaxed mb-space-lg italic">
                                &ldquo;<?= htmlspecialchars($profil['visi'] ?? 'Menjadi pilar utama akselerasi digital terpercaya di Indonesia yang menghasilkan solusi teknologi inovatif, andal, dan berkelanjutan untuk mendorong daya saing bangsa di kancah global.'); ?>&rdquo;
                            </p>
                        </div>
                        <!-- Komitmen arsitektur teknologi -->
                        <div class="bg-surface-container-low rounded-lg p-space-md flex items-center gap-space-md border border-subtle-border">
                            <span class="material-symbols-outlined text-primary-container text-[28px] shrink-0">verified</span>
                            <span class="font-body-sm text-body-sm text-text-body font-medium">
                                Fokus pada keberlanjutan arsitektur teknologi &amp; kemandirian infrastruktur lokal.
                            </span>
                        </div>
                    </div>

                    <!-- Kartu Misi -->
                    <div class="bg-pure-white rounded-lg p-space-lg md:p-space-xl shadow-sm flex flex-col justify-between relative overflow-hidden border border-subtle-border card-hover-lift" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-full h-1.5 bg-primary-container absolute top-0 left-0 right-0"></div>
                        <div>
                            <div class="flex items-center gap-space-md mb-space-md">
                                <div class="w-12 h-12 rounded-full bg-pale-mint flex items-center justify-center text-primary-container shrink-0">
                                    <span class="material-symbols-outlined text-[26px]">flag</span>
                                </div>
                                <div>
                                    <span class="font-label-sm text-label-sm text-text-secondary uppercase tracking-wider font-semibold">Komitmen Operasional</span>
                                    <h3 class="font-headline-sm text-headline-sm text-text-primary">Misi Kami</h3>
                                </div>
                            </div>
                            <ul class="flex flex-col gap-space-md font-body-md text-body-md text-text-body">
                                <?php foreach ($misi_list as $misi_item): ?>
                                <li class="flex items-start gap-space-sm">
                                    <span class="material-symbols-outlined text-primary-container text-[22px] shrink-0 mt-0.5">check_circle</span>
                                    <span><?= htmlspecialchars($misi_item); ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Nilai-nilai Utama Perusahaan (Core Values) -->
            <section class="w-full mb-space-xl">
                <div class="max-w-2xl mb-space-lg" data-aos="fade-up">
                    <div class="inline-flex items-center gap-space-xs px-3 py-1 rounded-full bg-pale-mint text-primary-container font-label-md text-label-md mb-space-xs">
                        <span class="material-symbols-outlined text-[16px]">stars</span>
                        <span>Budaya Kerja</span>
                    </div>
                    <h2 class="font-headline-lg text-headline-lg text-text-primary tracking-tight mb-space-xs">
                        Nilai Utama Kami
                    </h2>
                    <p class="font-body-md text-body-md text-text-secondary">
                        Fondasi etika kerja profesional yang mendasari setiap inovasi dan layanan yang kami bangun bersama mitra.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-lg">
                    <?php 
                    $n_idx = 0;
                    foreach ($nilai_list as $nilai): 
                        $icon = $nilai_icons[$nilai['title']] ?? 'verified_user';
                    ?>
                    <div class="bg-pure-white rounded-lg p-space-lg shadow-sm transition-all duration-300 hover:-translate-y-1.5 hover:shadow-md flex flex-col h-full border border-subtle-border card-hover-lift" data-aos="fade-up" data-aos-delay="<?= $n_idx * 100; ?>">
                        <div class="w-12 h-12 rounded-full bg-pale-mint flex items-center justify-center text-primary-container mb-space-md shrink-0">
                            <span class="material-symbols-outlined text-[24px]"><?= $icon; ?></span>
                        </div>
                        <h3 class="font-title-md text-title-md text-text-primary mb-space-xs">
                            <?= htmlspecialchars($nilai['title']); ?>
                        </h3>
                        <p class="font-body-sm text-body-sm text-text-body leading-relaxed">
                            <?= htmlspecialchars($nilai['desc']); ?>
                        </p>
                    </div>
                    <?php 
                    $n_idx++;
                    endforeach; 
                    ?>
                </div>
            </section>

            <!-- Legalitas & Sertifikasi Standar Resmi -->
            <section class="bg-pure-white rounded-lg p-space-lg md:p-space-xl mb-space-xl shadow-sm border border-subtle-border">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-space-lg items-center divide-y md:divide-y-0 md:divide-x divide-subtle-border">
                    <div class="flex items-center gap-space-md pb-space-md md:pb-0">
                        <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-text-primary shrink-0">
                            <span class="material-symbols-outlined text-[26px]">gavel</span>
                        </div>
                        <div>
                            <h4 class="font-title-sm text-title-sm text-text-primary">Legalitas Terdaftar</h4>
                            <p class="font-body-sm text-body-sm text-text-secondary">Resmi terdaftar di Kemenkumham &amp; NIB OSS Republik Indonesia.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-space-md py-space-md md:py-0 md:px-space-md">
                        <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-text-primary shrink-0">
                            <span class="material-symbols-outlined text-[26px]">workspace_premium</span>
                        </div>
                        <div>
                            <h4 class="font-title-sm text-title-sm text-text-primary">ISO/IEC 27001:2022</h4>
                            <p class="font-body-sm text-body-sm text-text-secondary">Sertifikasi Sistem Manajemen Keamanan Informasi terakreditasi.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-space-md pt-space-md md:pt-0 md:pl-space-md">
                        <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-text-primary shrink-0">
                            <span class="material-symbols-outlined text-[26px]">groups</span>
                        </div>
                        <div>
                            <h4 class="font-title-sm text-title-sm text-text-primary">Insinyur Tersertifikasi</h4>
                            <p class="font-body-sm text-body-sm text-text-secondary">Didukung pakar bersertifikasi AWS, Google Cloud, CISSP &amp; Scrum Master.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Banner Ajakan Kemitraan (CTA) -->
            <section class="w-full bg-pure-white rounded-lg p-space-lg md:p-space-xl shadow-sm flex flex-col md:flex-row items-center justify-between gap-space-lg border border-subtle-border">
                <div class="flex items-center gap-space-md">
                    <div class="w-14 h-14 rounded-full bg-pale-mint flex items-center justify-center text-primary-container shrink-0 hidden sm:flex">
                        <span class="material-symbols-outlined text-[32px]">handshake</span>
                    </div>
                    <div>
                        <h3 class="font-headline-sm text-headline-sm text-text-primary mb-1">
                            Ingin Bermitra dengan PT Digital Solusi Nusantara?
                        </h3>
                        <p class="font-body-md text-body-md text-text-secondary">
                            Diskusikan kebutuhan arsitektur sistem, audit keamanan, atau transformasi aplikasi bisnis Anda bersama tim konsultan kami.
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-space-sm shrink-0 w-full md:w-auto">
                    <a class="w-full md:w-auto inline-flex items-center justify-center gap-space-xs font-label-md text-label-md text-pure-white bg-primary-container hover:bg-brand-green-hover px-space-lg py-3 rounded-lg transition-colors shadow-sm font-semibold" href="kontak.php">
                        <span>Hubungi Tim Kami</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>
            </section>

        </div>
    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
