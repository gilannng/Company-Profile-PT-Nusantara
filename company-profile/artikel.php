<?php
require_once __DIR__ . '/config/koneksi.php';

$page_title = "Wawasan & Artikel Teknologi Terkini - PT Digital Solusi Nusantara";
$active_page = "artikel";

// Ambil semua artikel dari database MySQL
$q_artikel = mysqli_query($koneksi, "SELECT * FROM artikel ORDER BY tanggal DESC");
$artikel_rows = [];
if ($q_artikel && mysqli_num_rows($q_artikel) > 0) {
    while ($row = mysqli_fetch_assoc($q_artikel)) {
        $artikel_rows[] = $row;
    }
}

// Data kurasi tambahan untuk melengkapi metadata artikel agar kaya informasi & interaktif
$curated_articles = [
    [
        'id' => 101,
        'judul' => 'Migrasi Monolith ke Microservices: Strategi & Best Practices',
        'ringkasan' => 'Langkah praktis memecah basis kode lama menjadi arsitektur microservices terdistribusi tanpa mengorbankan performa bisnis dan integrasi database transaksi.',
        'tanggal' => '2025-05-20',
        'category' => 'software',
        'cat_label' => 'Software Engineering',
        'author' => 'Bambang Wicaksono',
        'author_initials' => 'BW',
        'author_role' => 'Principal Software Engineer',
        'read_time' => '4 menit baca',
        'img' => 'assets/img/galeri_sprint_dev.jpg'
    ],
    [
        'id' => 102,
        'judul' => 'Kepatuhan UU Pelindungan Data Pribadi (PDP) pada Aplikasi Web',
        'ringkasan' => 'Aspek teknis penting yang wajib dipenuhi pengembang sistem dalam mengamankan enkripsi data pengguna, manajemen consent, dan alur verifikasi autentikasi.',
        'tanggal' => '2025-05-17',
        'category' => 'security',
        'cat_label' => 'Keamanan Siber',
        'author' => 'Siti Nurhaliza',
        'author_initials' => 'SN',
        'author_role' => 'Cybersecurity & Compliance Lead',
        'read_time' => '6 menit baca',
        'img' => 'assets/img/galeri_workshop_iso.jpg'
    ],
    [
        'id' => 103,
        'judul' => 'Optimalisasi Biaya Server dengan Containerization Docker & Kubernetes',
        'ringkasan' => 'Efisiensi beban kerja server hingga 40% melalui orkestrasi container, pod autoscaling yang tepat guna, serta pemangkasan konsumsi resource menganggur.',
        'tanggal' => '2025-05-12',
        'category' => 'cloud',
        'cat_label' => 'Infrastruktur & Cloud',
        'author' => 'Dedi Gunawan',
        'author_initials' => 'DG',
        'author_role' => 'Cloud Infrastructure Specialist',
        'read_time' => '5 menit baca',
        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCdbiY4hl6va1pw_x60UfvfhmVRj3ymz-HgllTLc4Fv2-93NNYX9CMVQOBN7mBr-D8VzEVkigc1z96SoEK_s4bEYrLbUkna-870uDNJN3ffRSoujPAGQmT090b-ZfxV_vixZIdDoa79xg1IRGn1hbxvNeuAh4UnXBU2iIK99FPvXrEAhlt9NUkLmgTYLAZMiEIYW4P0FI8t2Jn2xfqscblmn1crRPDVfyBtrCBQMdIyW4JQc_5kKCUo'
    ],
    [
        'id' => 104,
        'judul' => '5 Kesalahan Umum Implementasi ERP pada Bisnis Berkembang',
        'ringkasan' => 'Mengidentifikasi kendala adopsi sistem dan strategi manajemen perubahan agar investasi digital perusahaan berbuah hasil optimal tanpa resistensi tim.',
        'tanggal' => '2025-05-08',
        'category' => 'digital',
        'cat_label' => 'Transformasi Digital',
        'author' => 'Ir. Hendro Prasetyo',
        'author_initials' => 'HP',
        'author_role' => 'Head of Enterprise Advisory',
        'read_time' => '4 menit baca',
        'img' => 'assets/img/galeri_kemitraan.jpg'
    ],
    [
        'id' => 105,
        'judul' => 'Membangun Progressive Web App (PWA) Berkinerja Cepat',
        'ringkasan' => 'Teknik service workers, caching cerdas offline, dan desain responsif untuk menghadirkan pengalaman aplikasi native yang ringan di peramban web.',
        'tanggal' => '2025-05-02',
        'category' => 'software',
        'cat_label' => 'Software Engineering',
        'author' => 'Bambang Wicaksono',
        'author_initials' => 'BW',
        'author_role' => 'Principal Software Engineer',
        'read_time' => '3 menit baca',
        'img' => 'assets/img/galeri_tim_dsn.jpg'
    ],
    [
        'id' => 106,
        'judul' => 'Pentingnya Vulnerability Assessment Berkala untuk Instansi',
        'ringkasan' => 'Mengenal metodologi penetration testing, audit konfigurasi server, dan simulasi celah keamanan sebelum sistem di-deploy ke lingkungan produksi publik.',
        'tanggal' => '2025-04-28',
        'category' => 'security',
        'cat_label' => 'Keamanan Siber',
        'author' => 'Siti Nurhaliza',
        'author_initials' => 'SN',
        'author_role' => 'Cybersecurity & Compliance Lead',
        'read_time' => '5 menit baca',
        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD4yB5xyQu5ZOShzBRCOMT-GfgZyKltqXQVZnYyjAZd797CzY5hWOYjBfE2GJfb0UEkFzaBRzbvKM7DQqqynq5NFEk27iBDjw5aaClc3buhEstbMA5U3OzaDhqUH7NnV6VLNrm4lyCu914mnc8DA27iR-qPj24D8i9-_GEVCcJfYwOlesaIeGuNqwB2K8_FbE-svNGMCNfEVcUKix0osw_DZTXOw_EbFRIhhOnBXxuitHK9seagcUaJ'
    ]
];

// Gabungkan artikel dari basis data MySQL dengan artikel kurasi
// Formatkan artikel database agar memiliki kategori, penulis, dan gambar yang selaras
$all_articles = [];

// Helper untuk mendeteksi kategori berdasarkan teks
function detect_category($title, $desc) {
    $haystack = strtolower($title . ' ' . $desc);
    if (strpos($haystack, 'cloud') !== false || strpos($haystack, 'server') !== false || strpos($haystack, 'docker') !== false || strpos($haystack, 'kubernetes') !== false || strpos($haystack, 'infrastruktur') !== false) {
        return ['cloud', 'Infrastruktur & Cloud'];
    } elseif (strpos($haystack, 'keamanan') !== false || strpos($haystack, 'security') !== false || strpos($haystack, 'siber') !== false || strpos($haystack, 'vapt') !== false || strpos($haystack, 'audit') !== false || strpos($haystack, 'zero trust') !== false || strpos($haystack, 'pdp') !== false) {
        return ['security', 'Keamanan Siber'];
    } elseif (strpos($haystack, 'erp') !== false || strpos($haystack, 'transformasi') !== false || strpos($haystack, 'bisnis') !== false || strpos($haystack, 'advisory') !== false) {
        return ['digital', 'Transformasi Digital'];
    } else {
        return ['software', 'Software Engineering'];
    }
}

// Masukkan data dari database terlebih dahulu
$author_pool = [
    ['Ir. Hendro Prasetyo', 'HP', 'Head of Cloud Architecture'],
    ['Bambang Wicaksono', 'BW', 'Principal Software Engineer'],
    ['Siti Nurhaliza', 'SN', 'Cybersecurity Specialist'],
    ['Dedi Gunawan', 'DG', 'DevOps & System Architect']
];

// 6 Gambar Dokumentasi Unik & Beragam (Fokus Kerja Aktif, Coding, Infrastruktur & Analisis - Bukan Foto Berpose)
$distinct_article_images = [
    0 => 'assets/img/galeri_coder_solo.jpg',       // 1. Software Engineer fokus coding di depan dual monitor
    1 => 'assets/img/galeri_sec_analyst.jpg',      // 2. Analis Keamanan Siber di Pusat Operasi CSIRT-ID
    2 => 'assets/img/galeri_datacenter.jpg',       // 3. Pemasangan Rack Server & Fiber Optic di Tier-3 Data Center
    3 => 'assets/img/galeri_qa_testing.jpg',       // 4. Quality Assurance testing aplikasi mobile perbankan
    4 => 'assets/img/galeri_meeting.jpg',          // 5. Perancangan Arsitektur Microservices di Whiteboard
    5 => 'assets/img/galeri_noc.jpg'               // 6. Tim Pemantauan Jaringan Real-time di Network Operations Center
];

$idx = 0;
foreach ($artikel_rows as $row) {
    list($cat, $cat_label) = detect_category($row['judul'], $row['ringkasan']);
    $auth = $author_pool[$idx % count($author_pool)];
    $word_count = str_word_count($row['ringkasan']);
    $read_time = max(3, ceil($word_count / 15)) . ' menit baca';
    
    $all_articles[] = [
        'id' => (int)$row['id'],
        'judul' => $row['judul'],
        'ringkasan' => $row['ringkasan'],
        'tanggal' => $row['tanggal'],
        'category' => $cat,
        'cat_label' => $cat_label,
        'author' => $auth[0],
        'author_initials' => $auth[1],
        'author_role' => $auth[2],
        'read_time' => $read_time,
        'img' => $distinct_article_images[$idx % count($distinct_article_images)]
    ];
    $idx++;
}

// Jika jumlah artikel database sedikit, lengkapi dengan kurasi agar tampilan grid 3-kolom penuh
if (count($all_articles) < 6) {
    foreach ($curated_articles as $ca) {
        $ca['img'] = $distinct_article_images[$idx % count($distinct_article_images)];
        $all_articles[] = $ca;
        $idx++;
        if (count($all_articles) >= 6) break;
    }
}

$total_display = count($all_articles);

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<main class="w-full pt-20 bg-surface">
  <div class="flex flex-col w-full max-w-7xl mx-auto px-margin">

    <!-- Page Header & Filtering Strip -->
    <section class="w-full bg-surface py-space-lg">
      <div class="flex flex-col gap-space-md">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="Breadcrumb" class="flex items-center gap-space-xs text-text-secondary font-label-sm text-label-sm">
          <a class="hover:text-primary-container transition-colors flex items-center gap-1" data-path="home" href="index.php">
            <span class="material-symbols-outlined text-[16px]">home</span>
            <span>Beranda</span>
          </a>
          <span class="material-symbols-outlined text-[14px]">chevron_right</span>
          <span class="text-text-primary font-medium">Artikel &amp; Berita</span>
        </nav>

        <!-- Main Headline Strip -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md pb-space-sm">
          <div class="max-w-3xl">
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-pale-mint text-primary-container font-label-sm text-label-sm mb-2 font-medium">
              <span class="material-symbols-outlined text-[16px]">auto_stories</span>
              <span>Pusat Edukasi &amp; Publikasi Teknis</span>
            </div>
            <h1 class="font-headline-lg text-headline-lg text-text-primary tracking-tight">
              Wawasan &amp; Artikel Teknologi Terkini
            </h1>
            <p class="font-body-md text-body-md text-text-secondary mt-space-xs leading-relaxed">
              Edukasi, analisis tren, panduan arsitektur sistem, dan kabar terbaru dari tim konsultan IT PT Digital Solusi Nusantara.
            </p>
          </div>

          <!-- Metric pill counters -->
          <div class="hidden lg:flex items-center gap-space-md bg-pure-white p-space-sm rounded-xl shadow-sm border border-subtle-border">
            <div class="px-space-md py-space-xs text-center">
              <span class="block font-headline-sm text-headline-sm text-primary-container font-bold"><?= $total_display; ?>+</span>
              <span class="font-label-sm text-label-sm text-text-secondary">Artikel Rilis</span>
            </div>
            <div class="w-px h-8 bg-surface-container-high"></div>
            <div class="px-space-md py-space-xs text-center">
              <span class="block font-headline-sm text-headline-sm text-text-primary font-bold">100%</span>
              <span class="font-label-sm text-label-sm text-text-secondary">Praktisi IT DSN</span>
            </div>
          </div>
        </div>

        <!-- Filter Controls & Real-Time Search Bar -->
        <div class="pt-space-md flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-space-md">
          <!-- Category Filter Pills -->
          <div class="flex items-center gap-2 overflow-x-auto pb-1" id="categoryPillGroup">
            <button class="category-pill whitespace-nowrap px-4 py-2 rounded-full font-label-md text-label-md bg-primary-container text-on-primary shadow-sm hover:bg-brand-green-hover transition-all" data-category="all" type="button">
              Semua Artikel
            </button>
            <button class="category-pill whitespace-nowrap px-4 py-2 rounded-full font-label-md text-label-md bg-pure-white text-text-primary hover:bg-surface-container-low shadow-sm border border-subtle-border transition-all" data-category="software" type="button">
              Software Engineering
            </button>
            <button class="category-pill whitespace-nowrap px-4 py-2 rounded-full font-label-md text-label-md bg-pure-white text-text-primary hover:bg-surface-container-low shadow-sm border border-subtle-border transition-all" data-category="cloud" type="button">
              Infrastruktur &amp; Cloud
            </button>
            <button class="category-pill whitespace-nowrap px-4 py-2 rounded-full font-label-md text-label-md bg-pure-white text-text-primary hover:bg-surface-container-low shadow-sm border border-subtle-border transition-all" data-category="security" type="button">
              Keamanan Siber
            </button>
            <button class="category-pill whitespace-nowrap px-4 py-2 rounded-full font-label-md text-label-md bg-pure-white text-text-primary hover:bg-surface-container-low shadow-sm border border-subtle-border transition-all" data-category="digital" type="button">
              Transformasi Digital
            </button>
          </div>

          <!-- Search Input -->
          <div class="relative w-full lg:w-80 shrink-0">
            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-text-secondary text-[20px]">
              search
            </span>
            <input class="w-full pl-10 pr-4 py-2.5 bg-pure-white text-text-primary font-body-sm text-body-sm rounded-lg shadow-sm border border-subtle-border placeholder:text-footer-text focus:outline-none focus:ring-2 focus:ring-primary-container/20 transition-all" id="articleSearchInput" placeholder="Cari artikel atau topik..." type="search"/>
          </div>
        </div>
      </div>
    </section>



    <!-- Article Cards Grid Section (3 Columns) -->
    <section class="w-full pb-space-xl" id="articleListSection">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-space-lg" id="articlesGrid">
        <?php 
        $art_idx = 0;
        foreach ($all_articles as $art): 
        ?>
        <article class="article-card flex flex-col bg-pure-white border border-subtle-border rounded-xl shadow-sm hover:-translate-y-1.5 hover:shadow-md transition-all duration-300 overflow-hidden card-hover-lift" 
                 data-category="<?= htmlspecialchars($art['category']); ?>"
                 data-aos="fade-up"
                 data-aos-delay="<?= ($art_idx % 3) * 120; ?>">
          <div class="relative h-48 w-full bg-surface-container overflow-hidden">
            <img class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" src="<?= htmlspecialchars($art['img']); ?>" alt="<?= htmlspecialchars($art['judul']); ?>"/>
            <div class="absolute top-3 left-3">
              <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-pure-white/95 text-primary-container font-label-sm text-label-sm font-semibold shadow-xs">
                <?= htmlspecialchars($art['cat_label']); ?>
              </span>
            </div>
          </div>
          <div class="p-space-lg flex flex-col flex-grow justify-between gap-space-md">
            <div class="flex flex-col gap-2">
              <div class="flex items-center gap-2 text-text-secondary font-label-sm text-label-sm">
                <span class="material-symbols-outlined text-[15px]">calendar_today</span>
                <span><?= date('d M Y', strtotime($art['tanggal'])); ?></span>
                <span>•</span>
                <span class="flex items-center gap-1">
                  <span class="material-symbols-outlined text-[15px]">schedule</span>
                  <span><?= htmlspecialchars($art['read_time']); ?></span>
                </span>
              </div>
              <h3 class="font-title-md text-title-md text-text-primary hover:text-primary-container transition-colors line-clamp-2 leading-snug cursor-pointer" onclick="openArticleModal(<?= $art['id']; ?>)">
                <?= htmlspecialchars($art['judul']); ?>
              </h3>
              <p class="font-body-sm text-body-sm text-text-secondary line-clamp-3 leading-relaxed">
                <?= htmlspecialchars($art['ringkasan']); ?>
              </p>
            </div>
            <div class="pt-space-sm mt-auto border-t border-subtle-border/60 flex items-center justify-between">
              <div class="flex items-center gap-2 min-w-0">
                <div class="w-7 h-7 rounded-full bg-surface-container-high flex items-center justify-center text-text-primary text-[12px] font-bold">
                  <?= htmlspecialchars($art['author_initials']); ?>
                </div>
                <span class="font-label-sm text-label-sm text-text-primary truncate"><?= htmlspecialchars($art['author']); ?></span>
              </div>
              <button type="button" onclick="openArticleModal(<?= $art['id']; ?>)" class="inline-flex items-center gap-1 text-primary-container hover:text-brand-green-hover font-label-md text-label-md font-semibold shrink-0 group cursor-pointer">
                <span>Baca Selengkapnya</span>
                <span class="material-symbols-outlined text-[16px] transition-transform group-hover:translate-x-1">arrow_forward</span>
              </button>
            </div>
          </div>
        </article>

        <!-- Hidden JSON data for client modal rendering -->
        <script id="article-data-<?= $art['id']; ?>" type="application/json">
        <?= json_encode($art, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>
        </script>
        <?php 
        $art_idx++;
        endforeach; 
        ?>
      </div>

      <!-- Empty Search State -->
      <div class="hidden flex-col items-center justify-center py-16 text-center bg-pure-white rounded-xl shadow-sm border border-subtle-border my-6" id="noResultsState">
        <div class="w-16 h-16 rounded-full bg-pale-mint flex items-center justify-center text-primary-container mb-3">
          <span class="material-symbols-outlined text-[32px]">search_off</span>
        </div>
        <h4 class="font-headline-sm text-headline-sm text-text-primary font-bold">Artikel Tidak Ditemukan</h4>
        <p class="font-body-sm text-body-sm text-text-secondary max-w-md mt-1 mb-4">
          Tidak ada artikel yang cocok dengan kata kunci atau filter yang Anda pilih. Silakan gunakan kata kunci lain.
        </p>
        <button class="px-5 py-2.5 bg-primary-container text-on-primary font-label-md text-label-md rounded-lg hover:bg-brand-green-hover transition-colors font-semibold cursor-pointer" id="resetSearchBtn" type="button">
          Reset Pencarian
        </button>
      </div>

      <!-- Status Indicator Row -->
      <div class="mt-space-lg pt-space-sm flex items-center justify-between border-t border-subtle-border">
        <p class="font-body-sm text-body-sm text-text-secondary" id="paginationStatus">
          Menampilkan <span class="font-semibold text-text-primary" id="visibleCountIndicator"><?= $total_display; ?></span> artikel terpublikasi
        </p>
      </div>
    </section>



  </div>

  <!-- Modal Baca Artikel Terpilih -->
  <div id="articleModal" class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-pure-white rounded-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto shadow-2xl border border-subtle-border animate-fade-in flex flex-col">
      <!-- Modal Header -->
      <div class="relative h-56 sm:h-64 w-full bg-surface-container overflow-hidden shrink-0">
        <img id="modalImg" src="" alt="Artikel Thumbnail" class="w-full h-full object-cover"/>
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
        <button onclick="closeArticleModal()" type="button" class="absolute top-4 right-4 w-9 h-9 rounded-full bg-pure-white/90 hover:bg-pure-white text-text-primary flex items-center justify-center shadow-md transition-all cursor-pointer">
          <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
        <div class="absolute bottom-4 left-6 right-6">
          <span id="modalCatBadge" class="inline-block px-3 py-1 rounded-full bg-pale-mint text-primary-container font-label-sm text-label-sm font-semibold mb-2">
            Kategori
          </span>
          <h3 id="modalTitle" class="font-headline-sm sm:font-headline-md text-pure-white font-bold leading-snug drop-shadow-sm">
            Judul Artikel
          </h3>
        </div>
      </div>

      <!-- Modal Body -->
      <div class="p-6 sm:p-8 flex flex-col gap-6">
        <div class="flex flex-wrap items-center justify-between gap-4 pb-4 border-b border-subtle-border text-text-secondary font-label-sm text-label-sm">
          <div class="flex items-center gap-3">
            <div id="modalAuthorInitials" class="w-10 h-10 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-bold text-[14px]">
              DS
            </div>
            <div>
              <div id="modalAuthor" class="font-title-sm text-title-sm text-text-primary">Penulis</div>
              <div id="modalAuthorRole" class="text-text-secondary text-[12px]">Posisi Penulis</div>
            </div>
          </div>
          <div class="flex items-center gap-4 text-text-secondary">
            <span class="flex items-center gap-1">
              <span class="material-symbols-outlined text-[16px]">calendar_today</span>
              <span id="modalDate">-</span>
            </span>
            <span class="flex items-center gap-1">
              <span class="material-symbols-outlined text-[16px]">schedule</span>
              <span id="modalReadTime">-</span>
            </span>
          </div>
        </div>

        <div id="modalContent" class="font-body-md text-body-md text-text-body leading-relaxed space-y-4">
          <!-- Text ringkasan & elaborasi dinamis -->
        </div>

        <div class="p-4 rounded-xl bg-pale-mint/80 border border-primary-container/20 flex items-start gap-3">
          <span class="material-symbols-outlined text-primary-container text-[22px] mt-0.5 shrink-0">verified</span>
          <div class="font-body-sm text-body-sm text-text-primary">
            <strong>Ingin mendiskusikan topik ini untuk infrastruktur IT perusahaan Anda?</strong>
            <p class="text-text-secondary mt-1">Konsultasikan langsung dengan tim Solution Architect PT Digital Solusi Nusantara tanpa biaya komitmen awal.</p>
          </div>
        </div>
      </div>

      <!-- Modal Footer -->
      <div class="p-4 sm:p-6 bg-surface-container-low border-t border-subtle-border rounded-b-2xl flex items-center justify-between gap-4 shrink-0">
        <button onclick="closeArticleModal()" type="button" class="px-5 py-2.5 rounded-lg border border-subtle-border bg-pure-white hover:bg-surface-bright text-text-primary font-label-md text-label-md font-medium transition-colors cursor-pointer">
          Tutup
        </button>
        <a id="modalConsultBtn" href="kontak.php" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg bg-primary-container hover:bg-brand-green-hover text-on-primary font-label-md text-label-md font-semibold shadow-sm transition-all">
          <span>Konsultasikan Topik Ini</span>
          <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
      </div>
    </div>
  </div>

  <!-- Client-side Search and Filter Script -->
  <script>
    (function() {
      const searchInput = document.getElementById('articleSearchInput');
      const categoryButtons = document.querySelectorAll('.category-pill');
      const articles = document.querySelectorAll('.article-card');
      const noResults = document.getElementById('noResultsState');
      const resetBtn = document.getElementById('resetSearchBtn');
      const countIndicator = document.getElementById('visibleCountIndicator');

      let currentCategory = 'all';
      let searchQuery = '';

      function filterArticles() {
        let visibleCount = 0;

        articles.forEach(card => {
          const titleEl = card.querySelector('h3');
          const descEl = card.querySelector('p');
          const title = titleEl ? titleEl.textContent.toLowerCase() : '';
          const desc = descEl ? descEl.textContent.toLowerCase() : '';
          const cat = card.getAttribute('data-category');

          const matchesCat = (currentCategory === 'all') || (cat === currentCategory);
          const matchesSearch = title.includes(searchQuery) || desc.includes(searchQuery);

          if (matchesCat && matchesSearch) {
            card.style.display = 'flex';
            visibleCount++;
          } else {
            card.style.display = 'none';
          }
        });

        if (countIndicator) {
          countIndicator.textContent = visibleCount;
        }

        if (visibleCount === 0) {
          noResults.classList.remove('hidden');
          noResults.classList.add('flex');
        } else {
          noResults.classList.add('hidden');
          noResults.classList.remove('flex');
        }
      }

      categoryButtons.forEach(btn => {
        btn.addEventListener('click', () => {
          categoryButtons.forEach(b => {
            b.className = 'category-pill whitespace-nowrap px-4 py-2 rounded-full font-label-md text-label-md bg-pure-white text-text-primary hover:bg-surface-container-low shadow-sm border border-subtle-border transition-all';
          });
          btn.className = 'category-pill whitespace-nowrap px-4 py-2 rounded-full font-label-md text-label-md bg-primary-container text-on-primary shadow-sm hover:bg-brand-green-hover transition-all';

          currentCategory = btn.getAttribute('data-category');
          filterArticles();
        });
      });

      if (searchInput) {
        searchInput.addEventListener('input', (e) => {
          searchQuery = e.target.value.toLowerCase().trim();
          filterArticles();
        });
      }

      if (resetBtn) {
        resetBtn.addEventListener('click', () => {
          searchInput.value = '';
          searchQuery = '';
          const allBtn = document.querySelector('.category-pill[data-category="all"]');
          if (allBtn) allBtn.click();
        });
      }
    })();

    // Modal Control Functions
    function openArticleModal(id) {
      const dataEl = document.getElementById('article-data-' + id);
      if (!dataEl) return;
      try {
        const article = JSON.parse(dataEl.textContent);
        document.getElementById('modalImg').src = article.img;
        document.getElementById('modalImg').alt = article.judul;
        document.getElementById('modalCatBadge').textContent = article.cat_label;
        document.getElementById('modalTitle').textContent = article.judul;
        document.getElementById('modalAuthor').textContent = article.author;
        document.getElementById('modalAuthorInitials').textContent = article.author_initials;
        document.getElementById('modalAuthorRole').textContent = article.author_role;
        document.getElementById('modalDate').textContent = new Date(article.tanggal).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'});
        document.getElementById('modalReadTime').textContent = article.read_time;
        
        // Elaborasi ringkasan artikel
        document.getElementById('modalContent').innerHTML = `
          <p class="font-medium text-text-primary">${article.ringkasan}</p>
          <p>Dalam implementasi enterprise modern, pendekatan arsitektural dan tata kelola teknis yang terukur memegang peranan krusial dalam memitigasi bottleneck kinerja, risiko kebocoran data, dan inefisiensi alokasi sumber daya komputasi.</p>
          <p>Melalui evaluasi menyeluruh serta adopsi metodologi standar industri (seperti OWASP, ISO 27001, dan praktik DevOps CI/CD berkelanjutan), organisasi dapat meningkatkan kapabilitas sistem secara elastis dengan tetap mempertahankan kepatuhan terhadap regulasi nasional.</p>
        `;

        document.getElementById('modalConsultBtn').href = 'kontak.php?layanan=' + encodeURIComponent(article.judul);
        document.getElementById('articleModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
      } catch (err) {
        console.error('Gagal memuat artikel modal:', err);
      }
    }

    function closeArticleModal() {
      document.getElementById('articleModal').classList.add('hidden');
      document.body.style.overflow = 'auto';
    }

    // Close on escape key
    window.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeArticleModal();
    });
  </script>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
