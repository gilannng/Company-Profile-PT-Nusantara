<?php
require_once __DIR__ . '/config/koneksi.php';

$page_title = "Dokumentasi & Galeri Kegiatan - PT Digital Solusi Nusantara";
$active_page = "galeri";

// Ambil data foto kegiatan dari tabel database
$q_galeri = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY id DESC");
$galeri_db = [];
if ($q_galeri && mysqli_num_rows($q_galeri) > 0) {
    while ($row = mysqli_fetch_assoc($q_galeri)) {
        $galeri_db[] = $row;
    }
}

// 9 Dokumentasi Terpilih (100% Foto Asli Dokumentasi Tim Engineer & Aktivitas Lapangan Indonesia)
$curated_gallery = [
    [
        'id' => 1,
        'category' => 'riset',
        'cat_label' => 'Riset & Engineering',
        'badge_month' => 'Maret 2025',
        'judul' => 'Sesi Pemrograman & Optimasi Core Microservices',
        'deskripsi' => 'Aktivitas software engineer DSN dalam merekayasa logika backend transaksi tinggi dan pengujian endpoint RESTful API.',
        'lokasi' => 'Engineering Hub DSN, Cyber 2 Tower Jakarta',
        'tanggal' => '14 Mar 2025',
        'img' => 'assets/img/galeri_coder_solo.jpg'
    ],
    [
        'id' => 2,
        'category' => 'infrastruktur',
        'cat_label' => 'Infrastruktur & Data Center',
        'badge_month' => 'Maret 2025',
        'judul' => 'Instalasi & Cabling Fiber Optic Rack Server Tier-3',
        'deskripsi' => 'Penyelesaian perakitan rack server berdensitas tinggi dengan jalur redundansi ganda untuk jaminan stabilitas data center.',
        'lokasi' => 'Data Center Cikarang, Jawa Barat',
        'tanggal' => '08 Mar 2025',
        'img' => 'assets/img/galeri_datacenter.jpg'
    ],
    [
        'id' => 3,
        'category' => 'culture',
        'cat_label' => 'Workshop & Corporate Culture',
        'badge_month' => 'Februari 2025',
        'judul' => 'Analisis Ancaman Siber & Monitoring SIEM di CSIRT Center',
        'deskripsi' => 'Spesialis keamanan siber memantau anomali lalu lintas data dan mitigasi potensi celah kerentanan secara real-time.',
        'lokasi' => 'Cyber Defense Center DSN, Jakarta',
        'tanggal' => '24 Feb 2025',
        'img' => 'assets/img/galeri_sec_analyst.jpg'
    ],
    [
        'id' => 4,
        'category' => 'riset',
        'cat_label' => 'Riset & Engineering',
        'badge_month' => 'Februari 2025',
        'judul' => 'Uji Coba & Quality Assurance Aplikasi Perbankan Digital',
        'deskripsi' => 'Pengujian performa, ketahanan beban koneksi, dan verifikasi alur user experience aplikasi mobile banking multi-platform.',
        'lokasi' => 'QA Tech Lab DSN, Jakarta',
        'tanggal' => '18 Feb 2025',
        'img' => 'assets/img/galeri_qa_testing.jpg'
    ],
    [
        'id' => 5,
        'category' => 'infrastruktur',
        'cat_label' => 'Infrastruktur & Data Center',
        'badge_month' => 'Februari 2025',
        'judul' => 'Pemantauan 24/7 Network Operations Center (NOC)',
        'deskripsi' => 'Ruang kendali pemantauan konektivitas backbone nasional dan performa server klien dengan SLA operasional 99.98%.',
        'lokasi' => 'Cyber 2 Tower Lt. 18, Jakarta',
        'tanggal' => '12 Feb 2025',
        'img' => 'assets/img/galeri_noc.jpg'
    ],
    [
        'id' => 6,
        'category' => 'implementasi',
        'cat_label' => 'Implementasi Klien',
        'badge_month' => 'Januari 2025',
        'judul' => 'Perancangan Arsitektur Enterprise Bersama Mitra Strategis',
        'deskripsi' => 'Sesi kolaborasi arsitek sistem merumuskan diagram alur integrasi API dan tata kelola basis data terdistribusi.',
        'lokasi' => 'Executive Meeting Room DSN, Jakarta',
        'tanggal' => '28 Jan 2025',
        'img' => 'assets/img/galeri_meeting.jpg'
    ],
    [
        'id' => 7,
        'category' => 'infrastruktur',
        'cat_label' => 'Infrastruktur & Data Center',
        'badge_month' => 'Januari 2025',
        'judul' => 'Audit Keamanan Fisik & Logika Infrastruktur Server',
        'deskripsi' => 'Inspeksi komprehensif kepatuhan standar keamanan informasi ISO 27001 pada lingkungan komputasi server klien.',
        'lokasi' => 'Data Center Cikarang, Jawa Barat',
        'tanggal' => '20 Jan 2025',
        'img' => 'assets/img/galeri_audit.jpg'
    ],
    [
        'id' => 8,
        'category' => 'implementasi',
        'cat_label' => 'Implementasi Klien',
        'badge_month' => 'Januari 2025',
        'judul' => 'Penandatanganan Kerjasama Solusi Digital Korporat',
        'deskripsi' => 'Kesepakatan strategis kemitraan teknologi dan penyediaan layanan managed services bagi institusi perbankan nasional.',
        'lokasi' => 'Executive Boardroom, Jakarta',
        'tanggal' => '14 Jan 2025',
        'img' => 'assets/img/galeri_mou.jpg'
    ],
    [
        'id' => 9,
        'category' => 'culture',
        'cat_label' => 'Workshop & Corporate Culture',
        'badge_month' => 'Januari 2025',
        'judul' => 'Kebersamaan Seluruh Tim Engineer & Manajemen PT DSN',
        'deskripsi' => 'Momen keakraban tahunan talenta IT, konsultan, dan manajemen DSN setelah penutupan agenda rilis inisiatif 2025.',
        'lokasi' => 'Headquarters DSN, Jakarta',
        'tanggal' => '09 Jan 2025',
        'img' => 'assets/img/galeri_tim_dsn.jpg'
    ]
];

// Helper penentu kategori galeri database
function detect_gallery_cat($judul) {
    $j = strtolower($judul);
    if (strpos($j, 'data center') !== false || strpos($j, 'server') !== false || strpos($j, 'noc') !== false || strpos($j, 'cabling') !== false || strpos($j, 'fiber') !== false) {
        return ['infrastruktur', 'Infrastruktur & Data Center'];
    } elseif (strpos($j, 'klien') !== false || strpos($j, 'mou') !== false || strpos($j, 'perbankan') !== false || strpos($j, 'erp') !== false) {
        return ['implementasi', 'Implementasi Klien'];
    } elseif (strpos($j, 'workshop') !== false || strpos($j, 'pelatihan') !== false || strpos($j, 'townhall') !== false || strpos($j, 'soc') !== false) {
        return ['culture', 'Workshop & Corporate Culture'];
    } else {
        return ['riset', 'Riset & Engineering'];
    }
}

// Susun list galeri (utamakan data database resmi dengan foto unik)
$display_gallery = [];
$used_images = [];

foreach ($galeri_db as $g) {
    list($cat, $cat_label) = detect_gallery_cat($g['judul']);
    
    // Cek apakah ada file lokal di uploads dan bukan SVG
    $img_path = 'assets/img/uploads/' . $g['foto'];
    if (empty($g['foto']) || strpos($g['foto'], '.svg') !== false || !file_exists(__DIR__ . '/' . $img_path)) {
        // Cari gambar cadangan yang belum pernah dipakai
        foreach ($curated_gallery as $cg) {
            $base = basename($cg['img']);
            if (!in_array($base, $used_images)) {
                $img_path = $cg['img'];
                break;
            }
        }
    }
    
    $used_images[] = basename($img_path);
    
    $display_gallery[] = [
        'id' => (int)$g['id'],
        'category' => $cat,
        'cat_label' => $cat_label,
        'badge_month' => '2025',
        'judul' => $g['judul'],
        'deskripsi' => 'Dokumentasi resmi aktivitas teknis dan implementasi solusi teknologi PT Digital Solusi Nusantara bersama mitra strategis.',
        'lokasi' => 'Cyber 2 Tower, Jakarta',
        'tanggal' => 'Aktual 2025',
        'img' => $img_path
    ];
}

// Jika database belum memiliki data, tampilkan curated gallery
if (empty($display_gallery)) {
    $display_gallery = $curated_gallery;
}

$total_gallery = count($display_gallery);

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<main class="w-full pt-20 bg-surface">
  <div class="flex flex-col w-full">

    <!-- Breadcrumb & Header Section -->
    <section class="w-full bg-surface-bright border-b border-subtle-border py-space-xl">
      <div class="max-w-7xl mx-auto px-margin">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 mb-space-sm text-text-secondary">
          <a class="flex items-center gap-1 font-body-sm text-body-sm hover:text-primary-container transition-colors" data-path="home" href="index.php">
            <span class="material-symbols-outlined text-[18px]">home</span>
            <span>Home</span>
          </a>
          <span class="material-symbols-outlined text-[16px] text-border-secondary">chevron_right</span>
          <span class="font-body-sm text-body-sm text-text-primary font-medium">Galeri Kegiatan</span>
        </nav>

        <!-- Main Title Block & Badge Counter -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md">
          <div class="max-w-3xl">
            <h1 class="font-headline-lg text-headline-lg text-text-primary tracking-tight mb-space-xs">
              Dokumentasi &amp; Galeri Kegiatan
            </h1>
            <p class="font-body-md text-body-md text-text-body leading-relaxed">
              Potret rekam jejak, kolaborasi tim engineer, implementasi infrastruktur, dan dedikasi PT Digital Solusi Nusantara dalam melayani klien di seluruh Indonesia.
            </p>
          </div>
          <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-pale-mint self-start md:self-auto shrink-0 border border-primary-container/20">
            <span class="w-2 h-2 rounded-full bg-primary-container"></span>
            <span class="font-label-sm text-label-sm text-primary-container font-semibold">Menampilkan <?= $total_gallery; ?> Dokumentasi Terpilih</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Main Content Container -->
    <section class="w-full py-space-xl bg-surface">
      <div class="max-w-7xl mx-auto px-margin">

        <!-- Category Filter Tabs -->
        <div class="flex items-center gap-2 overflow-x-auto pb-space-sm mb-space-xl scrollbar-none" id="galleryFilterTabs">
          <button class="filter-tab-btn whitespace-nowrap px-4 py-2 rounded-lg font-label-md text-label-md transition duration-150 bg-primary-container text-pure-white shadow-sm font-semibold cursor-pointer" data-filter="all" type="button">
            Semua Kegiatan
          </button>
          <button class="filter-tab-btn whitespace-nowrap px-4 py-2 rounded-lg font-label-md text-label-md transition duration-150 bg-pure-white text-text-primary border border-subtle-border hover:bg-surface-bright font-medium cursor-pointer" data-filter="implementasi" type="button">
            Implementasi Klien
          </button>
          <button class="filter-tab-btn whitespace-nowrap px-4 py-2 rounded-lg font-label-md text-label-md transition duration-150 bg-pure-white text-text-primary border border-subtle-border hover:bg-surface-bright font-medium cursor-pointer" data-filter="infrastruktur" type="button">
            Infrastruktur &amp; Data Center
          </button>
          <button class="filter-tab-btn whitespace-nowrap px-4 py-2 rounded-lg font-label-md text-label-md transition duration-150 bg-pure-white text-text-primary border border-subtle-border hover:bg-surface-bright font-medium cursor-pointer" data-filter="riset" type="button">
            Riset &amp; Engineering
          </button>
          <button class="filter-tab-btn whitespace-nowrap px-4 py-2 rounded-lg font-label-md text-label-md transition duration-150 bg-pure-white text-text-primary border border-subtle-border hover:bg-surface-bright font-medium cursor-pointer" data-filter="culture" type="button">
            Workshop &amp; Corporate Culture
          </button>
        </div>

        <!-- Gallery Grid 3x3 -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-space-lg mb-space-xl" id="galleryItemsContainer">
          <?php 
          $g_idx = 0;
          foreach ($display_gallery as $item): 
          ?>
          <article class="gallery-card group bg-pure-white border border-subtle-border rounded-xl overflow-hidden shadow-sm hover:-translate-y-1.5 hover:shadow-md transition-all duration-300 flex flex-col justify-between cursor-pointer card-hover-lift" 
                   data-category="<?= htmlspecialchars($item['category']); ?>" 
                   data-aos="fade-up" 
                   data-aos-delay="<?= ($g_idx % 3) * 120; ?>"
                   onclick="openLightbox(<?= htmlspecialchars(json_encode($item, JSON_HEX_APOS | JSON_HEX_QUOT)); ?>)">
            <div>
              <div class="relative aspect-[16/10] overflow-hidden bg-surface-container">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="<?= htmlspecialchars($item['img']); ?>" alt="<?= htmlspecialchars($item['judul']); ?>"/>
                <span class="absolute top-3 right-3 bg-pure-white/90 backdrop-blur-sm text-text-primary text-[12px] font-label-sm px-2.5 py-1 rounded-md shadow-xs border border-subtle-border font-medium">
                  <?= htmlspecialchars($item['badge_month']); ?>
                </span>
              </div>
              <div class="p-space-lg flex flex-col gap-space-xs">
                <div class="flex items-center gap-2 mb-1">
                  <span class="inline-block px-2.5 py-0.5 rounded-full bg-pale-mint text-primary-container font-label-sm text-label-sm font-semibold">
                    <?= htmlspecialchars($item['cat_label']); ?>
                  </span>
                </div>
                <h3 class="font-headline-sm text-headline-sm text-text-primary group-hover:text-primary-container transition-colors line-clamp-2 leading-snug">
                  <?= htmlspecialchars($item['judul']); ?>
                </h3>
                <p class="font-body-sm text-body-sm text-text-body line-clamp-2 mt-1 leading-relaxed">
                  <?= htmlspecialchars($item['deskripsi']); ?>
                </p>
              </div>
            </div>
            <div class="px-space-lg py-3 border-t border-subtle-border bg-surface-bright flex items-center justify-between text-text-secondary font-label-sm text-label-sm">
              <span class="flex items-center gap-1 truncate max-w-[60%]">
                <span class="material-symbols-outlined text-[16px] text-text-secondary shrink-0">location_on</span>
                <span class="truncate"><?= htmlspecialchars($item['lokasi']); ?></span>
              </span>
              <span class="flex items-center gap-1 shrink-0">
                <span class="material-symbols-outlined text-[16px] text-text-secondary">calendar_today</span>
                <span><?= htmlspecialchars($item['tanggal']); ?></span>
              </span>
            </div>
          </article>
          <?php 
          $g_idx++;
          endforeach; 
          ?>
        </div>



        <!-- Call-To-Action Banner -->
        <aside class="w-full bg-pure-white border border-subtle-border rounded-xl p-space-lg md:p-space-xl shadow-sm relative overflow-hidden">
          <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-primary-container"></div>
          <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-space-lg pl-2">
            <div class="max-w-2xl">
              <div class="inline-flex items-center gap-1.5 text-primary-container font-label-sm text-label-sm font-semibold uppercase tracking-wider mb-2">
                <span class="material-symbols-outlined text-[16px]">corporate_fare</span>
                <span>Kunjungan Industri &amp; Hubungan Masyarakat</span>
              </div>
              <h2 class="font-headline-md text-headline-md text-text-primary tracking-tight mb-2 font-bold">
                Tertarik Menjalin Kolaborasi atau Mengunjungi Kantor Kami?
              </h2>
              <p class="font-body-md text-body-md text-text-body">
                Hubungi tim komunikasi korporat kami untuk permohonan kunjungan industri, kerja sama riset, atau liputan media teknologi.
              </p>
            </div>
            <div class="shrink-0 flex items-center">
              <a class="inline-flex items-center justify-center gap-2 bg-primary-container hover:bg-brand-green-hover text-pure-white font-label-md text-label-md font-semibold px-6 py-3 rounded-lg transition-colors shadow-sm" data-path="kontak" href="kontak.php">
                <span>Hubungi Public Relations</span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
              </a>
            </div>
          </div>
        </aside>

      </div>
    </section>

  </div>

  <!-- Lightbox Preview Modal -->
  <div id="galleryModal" class="fixed inset-0 z-50 hidden bg-black/75 backdrop-blur-md flex items-center justify-center p-4">
    <div class="bg-pure-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden shadow-2xl border border-subtle-border flex flex-col animate-fade-in">
      <div class="relative w-full bg-black/90 flex items-center justify-center max-h-[55vh] overflow-hidden">
        <img id="lightboxImg" src="" alt="Preview Foto Galeri" class="max-h-[55vh] w-auto max-w-full object-contain"/>
        <button onclick="closeLightbox()" type="button" class="absolute top-4 right-4 w-9 h-9 rounded-full bg-pure-white/90 hover:bg-pure-white text-text-primary flex items-center justify-center shadow-lg transition-all cursor-pointer">
          <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
      </div>
      <div class="p-6 sm:p-8 flex flex-col gap-4 overflow-y-auto">
        <div class="flex items-center justify-between gap-4">
          <span id="lightboxBadge" class="inline-block px-3 py-1 rounded-full bg-pale-mint text-primary-container font-label-sm text-label-sm font-semibold">
            Kategori
          </span>
          <div class="flex items-center gap-4 text-text-secondary font-label-sm text-label-sm">
            <span class="flex items-center gap-1">
              <span class="material-symbols-outlined text-[16px]">location_on</span>
              <span id="lightboxLocation">Lokasi</span>
            </span>
            <span class="flex items-center gap-1">
              <span class="material-symbols-outlined text-[16px]">calendar_today</span>
              <span id="lightboxDate">Tanggal</span>
            </span>
          </div>
        </div>
        <h3 id="lightboxTitle" class="font-headline-sm text-headline-sm text-text-primary font-bold leading-snug">
          Judul Dokumentasi
        </h3>
        <p id="lightboxDesc" class="font-body-md text-body-md text-text-body leading-relaxed">
          Deskripsi dokumentasi
        </p>
      </div>
      <div class="px-6 py-4 bg-surface-bright border-t border-subtle-border flex items-center justify-between">
        <span class="font-label-sm text-label-sm text-text-secondary flex items-center gap-1">
          <span class="material-symbols-outlined text-[16px] text-primary-container">verified</span>
          <span>Dokumentasi Resmi PT Digital Solusi Nusantara</span>
        </span>
        <button onclick="closeLightbox()" type="button" class="px-4 py-2 bg-surface-container-high hover:bg-surface-container text-text-primary rounded-lg font-label-md text-label-md font-medium transition-colors cursor-pointer">
          Tutup
        </button>
      </div>
    </div>
  </div>

  <!-- Interactive filter logic -->
  <script>
    (function() {
      const filterButtons = document.querySelectorAll('.filter-tab-btn');
      const cards = document.querySelectorAll('.gallery-card');

      filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
          const filter = btn.getAttribute('data-filter');

          filterButtons.forEach(b => {
            b.classList.remove('bg-primary-container', 'text-pure-white', 'shadow-sm', 'font-semibold');
            b.classList.add('bg-pure-white', 'text-text-primary', 'border', 'border-subtle-border', 'font-medium');
          });
          btn.classList.remove('bg-pure-white', 'text-text-primary', 'border', 'border-subtle-border', 'font-medium');
          btn.classList.add('bg-primary-container', 'text-pure-white', 'shadow-sm', 'font-semibold');

          cards.forEach(card => {
            const category = card.getAttribute('data-category');
            if (filter === 'all' || category === filter) {
              card.style.display = 'flex';
            } else {
              card.style.display = 'none';
            }
          });
        });
      });
    })();

    // Lightbox Modal Logic
    function openLightbox(item) {
      document.getElementById('lightboxImg').src = item.img;
      document.getElementById('lightboxImg').alt = item.judul;
      document.getElementById('lightboxBadge').textContent = item.cat_label;
      document.getElementById('lightboxTitle').textContent = item.judul;
      document.getElementById('lightboxDesc').textContent = item.deskripsi;
      document.getElementById('lightboxLocation').textContent = item.lokasi;
      document.getElementById('lightboxDate').textContent = item.tanggal;
      document.getElementById('galleryModal').classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
      document.getElementById('galleryModal').classList.add('hidden');
      document.body.style.overflow = 'auto';
    }

    window.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeLightbox();
    });
  </script>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
