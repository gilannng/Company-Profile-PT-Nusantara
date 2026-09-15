<?php
require_once __DIR__ . '/config/koneksi.php';

$page_title = "Hubungi Tim Ahli Kami - PT Digital Solusi Nusantara";
$active_page = "kontak";

// Ambil info profil perusahaan dari basis data MySQL
$q_profil = mysqli_query($koneksi, "SELECT * FROM profil LIMIT 1");
$profil = ($q_profil && mysqli_num_rows($q_profil) > 0) ? mysqli_fetch_assoc($q_profil) : null;

// Tangani Pengiriman Form Pesan (Simulasi Pengiriman Valid & Sanitasi Input)
$success_alert = false;
$submitted_name = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_kirim'])) {
    $nama = clean_input($_POST['nama'] ?? '');
    $email = clean_input($_POST['email'] ?? '');
    $telepon = clean_input($_POST['telepon'] ?? '');
    $perusahaan = clean_input($_POST['perusahaan'] ?? '');
    $layanan = clean_input($_POST['layanan'] ?? '');
    $subjek = clean_input($_POST['subjek'] ?? '');
    $pesan = clean_input($_POST['pesan'] ?? '');

    if (!empty($nama) && !empty($email) && !empty($pesan)) {
        $success_alert = true;
        $submitted_name = $nama;
    }
}

// Prefill subjek / layanan jika diarahkan dari tombol layanan / artikel
$prefill_layanan = isset($_GET['layanan']) ? clean_input($_GET['layanan']) : '';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<main class="w-full pt-20 bg-background flex-1">
  <div class="flex flex-col w-full">

    <!-- Top Headline Banner -->
    <div class="w-full relative overflow-hidden bg-surface-container-low/60 pb-12 pt-8 border-b border-subtle-border">
      <div class="max-w-7xl mx-auto px-margin relative z-10">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 font-label-sm text-label-sm text-text-secondary mb-6">
          <a class="hover:text-primary-container transition-colors flex items-center gap-1.5" data-path="home" href="index.php">
            <span class="material-symbols-outlined text-[16px]">home</span>
            <span>Beranda</span>
          </a>
          <span class="text-secondary/40">/</span>
          <span class="text-text-primary font-semibold">Kontak Kami</span>
        </nav>

        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6">
          <div class="max-w-3xl space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-pale-mint text-primary font-label-md text-label-md border border-primary-container/20">
              <span class="w-2 h-2 rounded-full bg-primary-container animate-pulse"></span>
              <span>Respon Cepat &lt; 24 Jam Kerja • Konsultasi Enterprise</span>
            </div>
            <h1 class="font-display text-display text-text-primary tracking-tight">Hubungi Tim Ahli Kami</h1>
            <p class="font-body-lg text-body-lg text-text-body">
              Konsultasikan akselerasi arsitektur cloud, modernisasi infrastruktur TI, rekayasa perangkat lunak enterprise, dan kepatuhan keamanan siber perusahaan Anda bersama konsultan teknis berdedikasi.
            </p>
          </div>
          <div class="flex items-center gap-3 shrink-0">
            <div class="p-3.5 rounded-xl bg-surface-container-lowest shadow-sm border border-subtle-border flex items-center gap-3">
              <div class="w-10 h-10 rounded-lg bg-pale-mint flex items-center justify-center text-primary-container shrink-0">
                <span class="material-symbols-outlined text-[22px]">verified_user</span>
              </div>
              <div>
                <div class="font-title-sm text-title-sm text-text-primary font-bold">ISO 27001 Certified</div>
                <div class="font-label-sm text-label-sm text-text-secondary">Keamanan Data Terstandarisasi</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Grid Section (Contact Info & Official Form) -->
    <section class="max-w-7xl mx-auto px-margin py-12 w-full">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        <!-- Left Column: Pusat Operasional & Peta -->
        <div class="lg:col-span-5 flex flex-col gap-6" data-aos="fade-right" data-aos-duration="700">
          <div class="bg-surface-container-lowest rounded-xl p-6 sm:p-8 shadow-sm border border-subtle-border">
            <div class="space-y-2 mb-6">
              <span class="font-label-sm text-label-sm uppercase tracking-wider text-primary font-bold">Pusat Operasional</span>
              <h2 class="font-headline-sm text-headline-sm text-text-primary tracking-tight font-bold">Kantor Pusat Jakarta</h2>
              <p class="font-body-sm text-body-sm text-text-secondary">
                Kunjungi pusat inovasi kami atau jadwalkan pertemuan teknis langsung bersama arsitek solusi kami di kawasan Segitiga Emas Kuningan.
              </p>
            </div>

            <div class="space-y-5">
              <!-- Alamat -->
              <div class="flex items-start gap-4">
                <div class="w-11 h-11 rounded-full bg-pale-mint flex items-center justify-center shrink-0 text-primary-container shadow-xs">
                  <span class="material-symbols-outlined text-[20px]">location_on</span>
                </div>
                <div class="space-y-0.5">
                  <h3 class="font-title-sm text-title-sm text-text-primary font-bold">Alamat Perusahaan</h3>
                  <p class="font-body-sm text-body-sm text-text-body leading-relaxed">
                    <?= $profil ? nl2br(htmlspecialchars($profil['alamat'])) : 'Cyber 2 Tower Lantai 18<br>Jl. H. R. Rasuna Said Blok X-5 Kav. 13<br>Kuningan Barat, Jakarta Selatan 12950'; ?>
                  </p>
                </div>
              </div>

              <!-- Telepon -->
              <div class="flex items-start gap-4">
                <div class="w-11 h-11 rounded-full bg-pale-mint flex items-center justify-center shrink-0 text-primary-container shadow-xs">
                  <span class="material-symbols-outlined text-[20px]">call</span>
                </div>
                <div class="space-y-1">
                  <h3 class="font-title-sm text-title-sm text-text-primary font-bold">Telepon &amp; Hotline</h3>
                  <p class="font-body-sm text-body-sm text-text-body">
                    Pusat: <a class="hover:text-primary-container transition-colors font-medium text-text-primary" href="tel:+622152891000"><?= $profil ? htmlspecialchars($profil['telepon']) : '+62 (21) 5289-8888'; ?></a><br/>
                    WhatsApp Enterprise: <a class="hover:text-primary-container transition-colors font-medium text-primary-container" href="https://wa.me/6281192008800" rel="noopener noreferrer" target="_blank">+62 811-9200-8800</a>
                  </p>
                </div>
              </div>

              <!-- Email -->
              <div class="flex items-start gap-4">
                <div class="w-11 h-11 rounded-full bg-pale-mint flex items-center justify-center shrink-0 text-primary-container shadow-xs">
                  <span class="material-symbols-outlined text-[20px]">mail</span>
                </div>
                <div class="space-y-1">
                  <h3 class="font-title-sm text-title-sm text-text-primary font-bold">Korespondensi Elektronik</h3>
                  <p class="font-body-sm text-body-sm text-text-body">
                    Penawaran &amp; Kemitraan: <a class="text-text-primary font-medium hover:text-primary-container transition-colors" href="mailto:<?= $profil ? htmlspecialchars($profil['email']) : 'info@digitalsolusi.co.id'; ?>"><?= $profil ? htmlspecialchars($profil['email']) : 'info@digitalsolusi.co.id'; ?></a><br/>
                    Dukungan Teknis: <a class="text-text-primary font-medium hover:text-primary-container transition-colors" href="mailto:support@digitalsolusi.co.id">support@digitalsolusi.co.id</a>
                  </p>
                </div>
              </div>

              <!-- Jam Operasional -->
              <div class="flex items-start gap-4">
                <div class="w-11 h-11 rounded-full bg-pale-mint flex items-center justify-center shrink-0 text-primary-container shadow-xs">
                  <span class="material-symbols-outlined text-[20px]">schedule</span>
                </div>
                <div class="space-y-0.5">
                  <h3 class="font-title-sm text-title-sm text-text-primary font-bold">Jam Operasional</h3>
                  <p class="font-body-sm text-body-sm text-text-body leading-relaxed">
                    Senin - Jumat: 08:30 - 17:30 WIB<br/>
                    <span class="inline-flex items-center gap-1.5 text-tertiary font-medium">
                      <span class="w-1.5 h-1.5 rounded-full bg-tertiary-container"></span>
                      NOC &amp; SOC Standby 24/7 untuk Layanan Enterprise
                    </span>
                  </p>
                </div>
              </div>
            </div>

            <!-- Peta Lokasi Interaktif -->
            <div class="mt-8 pt-6 border-t border-surface-container">
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-2">
                  <span class="material-symbols-outlined text-primary-container text-[20px]">map</span>
                  <span class="font-title-sm text-title-sm text-text-primary font-bold">Peta Lokasi Interaktif</span>
                </div>
                <a class="font-label-sm text-label-sm text-primary-container hover:text-brand-green-hover font-semibold flex items-center gap-1" href="https://maps.google.com/?q=Cyber+2+Tower+Jakarta" rel="noopener noreferrer" target="_blank">
                  <span>Buka di Google Maps</span>
                  <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                </a>
              </div>
              <div class="relative w-full h-56 rounded-xl overflow-hidden shadow-xs border border-subtle-border group">
                <iframe 
                  title="Google Maps Lokasi PT Digital Solusi Nusantara"
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2736181636254!2d106.82963177499035!3d-6.227607793760492!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3ef4d89a777%3A0x6a1a1f0a1f0a1f0!2sJl.%20H.%20R.%20Rasuna%20Said%2C%20Kuningan%2C%20Jakarta%20Selatan!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                  width="100%" 
                  height="100%" 
                  style="border:0;" 
                  allowfullscreen="" 
                  loading="lazy" 
                  referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <div class="absolute bottom-3 left-3 right-3 bg-surface-container-lowest/95 backdrop-blur-md p-2.5 rounded-lg shadow-md flex items-center justify-between pointer-events-none border border-subtle-border">
                  <div class="flex items-center gap-2 min-w-0">
                    <div class="w-7 h-7 rounded-full bg-primary-container text-pure-white flex items-center justify-center shrink-0">
                      <span class="material-symbols-outlined text-[16px]">apartment</span>
                    </div>
                    <div class="min-w-0">
                      <div class="font-title-sm text-[13px] text-text-primary truncate font-bold">Cyber 2 Tower, Lt. 18</div>
                      <div class="font-label-sm text-[11px] text-text-secondary truncate">Jl. H.R. Rasuna Said, Jakarta Selatan</div>
                    </div>
                  </div>
                  <span class="px-2 py-0.5 rounded bg-pale-mint text-primary font-label-sm text-[11px] shrink-0 font-medium">Headquarters</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Banner WhatsApp Cepat -->
          <div class="bg-pale-mint rounded-xl p-6 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm border border-primary-container/20">
            <div class="flex items-center gap-4">
              <div class="w-12 h-12 rounded-xl bg-pure-white flex items-center justify-center text-primary-container shadow-xs shrink-0 border border-primary-container/10">
                <span class="material-symbols-outlined text-[28px]">chat</span>
              </div>
              <div>
                <h4 class="font-title-sm text-title-sm text-text-primary font-bold">Butuh Respons Segera?</h4>
                <p class="font-body-sm text-body-sm text-text-body">Hubungkan langsung percakapan dengan Helpdesk WhatsApp kami.</p>
              </div>
            </div>
            <a class="shrink-0 inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-primary-container hover:bg-brand-green-hover text-pure-white font-label-md text-label-md transition-colors shadow-sm font-semibold" href="https://wa.me/6281192008800" rel="noopener noreferrer" target="_blank">
              <span>Chat WhatsApp</span>
              <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
          </div>
        </div>

        <!-- Right Column: Formulir Resmi -->
        <div class="lg:col-span-7" data-aos="fade-left" data-aos-duration="700">
          <div class="bg-surface-container-lowest rounded-xl p-6 sm:p-10 shadow-sm border border-subtle-border relative overflow-hidden">
            <div class="mb-8">
              <span class="font-label-sm text-label-sm uppercase tracking-wider text-primary font-bold">Formulir Resmi</span>
              <h2 class="font-headline-md text-headline-md text-text-primary tracking-tight mt-1 font-bold">Kirimkan Pesan atau Permintaan Proposal</h2>
              <p class="font-body-md text-body-md text-text-secondary mt-2">
                Isi formulir spesifikasi di bawah ini dan arsitek solusi kami akan menganalisis kebutuhan Anda serta mengirimkan respon awal dalam 1x24 jam kerja.
              </p>
            </div>

            <?php if ($success_alert): ?>
            <!-- Success Alert Banner -->
            <div class="mb-6 p-5 rounded-xl bg-pale-mint border border-primary-container/30 flex items-start justify-between gap-4 animate-fade-in shadow-xs" id="successNotification">
              <div class="flex items-start gap-3">
                <span class="material-symbols-outlined text-primary-container text-[26px] mt-0.5">check_circle</span>
                <div>
                  <h4 class="font-title-sm text-title-sm text-text-primary font-bold">Pesan Anda Berhasil Terkirim!</h4>
                  <p class="font-body-sm text-body-sm text-text-body mt-1">
                    Terima kasih <strong><?= htmlspecialchars($submitted_name); ?></strong>. Solution Architect kami telah menerima spesifikasi proyek Anda dan akan menghubungi Anda dalam kurun waktu 1x24 jam kerja.
                  </p>
                </div>
              </div>
              <button class="text-text-secondary hover:text-text-primary cursor-pointer" onclick="document.getElementById('successNotification').style.display='none'" type="button">
                <span class="material-symbols-outlined text-[18px]">close</span>
              </button>
            </div>
            <?php endif; ?>

            <form action="kontak.php" method="POST" class="space-y-6" id="contact-form">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-2">
                  <label class="block font-label-md text-label-md text-text-primary font-medium" for="full-name">
                    Nama Lengkap <span class="text-error">*</span>
                  </label>
                  <div class="relative">
                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-secondary text-[20px]">person</span>
                    <input name="nama" class="w-full bg-pure-white text-text-primary font-body-md text-body-md pl-11 pr-4 py-2.5 rounded-lg border border-border-secondary focus:outline-none focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all shadow-xs" id="full-name" placeholder="cth. Budi Santoso, S.Kom" required type="text"/>
                  </div>
                </div>
                <div class="space-y-2">
                  <label class="block font-label-md text-label-md text-text-primary font-medium" for="work-email">
                    Email Perusahaan <span class="text-error">*</span>
                  </label>
                  <div class="relative">
                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-secondary text-[20px]">mail</span>
                    <input name="email" class="w-full bg-pure-white text-text-primary font-body-md text-body-md pl-11 pr-4 py-2.5 rounded-lg border border-border-secondary focus:outline-none focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all shadow-xs" id="work-email" placeholder="cth. budi@perusahaan.co.id" required type="email"/>
                  </div>
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-2">
                  <label class="block font-label-md text-label-md text-text-primary font-medium" for="phone-number">
                    Nomor Telepon / WhatsApp <span class="text-error">*</span>
                  </label>
                  <div class="relative">
                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-secondary text-[20px]">call</span>
                    <input name="telepon" class="w-full bg-pure-white text-text-primary font-body-md text-body-md pl-11 pr-4 py-2.5 rounded-lg border border-border-secondary focus:outline-none focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all shadow-xs" id="phone-number" placeholder="cth. 0812-3456-7890" required type="tel"/>
                  </div>
                </div>
                <div class="space-y-2">
                  <label class="block font-label-md text-label-md text-text-primary font-medium" for="company-name">
                    Nama Perusahaan / Instansi <span class="text-error">*</span>
                  </label>
                  <div class="relative">
                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-secondary text-[20px]">domain</span>
                    <input name="perusahaan" class="w-full bg-pure-white text-text-primary font-body-md text-body-md pl-11 pr-4 py-2.5 rounded-lg border border-border-secondary focus:outline-none focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all shadow-xs" id="company-name" placeholder="cth. PT Maju Bersama Nusantara" required type="text"/>
                  </div>
                </div>
              </div>

              <div class="space-y-2">
                <label class="block font-label-md text-label-md text-text-primary font-medium" for="service-category">
                  Layanan yang Diminati <span class="text-error">*</span>
                </label>
                <div class="relative">
                  <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-secondary text-[20px]">widgets</span>
                  <select name="layanan" class="w-full bg-pure-white text-text-primary font-body-md text-body-md pl-11 pr-10 py-2.5 rounded-lg border border-border-secondary focus:outline-none focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all appearance-none cursor-pointer shadow-xs" id="service-category" required>
                    <option disabled value="" <?= empty($prefill_layanan) ? 'selected' : ''; ?>>Pilih Kategori Layanan...</option>
                    <option value="software" <?= (stripos($prefill_layanan, 'software') !== false || stripos($prefill_layanan, 'web') !== false) ? 'selected' : ''; ?>>Pengembangan Web &amp; Software Kustom</option>
                    <option value="infrastructure" <?= (stripos($prefill_layanan, 'jaringan') !== false || stripos($prefill_layanan, 'infrastruktur') !== false) ? 'selected' : ''; ?>>Jaringan Komputer &amp; Infrastruktur IT</option>
                    <option value="cybersecurity" <?= (stripos($prefill_layanan, 'keamanan') !== false || stripos($prefill_layanan, 'security') !== false || stripos($prefill_layanan, 'vapt') !== false) ? 'selected' : ''; ?>>Konsultasi &amp; Audit Keamanan IT (VAPT &amp; ISO 27001)</option>
                    <option value="cloud" <?= (stripos($prefill_layanan, 'cloud') !== false || stripos($prefill_layanan, 'devops') !== false) ? 'selected' : ''; ?>>Cloud Architecture, Migration &amp; DevOps</option>
                    <option value="data-ai" <?= (stripos($prefill_layanan, 'data') !== false || stripos($prefill_layanan, 'ai') !== false) ? 'selected' : ''; ?>>Big Data Analytics &amp; AI Integration</option>
                    <option value="other" <?= (!empty($prefill_layanan) && stripos($prefill_layanan, 'software') === false && stripos($prefill_layanan, 'jaringan') === false && stripos($prefill_layanan, 'keamanan') === false && stripos($prefill_layanan, 'cloud') === false && stripos($prefill_layanan, 'data') === false) ? 'selected' : ''; ?>>Lainnya / Diskusi Solusi Terpadu</option>
                  </select>
                  <span class="material-symbols-outlined absolute right-3.5 top-1/2 -translate-y-1/2 text-secondary pointer-events-none text-[20px]">expand_more</span>
                </div>
              </div>

              <div class="space-y-2">
                <label class="block font-label-md text-label-md text-text-primary font-medium" for="message-subject">
                  Subjek Pesan <span class="text-error">*</span>
                </label>
                <div class="relative">
                  <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-secondary text-[20px]">topic</span>
                  <input name="subjek" class="w-full bg-pure-white text-text-primary font-body-md text-body-md pl-11 pr-4 py-2.5 rounded-lg border border-border-secondary focus:outline-none focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all shadow-xs" id="message-subject" placeholder="cth. Diskusi Implementasi ERP Terintegrasi &amp; Migrasi Cloud" value="<?= !empty($prefill_layanan) ? 'Permintaan Konsultasi: ' . htmlspecialchars($prefill_layanan) : ''; ?>" required type="text"/>
                </div>
              </div>

              <div class="space-y-2">
                <label class="block font-label-md text-label-md text-text-primary font-medium" for="project-notes">
                  Pesan / Rincian Kebutuhan Proyek <span class="text-error">*</span>
                </label>
                <textarea name="pesan" class="w-full bg-pure-white text-text-primary font-body-md text-body-md p-3.5 rounded-lg border border-border-secondary focus:outline-none focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all resize-y shadow-xs" id="project-notes" placeholder="Jelaskan secara ringkas tantangan sistem saat ini, estimasi jangka waktu implementasi, spesifikasi integrasi, atau anggaran yang dialokasikan..." required rows="4"></textarea>
              </div>

              <div class="p-4 rounded-lg bg-surface-container-low flex items-start gap-3 border border-subtle-border">
                <span class="material-symbols-outlined text-primary-container text-[20px] mt-0.5 shrink-0">shield</span>
                <p class="font-body-sm text-body-sm text-text-body leading-normal">
                  Data dan informasi rahasia perusahaan Anda terlindungi secara ketat sesuai dengan Kebijakan Privasi serta standar NDA (Non-Disclosure Agreement) PT Digital Solusi Nusantara.
                </p>
              </div>

              <button name="btn_kirim" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-3.5 rounded-lg bg-primary-container hover:bg-brand-green-hover text-pure-white font-title-sm text-title-sm font-semibold transition-all shadow-md hover:shadow-lg active:scale-[0.99] cursor-pointer" type="submit">
                <span>Kirim Pesan Sekarang</span>
                <span class="material-symbols-outlined text-[20px]">send</span>
              </button>
            </form>
          </div>
        </div>

      </div>
    </section>

    <!-- Bottom 3 Pillars of Trust Section -->
    <section class="max-w-7xl mx-auto px-margin pb-16 pt-4 w-full">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-6 rounded-xl bg-surface-container-lowest shadow-sm border border-subtle-border flex flex-col justify-between space-y-4">
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-pale-mint flex items-center justify-center text-primary-container shrink-0">
              <span class="material-symbols-outlined text-[24px]">lock_reset</span>
            </div>
            <div>
              <h3 class="font-title-sm text-title-sm text-text-primary font-bold">Kerahasiaan Terjamin (NDA)</h3>
              <p class="font-label-sm text-label-sm text-text-secondary">Strict Compliance &amp; Protocol</p>
            </div>
          </div>
          <p class="font-body-sm text-body-sm text-text-body leading-relaxed">
            Setiap cetak biru sistem, data transaksi, dan dokumentasi arsitektur terlindungi oleh perjanjian kerahasiaan legal sebelum evaluasi teknis dimulai.
          </p>
        </div>

        <div class="p-6 rounded-xl bg-surface-container-lowest shadow-sm border border-subtle-border flex flex-col justify-between space-y-4">
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-pale-mint flex items-center justify-center text-primary-container shrink-0">
              <span class="material-symbols-outlined text-[24px]">support_agent</span>
            </div>
            <div>
              <h3 class="font-title-sm text-title-sm text-text-primary font-bold">Konsultasi Awal Bebas Biaya</h3>
              <p class="font-label-sm text-label-sm text-text-secondary">Initial Architectural Discovery</p>
            </div>
          </div>
          <p class="font-body-sm text-body-sm text-text-body leading-relaxed">
            Diskusikan tantangan skalabilitas atau rencana audit kepatuhan TI Anda secara komprehensif tanpa biaya komitmen di sesi awal peninjauan.
          </p>
        </div>

        <div class="p-6 rounded-xl bg-surface-container-lowest shadow-sm border border-subtle-border flex flex-col justify-between space-y-4">
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-pale-mint flex items-center justify-center text-primary-container shrink-0">
              <span class="material-symbols-outlined text-[24px]">speed</span>
            </div>
            <div>
              <h3 class="font-title-sm text-title-sm text-text-primary font-bold">Dukungan SLA 99.9% Enterprise</h3>
              <p class="font-label-sm text-label-sm text-text-secondary">Mission-Critical Availability</p>
            </div>
          </div>
          <p class="font-body-sm text-body-sm text-text-body leading-relaxed">
            Jaminan respons insiden cepat melalui tim Network Operations Center (NOC) serta Security Operations Center (SOC) berkualifikasi enterprise.
          </p>
        </div>
      </div>
    </section>

  </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
