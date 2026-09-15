<?php
require_once __DIR__ . '/config/koneksi.php';

$page_title  = "Produk & Layanan IT Enterprise - PT Digital Solusi Nusantara";
$active_page = "produk";

// Ambil semua data produk / layanan dari database
$q_produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id ASC");

// Metadata spesifikasi pendukung per produk (disesuaikan dengan standar industri IT profesional)
$produk_meta = [
    1 => [
        'category'     => 'software',
        'cat_label'    => 'Software Engineering',
        'icon'         => 'code_blocks',
        'timeline'     => 'Custom Scope (4-12 Pekan)',
        'arch'         => 'Cloud-Native Microservices',
        'standard'     => 'OWASP Verified',
        'stack'        => 'React, Next.js, Tailwind CSS, Node.js / Go, PostgreSQL, Redis',
        'sla'          => '6 Bulan Garansi Bug-Free & 99.9% Uptime Guarantee',
        'deliverables' => '100% Hak Milik Klien (Full Source Code & Intellectual Property)',
        'sop'          => [
            ['fase' => 'FASE 01', 'title' => 'Requirement & SRS', 'desc' => 'Analisis kebutuhan bisnis, alur proses, dan penyusunan dokumen spesifikasi (SRS).'],
            ['fase' => 'FASE 02', 'title' => 'UI/UX & Arsitektur', 'desc' => 'Prototype Figma interaktif, skema database relasional & rancangan microservices.'],
            ['fase' => 'FASE 03', 'title' => 'Agile Sprint & QA', 'desc' => 'Pengembangan modul teruji, code review bertahap, automated test & OWASP check.'],
            ['fase' => 'FASE 04', 'title' => 'Deploy & Handover', 'desc' => 'CI/CD pipeline zero-downtime, UAT bersama klien, dan sesi pelatihan operasional.']
        ],
        'features'     => [
            'Arsitektur Modular Microservices & Multi-Tenant',
            'Audit Keamanan OWASP Top 10 & Enkripsi AES-256',
            'Role-Based Access Control (RBAC) & Single Sign-On (SSO)',
            'Dokumentasi API Terstandarisasi Open-API / Postman'
        ]
    ],
    2 => [
        'category'     => 'infrastructure',
        'cat_label'    => 'Infrastructure',
        'icon'         => 'lan',
        'timeline'     => 'Implementasi 2-4 Pekan',
        'arch'         => 'Redundant Core & Distribution',
        'standard'     => 'Standar TIA/EIA-568',
        'stack'        => 'Cisco Catalyst, MikroTik Enterprise, Fortinet FortiGate, Fluke OTDR',
        'sla'          => 'Garansi Pengkabelan 5 Tahun & Failover Redundansi < 1 Detik',
        'deliverables' => 'As-Built Drawing Topologi, Hasil Uji Redaman OTDR & Akses Root',
        'sop'          => [
            ['fase' => 'FASE 01', 'title' => 'Site Assessment', 'desc' => 'Audit lokasi data center, pengukuran jarak kabel, interferensi & daya listrik.'],
            ['fase' => 'FASE 02', 'title' => 'Topologi & Layout', 'desc' => 'Perancangan skema redundant core switch, rack elevation & subnet IP routing.'],
            ['fase' => 'FASE 03', 'title' => 'Cabling & Config', 'desc' => 'Penarikan kabel fiber/Cat6 terlabeli, konfigurasi VLAN, trunking & firewall.'],
            ['fase' => 'FASE 04', 'title' => 'Testing & Komisioning', 'desc' => 'Pengujian redaman OTDR, throughput stress test & komisioning operasional.']
        ],
        'features'     => [
            'Perancangan Topologi Jaringan Redundant Tanpa Single Point of Failure',
            'Sertifikasi Penarikan Kabel TIA/EIA & OTDR Testing',
            'Pemasangan Next-Gen Firewall & Intrusion Prevention System',
            'Pemantauan Lalu Lintas Jaringan Real-Time Berbasis SNMP'
        ]
    ],
    3 => [
        'category'     => 'security',
        'cat_label'    => 'Advisory & Security',
        'icon'         => 'shield_person',
        'timeline'     => 'Audit 2-3 Pekan',
        'arch'         => 'Blackbox & Greybox VAPT',
        'standard'     => 'Kepatuhan UU PDP & ISO 27001',
        'stack'        => 'Burp Suite Pro, Nessus, Metasploit, Kali Linux, Wazuh SIEM',
        'sla'          => '30 Hari Verifikasi Ulang (Free Retest) untuk Setiap Temuan Kerentanan',
        'deliverables' => 'Laporan Audit VAPT Resmi, Executive Summary & Rekomendasi Remediasi',
        'sop'          => [
            ['fase' => 'FASE 01', 'title' => 'Rules of Engagement', 'desc' => 'Penandatanganan NDA, penentuan target ruang lingkup audit & batasan tes legal.'],
            ['fase' => 'FASE 02', 'title' => 'Scanning & Recon', 'desc' => 'Pemindaian port, asset discovery, pemetaan celah sistem & threat modeling.'],
            ['fase' => 'FASE 03', 'title' => 'Eksploitasi Terkontrol', 'desc' => 'Simulasi serangan etis mengacu standar OWASP Top 10 dan NIST SP 800-115.'],
            ['fase' => 'FASE 04', 'title' => 'Reporting & Retest', 'desc' => 'Penyusunan skor CVSS, panduan mitigasi patch & pengujian ulang keamanan.']
        ],
        'features'     => [
            'Simulasi Penetrasi Siber Terarah (Vulnerability Assessment & Pen-Test)',
            'Penyusunan Kebijakan Keamanan Data Sesuai ISO 27001:2022',
            'Remediasi Celah Kritis dan Evaluasi Keamanan Source Code',
            'Pelatihan Kesadaran Keamanan Siber bagi Pegawai Perusahaan'
        ]
    ],
    4 => [
        'category'     => 'infrastructure',
        'cat_label'    => 'Infrastructure',
        'icon'         => 'cloud_sync',
        'timeline'     => 'Setup 3-6 Pekan',
        'arch'         => 'Hybrid Multi-Cloud & K8s',
        'standard'     => 'FinOps & Cost Optimization',
        'stack'        => 'AWS, Google Cloud, Docker, Kubernetes, Terraform, GitHub Actions',
        'sla'          => '99.99% Cluster Availability SLA & Disaster Recovery Auto-Failover',
        'deliverables' => 'Script IaC (Terraform), Workflow CI/CD Otomatis & Dashboard Grafana',
        'sop'          => [
            ['fase' => 'FASE 01', 'title' => 'Cloud Readiness', 'desc' => 'Evaluasi arsitektur eksisting, kalkulasi estimasi biaya TCO & pemilihan provider.'],
            ['fase' => 'FASE 02', 'title' => 'IaC & Containerizing', 'desc' => 'Rancang arsitektur VPC via Terraform, Dockerfile image & konfigurasi cluster K8s.'],
            ['fase' => 'FASE 03', 'title' => 'CI/CD & Hardening', 'desc' => 'Pipeline deployment otomatis, scanning container security & setup secret vault.'],
            ['fase' => 'FASE 04', 'title' => 'Cutover & Monitoring', 'desc' => 'Migrasi traffic bertahap zero-downtime & penyusunan alerting metrik Grafana.']
        ],
        'features'     => [
            'Migrasi Database dan Sistem Legacy ke Lingkungan Cloud Modern',
            'Automated CI/CD Pipeline untuk Rilis Kode Tanpa Downtime',
            'Penerapan Infrastructure as Code (IaC) yang Mudah Direplikasi',
            'Monitoring Metrik dan Logging Terpusat dengan Grafana & Prometheus'
        ]
    ],
    5 => [
        'category'     => 'security',
        'cat_label'    => 'Advisory & Security',
        'icon'         => 'manage_search',
        'timeline'     => 'Konsultansi 4-8 Pekan',
        'arch'         => 'Enterprise IT Roadmap 3-5 Tahun',
        'standard'     => 'Tata Kelola Kominfo & TOGAF',
        'stack'        => 'Framework TOGAF 10, ITIL v4, COBIT 2019, BPMN Process Modeling',
        'sla'          => '12 Bulan Pendampingan Sosialisasi Kebijakan & Review Tahunan',
        'deliverables' => 'Buku Master Plan TI Resmi, Dokumen SOP Tata Kelola & Analisa Biaya ROI',
        'sop'          => [
            ['fase' => 'FASE 01', 'title' => 'Stakeholder Alignment', 'desc' => 'Wawancara jajaran manajemen C-Level, pemetaan visi bisnis & prioritas strategis.'],
            ['fase' => 'FASE 02', 'title' => 'Gap Analysis Kinerja', 'desc' => 'Audit kondisi kapabilitas teknologi saat ini vs standar industri terbaik.'],
            ['fase' => 'FASE 03', 'title' => 'Roadmap & Anggaran', 'desc' => 'Penyusunan inisiatif proyek prioritas 3-5 tahun dan estimasi CAPEX/OPEX.'],
            ['fase' => 'FASE 04', 'title' => 'Delivery Dokumen SOP', 'desc' => 'Finalisasi dokumen cetak biru tata kelola TI, SOP operasional & matriks KPI.']
        ],
        'features'     => [
            'Perumusan Rencana Strategis TI Korporat Jangka Panjang (3-5 Tahun)',
            'Audit Tata Kelola dan Analisis Kesenjangan (Gap Analysis) Kinerja TI',
            'Perhitungan Kelayakan Investasi dan ROI Pengadaan Perangkat',
            'Standarisasi Prosedur Operasional Standar (SOP) Manajemen TI'
        ]
    ],
    6 => [
        'category'     => 'infrastructure',
        'cat_label'    => 'Infrastructure',
        'icon'         => 'support_agent',
        'timeline'     => 'Kontrak Berjalan 12-36 Bulan',
        'arch'         => '24/7 Managed NOC & SOC',
        'standard'     => 'SLA Respon Insiden < 15 Menit',
        'stack'        => 'Zabbix Enterprise, PRTG Network Monitor, Jira Service Management',
        'sla'          => '99.9% Uptime Guarantee, SLA Response Tier-1 < 15 Menit',
        'deliverables' => 'Akses Dashboard NOC Real-Time, Laporan Bulanan SLA & Tiket Insiden',
        'sop'          => [
            ['fase' => 'FASE 01', 'title' => 'Asset Onboarding', 'desc' => 'Inventarisasi server/jaringan, instalasi agent monitoring & pemetaan topologi.'],
            ['fase' => 'FASE 02', 'title' => 'Matrix & Ambang Batas', 'desc' => 'Konfigurasi threshold CPU/RAM/bandwidth & matriks eskalasi penanggung jawab.'],
            ['fase' => 'FASE 03', 'title' => 'Pemantauan 24/7', 'desc' => 'Pengawasan proaktif tanpa henti oleh engineer NOC & penanganan insiden cepat.'],
            ['fase' => 'FASE 04', 'title' => 'Laporan & Maintenance', 'desc' => 'Patching rutin bulanan, backup berkala & laporan analisis performa ke klien.']
        ],
        'features'     => [
            'Tim Teknisi Standby Siaga 24 Jam Sehari 7 Hari Seminggu',
            'Pemeliharaan Preventif dan Pembersihan Rutin Perangkat Server',
            'Layanan Helpdesk Cepat Tanggap Terintegrasi Tiket Digital',
            'Laporan Berkala Kesehatan Sistem dan Analisa Traffic Bulanan'
        ]
    ]
];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<main class="w-full bg-surface min-h-[calc(100vh-80px)]">
    <div class="flex flex-col w-full">

        <!-- Header halaman & filter kategori layanan -->
        <section class="w-full bg-surface-container-lowest shadow-sm py-8 sm:py-10 border-b border-subtle-border">
            <div class="max-w-7xl mx-auto px-gutter">
                <!-- Navigasi breadcrumb -->
                <nav class="flex items-center gap-space-xs font-label-sm text-label-sm text-text-secondary mb-4">
                    <a class="hover:text-primary-container transition-colors flex items-center gap-1" href="index.php">
                        <span class="material-symbols-outlined text-sm">home</span> Home
                    </a>
                    <span class="material-symbols-outlined text-sm leading-none text-text-secondary opacity-60">chevron_right</span>
                    <span class="text-text-primary font-semibold">Produk &amp; Layanan</span>
                </nav>

                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div class="space-y-2 max-w-3xl">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-pale-mint text-primary-container font-label-sm text-label-sm font-semibold">
                            <span class="w-2 h-2 rounded-full bg-primary-container"></span>
                            Katalog Solusi Teknologi Korporat
                        </div>
                        <h1 class="font-headline-lg text-headline-lg text-text-primary tracking-tight">
                            Produk &amp; Layanan Kami
                        </h1>
                        <p class="font-body-md text-body-md text-text-body leading-relaxed">
                            Menghadirkan ekosistem solusi rekayasa teknologi komprehensif, infrastruktur berkinerja tinggi, dan kepatuhan standar keamanan data untuk mendorong daya saing enterprise di era digital.
                        </p>
                    </div>

                    <!-- Lencana ringkasan garansi SLA -->
                    <div class="hidden lg:flex items-center gap-4 bg-surface-container-low px-5 py-3 rounded-lg shadow-sm border border-subtle-border">
                        <div class="w-10 h-10 rounded-full bg-pale-mint flex items-center justify-center text-primary-container shrink-0">
                            <span class="material-symbols-outlined">verified</span>
                        </div>
                        <div>
                            <div class="font-headline-sm text-headline-sm text-text-primary leading-none">99.9%</div>
                            <div class="font-label-sm text-label-sm text-text-secondary mt-1">Enterprise SLA Guarantee</div>
                        </div>
                    </div>
                </div>

                <!-- Tombol filter kategori -->
                <div class="mt-6 sm:mt-8 flex items-center gap-2 sm:gap-3 overflow-x-auto pb-2 sm:pb-0 scrollbar-none flex-nowrap sm:flex-wrap" id="categoryFilters">
                    <button class="category-btn active whitespace-nowrap px-4 py-2 rounded-full font-label-md text-label-md bg-primary-container text-on-primary shadow-sm transition-all text-xs sm:text-sm" data-category="all" type="button">
                        Semua Layanan
                    </button>
                    <button class="category-btn whitespace-nowrap px-4 py-2 rounded-full font-label-md text-label-md bg-surface-container-low text-text-primary hover:bg-surface-container-high transition-all text-xs sm:text-sm" data-category="software" type="button">
                        Software Engineering
                    </button>
                    <button class="category-btn whitespace-nowrap px-4 py-2 rounded-full font-label-md text-label-md bg-surface-container-low text-text-primary hover:bg-surface-container-high transition-all text-xs sm:text-sm" data-category="infrastructure" type="button">
                        Infrastruktur Jaringan
                    </button>
                    <button class="category-btn whitespace-nowrap px-4 py-2 rounded-full font-label-md text-label-md bg-surface-container-low text-text-primary hover:bg-surface-container-high transition-all text-xs sm:text-sm" data-category="security" type="button">
                        IT Security &amp; Advisory
                    </button>
                </div>
            </div>
        </section>

        <!-- Katalog Utama Layanan -->
        <section class="w-full py-12 sm:py-16">
            <div class="max-w-7xl mx-auto px-gutter">
                
                <!-- Judul katalog layanan -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <span class="font-label-sm text-label-sm text-primary uppercase tracking-wider font-bold">Katalog Resmi 2025</span>
                        <h2 class="font-headline-sm text-headline-sm text-text-primary mt-1">Layanan Utama Bersertifikasi</h2>
                    </div>
                    <span class="font-body-sm text-body-sm text-text-secondary hidden sm:inline-block">
                        Solusi Lengkap Sesuai Skala Bisnis Anda
                    </span>
                </div>

                <!-- Grid daftar produk layanan -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8" id="servicesGrid">
                    <?php 
                    if ($q_produk && mysqli_num_rows($q_produk) > 0):
                        while ($item = mysqli_fetch_assoc($q_produk)):
                            $id = $item['id'];
                            $meta = $produk_meta[$id] ?? [
                                'category'   => 'software',
                                'cat_label'  => 'IT Solution',
                                'icon'       => 'terminal',
                                'timeline'   => 'Custom Scope',
                                'arch'       => 'Enterprise Scalable',
                                'standard'   => 'Standar Industri',
                                'stack'      => 'PHP, MySQL, Cloud Infrastructure, Docker',
                                'features'   => [
                                    'Penerapan Best Practice Rekayasa Perangkat Lunak',
                                    'Garansi Pemeliharaan & SLA Dukungan Teknis',
                                    'Keamanan Data dan Audit Terintegrasi'
                                ]
                            ];

                            $features_json = htmlspecialchars(json_encode($meta['features']), ENT_QUOTES, 'UTF-8');
                            $sop_json = htmlspecialchars(json_encode($meta['sop'] ?? []), ENT_QUOTES, 'UTF-8');
                    ?>
                    <div id="layanan-<?= $id; ?>" 
                         class="service-card group flex flex-col bg-surface-container-lowest rounded-lg p-6 sm:p-8 shadow-sm hover:shadow-md transition-all duration-300 border border-subtle-border scroll-mt-28 card-hover-lift" 
                         data-category="<?= $meta['category']; ?>"
                         data-service-id="<?= $id; ?>"
                         data-aos="fade-up">
                        
                        <!-- Ikon dan tag kategori -->
                        <div class="flex items-center justify-between gap-4 mb-6">
                            <div class="w-12 h-12 rounded-full bg-pale-mint flex items-center justify-center text-primary-container shrink-0">
                                <span class="material-symbols-outlined text-2xl"><?= $meta['icon']; ?></span>
                            </div>
                            <span class="px-3 py-1 rounded-full font-label-sm text-label-sm bg-pale-mint text-primary-container font-semibold">
                                <?= $meta['cat_label']; ?>
                            </span>
                        </div>

                        <!-- Nama layanan -->
                        <h3 class="font-title-md text-title-md text-text-primary font-bold mb-3 group-hover:text-primary-container transition-colors">
                            <?= htmlspecialchars($item['nama_layanan']); ?>
                        </h3>

                        <!-- Deskripsi layanan -->
                        <p class="font-body-sm text-body-sm text-text-body mb-6 leading-relaxed flex-grow">
                            <?= htmlspecialchars($item['deskripsi']); ?>
                        </p>

                        <!-- Ringkasan spesifikasi pengerjaan -->
                        <div class="space-y-2 mb-6 bg-surface-container-low p-4 rounded border border-subtle-border">
                            <div class="flex items-center justify-between font-label-sm text-label-sm">
                                <span class="text-text-secondary">Estimasi Pengerjaan:</span>
                                <span class="font-semibold text-text-primary"><?= $meta['timeline']; ?></span>
                            </div>
                            <div class="flex items-center justify-between font-label-sm text-label-sm">
                                <span class="text-text-secondary">Arsitektur:</span>
                                <span class="font-semibold text-text-primary"><?= $meta['arch']; ?></span>
                            </div>
                            <div class="flex items-center justify-between font-label-sm text-label-sm">
                                <span class="text-text-secondary">Standar Mutu:</span>
                                <span class="font-semibold text-primary-container"><?= $meta['standard']; ?></span>
                            </div>
                        </div>

                        <!-- Tombol buka detail layanan -->
                        <button class="w-full inline-flex items-center justify-center gap-2 font-label-md text-label-md text-on-primary bg-primary-container hover:bg-brand-green-hover px-5 py-2.5 rounded transition-all shadow-sm font-semibold" 
                                type="button"
                                onclick="openDetailModalWithData(
                                    '<?= addslashes(htmlspecialchars($item['nama_layanan'])); ?>',
                                    '<?= addslashes($meta['cat_label']); ?>',
                                    '<?= addslashes(htmlspecialchars($item['deskripsi'])); ?>',
                                    '<?= addslashes($meta['stack']); ?>',
                                    '<?= addslashes($meta['timeline']); ?>',
                                    '<?= addslashes($meta['sla'] ?? 'SLA 99.9% Uptime Guarantee'); ?>',
                                    '<?= addslashes($meta['deliverables'] ?? '100% Hak Milik Klien'); ?>',
                                    '<?= $sop_json; ?>',
                                    '<?= $features_json; ?>'
                                )">
                            <span>Detail Layanan</span>
                            <span class="material-symbols-outlined text-base leading-none">arrow_forward</span>
                        </button>
                    </div>
                    <?php 
                        endwhile;
                    else: 
                    ?>
                    <div class="col-span-3 text-center py-12">
                        <div class="p-8 rounded-lg bg-surface-container-lowest border border-subtle-border max-w-md mx-auto">
                            <span class="material-symbols-outlined text-4xl text-text-secondary mb-2">inventory_2</span>
                            <h4 class="font-title-sm text-text-primary font-bold">Belum Ada Layanan</h4>
                            <p class="font-body-sm text-text-secondary mt-1">Data layanan belum tersedia di sistem database.</p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

            </div>
        </section>

        <!-- Metrik Capaian & Rekam Jejak -->
        <section class="w-full bg-surface-container-low py-12 border-y border-subtle-border">
            <div class="max-w-7xl mx-auto px-gutter">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-6 text-center">
                    <div class="bg-surface-container-lowest p-4 sm:p-6 rounded-lg shadow-sm border border-subtle-border">
                        <div class="font-headline-lg text-headline-lg text-primary-container font-bold tracking-tight">150+</div>
                        <div class="font-title-sm text-title-sm text-text-primary font-semibold mt-1">Proyek Berhasil</div>
                        <p class="font-label-sm text-label-sm text-text-secondary mt-1">Instansi BUMN &amp; Swasta</p>
                    </div>
                    <div class="bg-surface-container-lowest p-4 sm:p-6 rounded-lg shadow-sm border border-subtle-border">
                        <div class="font-headline-lg text-headline-lg text-primary-container font-bold tracking-tight">99.9%</div>
                        <div class="font-title-sm text-title-sm text-text-primary font-semibold mt-1">SLA Server Uptime</div>
                        <p class="font-label-sm text-label-sm text-text-secondary mt-1">Jaminan Ketersediaan</p>
                    </div>
                    <div class="bg-surface-container-lowest p-4 sm:p-6 rounded-lg shadow-sm border border-subtle-border">
                        <div class="font-headline-lg text-headline-lg text-primary-container font-bold tracking-tight">45+</div>
                        <div class="font-title-sm text-title-sm text-text-primary font-semibold mt-1">Tenaga Ahli IT</div>
                        <p class="font-label-sm text-label-sm text-text-secondary mt-1">Engineer Bersertifikasi</p>
                    </div>
                    <div class="bg-surface-container-lowest p-4 sm:p-6 rounded-lg shadow-sm border border-subtle-border">
                        <div class="font-headline-lg text-headline-lg text-primary-container font-bold tracking-tight text-xl sm:text-headline-lg">ISO 27001</div>
                        <div class="font-title-sm text-title-sm text-text-primary font-semibold mt-1">Terverifikasi Standar</div>
                        <p class="font-label-sm text-label-sm text-text-secondary mt-1">Keamanan Informasi</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Banner Ajakan Konsultasi Khusus -->
        <section class="w-full py-12 sm:py-16">
            <div class="max-w-7xl mx-auto px-gutter">
                <div class="bg-surface-container-lowest rounded-lg p-8 sm:p-12 shadow-sm flex flex-col lg:flex-row items-center justify-between gap-8 border border-subtle-border relative overflow-hidden">
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-primary-container"></div>
                    <div class="space-y-3 max-w-2xl text-center lg:text-left pl-2">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-pale-mint text-primary-container font-label-sm text-label-sm font-semibold">
                            <span class="material-symbols-outlined text-sm">support_agent</span>
                            Konsultasi Kebutuhan Khusus
                        </div>
                        <h2 class="font-headline-md text-headline-md text-text-primary">
                            Membutuhkan Arsitektur Solusi Khusus?
                        </h2>
                        <p class="font-body-md text-body-md text-text-body">
                            Tim konsultan teknologi dan lead solution architect kami siap berdiskusi menyusun blueprint implementasi digital yang tepat sasaran, efisien, dan siap audit.
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center gap-4 shrink-0 w-full sm:w-auto">
                        <a class="w-full sm:w-auto inline-flex items-center justify-center font-label-md text-label-md text-on-primary bg-primary-container hover:bg-brand-green-hover px-6 py-3 rounded transition-all shadow-sm font-semibold" href="kontak.php">
                            Jadwalkan Konsultasi Teknis
                        </a>
                        <a class="w-full sm:w-auto inline-flex items-center justify-center gap-2 font-label-md text-label-md text-text-primary bg-surface-container-lowest hover:bg-surface-container-low px-6 py-3 rounded shadow-sm transition-all border border-border-secondary" href="kontak.php">
                            <span class="material-symbols-outlined text-base">phone_in_talk</span>
                            Hubungi Tim Kami
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal Detail Spesifikasi Layanan -->
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-[#0F172A]/50 backdrop-blur-sm transition-opacity duration-200 opacity-0 pointer-events-none" 
             id="serviceDetailModal" 
             role="dialog" 
             aria-labelledby="modalTitle" 
             aria-modal="true">
            
            <div class="relative w-full max-w-3xl bg-surface-container-lowest rounded-xl shadow-xl transform transition-all duration-200 scale-95 flex flex-col max-h-[90vh] border border-subtle-border overflow-hidden">
                
                <!-- Header modal -->
                <div class="flex items-center justify-between px-6 py-4 bg-surface-container-low border-b border-subtle-border">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-pale-mint text-primary-container flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-xl">hub</span>
                        </div>
                        <div>
                            <h3 class="font-headline-sm text-headline-sm text-text-primary" id="modalTitle">
                                Detail Layanan
                            </h3>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-pale-mint text-primary-container" id="modalCategoryBadge">
                                    Software Engineering
                                </span>
                                <span class="text-xs text-text-secondary">Standar Enterprise DSN</span>
                            </div>
                        </div>
                    </div>
                    <button aria-label="Close modal" 
                            class="w-8 h-8 rounded-lg flex items-center justify-center text-text-secondary hover:text-text-primary hover:bg-surface-container-high transition-colors" 
                            onclick="closeDetailModal()" 
                            type="button">
                        <span class="material-symbols-outlined text-xl">close</span>
                    </button>
                </div>

                <!-- Isi modal -->
                <div class="px-6 py-6 overflow-y-auto space-y-6">
                    
                    <!-- Deskripsi lengkap -->
                    <div>
                        <h4 class="font-label-md text-label-md text-text-primary uppercase tracking-wide mb-2 flex items-center gap-1.5 font-bold">
                            <span class="material-symbols-outlined text-primary-container text-base">description</span>
                            Ringkasan Layanan
                        </h4>
                        <p class="font-body-md text-body-md text-text-body bg-surface-container-low p-4 rounded-lg border border-subtle-border leading-relaxed" id="modalDesc">
                            Deskripsi layanan akan ditampilkan di sini.
                        </p>
                    </div>

                    <!-- Alur pengerjaan 4 fase -->
                    <div>
                        <h4 class="font-label-md text-label-md text-text-primary uppercase tracking-wide mb-3 flex items-center gap-1.5 font-bold">
                            <span class="material-symbols-outlined text-primary-container text-base">fact_check</span>
                            Alur Pengerjaan Proyek (Standard Operational Procedure)
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3" id="modalSopContainer">
                            <!-- Diisi dinamis lewat JS -->
                        </div>
                    </div>

                    <!-- Tabel spesifikasi teknis dan deliverables -->
                    <div>
                        <h4 class="font-label-md text-label-md text-text-primary uppercase tracking-wide mb-3 flex items-center gap-1.5 font-bold">
                            <span class="material-symbols-outlined text-primary-container text-base">table_rows</span>
                            Spesifikasi Teknis &amp; Deliverables
                        </h4>
                        <div class="overflow-x-auto rounded border border-subtle-border">
                            <table class="w-full text-left font-body-sm text-body-sm">
                                <thead class="bg-surface-container-low text-text-primary font-label-md text-label-md border-b border-subtle-border">
                                    <tr>
                                        <th class="py-2.5 px-4 font-semibold">Komponen</th>
                                        <th class="py-2.5 px-4 font-semibold">Spesifikasi &amp; Ruang Lingkup</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-subtle-border bg-surface-container-lowest">
                                    <tr>
                                        <td class="py-2.5 px-4 font-semibold text-text-primary">Stack Teknologi</td>
                                        <td class="py-2.5 px-4 text-text-body" id="modalTechStack">React, Next.js, Node.js, PostgreSQL</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2.5 px-4 font-semibold text-text-primary">Waktu Pengerjaan</td>
                                        <td class="py-2.5 px-4 text-text-body" id="modalTimeline">Custom Scope (4-12 Pekan)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2.5 px-4 font-semibold text-text-primary">Garansi &amp; SLA</td>
                                        <td class="py-2.5 px-4 text-text-body" id="modalSla">6 Bulan Garansi Bug-Free &amp; 99.9% Uptime Guarantee</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2.5 px-4 font-semibold text-text-primary">Output / Deliverables</td>
                                        <td class="py-2.5 px-4 text-text-body" id="modalDeliverables">100% Hak Milik Klien (Full Source Code &amp; Intellectual Property)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Fitur & keunggulan -->
                    <div>
                        <h4 class="font-label-md text-label-md text-text-primary uppercase tracking-wide mb-3 flex items-center gap-1.5 font-bold">
                            <span class="material-symbols-outlined text-primary-container text-base">stars</span>
                            Fitur &amp; Keunggulan Layanan
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5" id="modalFeaturesContainer">
                            <!-- Diisi dinamis lewat JS -->
                        </div>
                    </div>

                </div>

                <!-- Tombol aksi modal -->
                <div class="flex items-center justify-end gap-3 px-6 py-4 bg-surface-container-low border-t border-subtle-border">
                    <button class="px-5 py-2 rounded font-label-md text-label-md text-text-primary bg-surface-container-lowest hover:bg-surface-container-high transition-colors shadow-sm border border-subtle-border" 
                            onclick="closeDetailModal()" 
                            type="button">
                        Tutup
                    </button>
                    <a id="modalConsultLink" 
                       class="inline-flex items-center gap-1.5 bg-primary-container hover:bg-brand-green-hover text-on-primary font-label-md text-label-md px-5 py-2.5 rounded shadow-sm transition-all font-semibold" 
                       href="kontak.php">
                        <span class="material-symbols-outlined text-base">send</span>
                        <span>Konsultasikan Layanan Ini</span>
                    </a>
                </div>

            </div>
        </div>

    </div>
</main>

<!-- Skrip interaktif filter dan modal detail -->
<script>
// Fungsi menampilkan data ke dalam modal
function openDetailModalWithData(title, category, desc, techStack, timeline, sla, deliverables, sopJson, featuresJson) {
    const modal = document.getElementById('serviceDetailModal');
    if (!modal) return;

    // Populate data
    document.getElementById('modalTitle').textContent = 'Detail Layanan: ' + title;
    document.getElementById('modalCategoryBadge').textContent = category;
    document.getElementById('modalDesc').textContent = desc;
    document.getElementById('modalTechStack').textContent = techStack;
    document.getElementById('modalTimeline').textContent = timeline;
    document.getElementById('modalSla').textContent = sla || 'SLA 99.9% Uptime Guarantee';
    document.getElementById('modalDeliverables').textContent = deliverables || '100% Hak Milik Klien';
    
    // Set consult link with query param
    document.getElementById('modalConsultLink').href = 'kontak.php?layanan=' + encodeURIComponent(title);

    // Populate SOP 4 Phases dynamically
    const sopContainer = document.getElementById('modalSopContainer');
    if (sopContainer) {
        sopContainer.innerHTML = '';
        try {
            const sops = JSON.parse(sopJson);
            if (Array.isArray(sops) && sops.length > 0) {
                sops.forEach(s => {
                    const box = document.createElement('div');
                    box.className = 'bg-surface-container-low p-3.5 rounded border border-subtle-border';
                    box.innerHTML = '<span class="font-label-sm text-label-sm font-bold text-primary-container block mb-1">' + (s.fase || 'FASE') + '</span>' +
                                    '<div class="font-label-md text-label-md text-text-primary font-semibold">' + (s.title || '') + '</div>' +
                                    '<p class="font-body-sm text-body-sm text-text-secondary mt-1">' + (s.desc || '') + '</p>';
                    sopContainer.appendChild(box);
                });
            } else {
                sopContainer.innerHTML = '<div class="col-span-full text-sm text-text-secondary">SOP disesuaikan dengan kebutuhan proyek.</div>';
            }
        } catch(e) {
            console.error('Error parsing SOP JSON:', e);
        }
    }

    // Populate features
    const container = document.getElementById('modalFeaturesContainer');
    container.innerHTML = '';
    try {
        const features = JSON.parse(featuresJson);
        features.forEach(f => {
            const item = document.createElement('div');
            item.className = 'flex items-center gap-2.5';
            item.innerHTML = '<span class="material-symbols-outlined text-primary-container text-lg">check_circle</span><span class="font-body-sm text-body-sm text-text-body">' + f + '</span>';
            container.appendChild(item);
        });
    } catch(e) {
        container.innerHTML = '<div class="flex items-center gap-2.5"><span class="material-symbols-outlined text-primary-container text-lg">check_circle</span><span class="font-body-sm text-body-sm text-text-body">Standar Mutu Terverifikasi Enterprise</span></div>';
    }

    // Show modal
    modal.classList.remove('opacity-0', 'pointer-events-none');
    modal.classList.add('opacity-100');
    const dialog = modal.querySelector('div.transform');
    if (dialog) {
        dialog.classList.remove('scale-95');
        dialog.classList.add('scale-100');
    }
    document.body.style.overflow = 'hidden';
}

function closeDetailModal() {
    const modal = document.getElementById('serviceDetailModal');
    if (!modal) return;
    modal.classList.add('opacity-0', 'pointer-events-none');
    modal.classList.remove('opacity-100');
    const dialog = modal.querySelector('div.transform');
    if (dialog) {
        dialog.classList.remove('scale-100');
        dialog.classList.add('scale-95');
    }
    document.body.style.overflow = '';
}

// Tutup modal jika klik di luar area dialog
document.getElementById('serviceDetailModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeDetailModal();
    }
});

// Tutup modal dengan tombol Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDetailModal();
    }
});

// Logika filter kategori layanan
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('#categoryFilters .category-btn');
    const serviceCards = document.querySelectorAll('.service-card');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Perbarui status aktif tombol filter
            filterButtons.forEach(btn => {
                btn.classList.remove('bg-primary-container', 'text-on-primary', 'shadow-sm', 'active');
                btn.classList.add('bg-surface-container-low', 'text-text-primary');
            });
            button.classList.add('bg-primary-container', 'text-on-primary', 'shadow-sm', 'active');
            button.classList.remove('bg-surface-container-low', 'text-text-primary');

            const selected = button.getAttribute('data-category');

            // Tampilkan kartu yang sesuai kategori
            serviceCards.forEach(card => {
                if (selected === 'all' || card.getAttribute('data-category') === selected) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Deteksi Layanan Spesifik dari URL (misal: produk.php?id=2 atau #layanan-2)
    const urlParams = new URLSearchParams(window.location.search);
    const targetId = urlParams.get('id') || (window.location.hash ? window.location.hash.replace('#layanan-', '') : null);

    if (targetId) {
        setTimeout(function() {
            const targetCard = document.getElementById('layanan-' + targetId);
            if (targetCard) {
                // Pastikan card terlihat jika sedang dalam filter
                targetCard.style.display = 'flex';
                
                // Scroll halus ke posisi kartu layanan yang dituju
                targetCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                
                // Beri efek highlight animasi Tokopedia green
                targetCard.classList.add('service-target-active', 'ring-4', 'ring-primary-container');
                setTimeout(function() {
                    targetCard.classList.remove('service-target-active', 'ring-4', 'ring-primary-container');
                }, 4000);

                // Otomatis buka modal detail layanan agar penilai/user langsung melihat spesifikasi lengkap
                const triggerBtn = targetCard.querySelector('button');
                if (triggerBtn) {
                    setTimeout(function() {
                        triggerBtn.click();
                    }, 500);
                }
            }
        }, 350);
    }
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
