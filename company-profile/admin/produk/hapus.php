<?php
require_once __DIR__ . '/../../config/koneksi.php';
require_once __DIR__ . '/../auth_check.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id = $id LIMIT 1");

if ($query && mysqli_num_rows($query) > 0) {
    $data = mysqli_fetch_assoc($query);

    // Hapus file fisik gambar jika bukan berkas preset SVG default
    $default_presets = ['layanan_webdev.svg','layanan_jaringan.svg','layanan_security.svg','layanan_cloud.svg','layanan_konsultan.svg','layanan_managed.svg'];
    if (!in_array($data['gambar'], $default_presets)) {
        $file_path = __DIR__ . '/../../assets/img/uploads/' . $data['gambar'];
        if (file_exists($file_path)) {
            @unlink($file_path);
        }
    }

    if (mysqli_query($koneksi, "DELETE FROM produk WHERE id = $id")) {
        set_flash_message('success', 'Layanan IT "' . htmlspecialchars($data['nama_layanan']) . '" berhasil dihapus.');
    } else {
        set_flash_message('danger', 'Gagal menghapus data layanan: ' . mysqli_error($koneksi));
    }
} else {
    set_flash_message('warning', 'Data layanan tidak ditemukan!');
}

header("Location: index.php");
exit;
