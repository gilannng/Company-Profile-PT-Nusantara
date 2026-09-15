document.addEventListener('DOMContentLoaded', function () {
    // 1. Auto-dismiss Alert Notifikasi setelah 5 detik
    const alerts = document.querySelectorAll('.alert-dismissible');
    alerts.forEach(function (alert) {
        setTimeout(function () {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
            if (bsAlert) {
                bsAlert.close();
            }
        }, 5000);
    });

    // 2. Inisialisasi Tooltip Bootstrap (jika ada)
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // 3. Konfirmasi Dialog Penghapusan Data (Admin CRUD)
    const deleteButtons = document.querySelectorAll('.btn-delete-confirm');
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function (e) {
            const itemName = this.getAttribute('data-name') || 'data ini';
            const confirmed = confirm('Apakah Anda yakin ingin menghapus ' + itemName + '? Tindakan ini tidak dapat dibatalkan.');
            if (!confirmed) {
                e.preventDefault();
            }
        });
    });

    // 4. Modal Interaktif Detail Layanan (produk.php)
    const serviceDetailModal = document.getElementById('serviceDetailModal');
    if (serviceDetailModal) {
        serviceDetailModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (!button) return;

            const title = button.getAttribute('data-service-title');
            const desc = button.getAttribute('data-service-desc');
            const img = button.getAttribute('data-service-img');

            const modalTitle = serviceDetailModal.querySelector('#modalServiceTitle');
            const modalDesc = serviceDetailModal.querySelector('#modalServiceDesc');
            const modalImg = serviceDetailModal.querySelector('#modalServiceImg');

            if (modalTitle) modalTitle.textContent = title || 'Rincian Layanan';
            if (modalDesc) modalDesc.textContent = desc || '';
            if (modalImg && img) modalImg.src = img;
        });
    }

    // 5. Modal Interaktif Preview Foto Galeri (galeri.php)
    const galleryPreviewModal = document.getElementById('galleryPreviewModal');
    if (galleryPreviewModal) {
        galleryPreviewModal.addEventListener('show.bs.modal', function (event) {
            const card = event.relatedTarget;
            if (!card) return;

            const title = card.getAttribute('data-gallery-title');
            const img = card.getAttribute('data-gallery-img');

            const modalTitle = galleryPreviewModal.querySelector('#modalGalleryTitle');
            const modalImg = galleryPreviewModal.querySelector('#modalGalleryImg');

            if (modalTitle) modalTitle.textContent = title || 'Dokumentasi Perusahaan';
            if (modalImg && img) modalImg.src = img;
        });
    }

    // 6. Preview Upload Gambar Sesaat Sebelum Submit (Admin Forms)
    const imageInputs = document.querySelectorAll('.image-upload-preview-input');
    imageInputs.forEach(function (input) {
        input.addEventListener('change', function () {
            const targetPreviewId = this.getAttribute('data-preview-target');
            const previewEl = document.getElementById(targetPreviewId);
            if (previewEl && this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewEl.src = e.target.result;
                    previewEl.classList.remove('d-none');
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
});
