        </div>
    </main>

    <footer class="py-4 px-4 sm:px-8 bg-surface-container-lowest border-t border-subtle-border text-center text-text-secondary font-label-sm text-xs flex flex-col sm:flex-row items-center justify-between gap-2">
        <div>
            &copy; <?= date('Y'); ?> <strong>PT Digital Solusi Nusantara</strong>. Panel CMS Administrator.
        </div>
        <div class="text-text-secondary text-[11px] sm:text-xs">
            Sistem Informasi Manajemen Terintegrasi
        </div>
    </footer>
</div>

<!-- Bootstrap 5 Bundle JS via CDN Resmi -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Mobile Sidebar Drawer Handler -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('adminSidebar');
    const toggleBtn = document.getElementById('adminSidebarToggleBtn');
    const closeBtn = document.getElementById('adminSidebarCloseBtn');
    const backdrop = document.getElementById('adminSidebarBackdrop');

    function openSidebar() {
        if (sidebar && backdrop) {
            sidebar.classList.remove('-translate-x-full');
            backdrop.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeSidebar() {
        if (sidebar && backdrop) {
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.add('hidden');
            document.body.style.overflow = '';
        }
    }

    if (toggleBtn) toggleBtn.addEventListener('click', openSidebar);
    if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
    if (backdrop) backdrop.addEventListener('click', closeSidebar);

    // Otomatis tutup saat resize ke ukuran desktop
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 1024) {
            closeSidebar();
        }
    });

    // Tutup dengan tombol Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeSidebar();
        }
    });
});
</script>

<!-- Custom Main JS -->
<script src="<?= $site_root; ?>assets/js/main.js"></script>
</body>
</html>
