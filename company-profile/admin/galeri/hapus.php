<?php
require_once __DIR__ . '/../../config/koneksi.php';
require_once __DIR__ . '/../auth_check.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = mysqli_query($koneksi, "SELECT * FROM galeri WHERE id = $id LIMIT 1");

if ($query && mysqli_num_rows($query) > 0) {
    $data = mysqli_fetch_assoc($query);

    // Hapus berkas fisik jika bukan preset SVG bawaan
    $default_presets = ['galeri_datacenter.svg','galeri_workshop.svg','galeri_meeting.svg','galeri_noc.svg','galeri_mou.svg','galeri_audit.svg'];
    if (!in_array($data['foto'], $default_presets)) {
        $file_path = __DIR__ . '/../../assets/img/uploads/' . $data['foto'];
        if (file_exists($file_path)) {
            @unlink($file_path);
        }
    }

    if (mysqli_query($koneksi, "DELETE FROM galeri WHERE id = $id")) {
        set_flash_message('success', 'Foto dokumentasi "' . htmlspecialchars($data['judul']) . '" berhasil dihapus.');
    } else {
        set_flash_message('danger', 'Gagal menghapus foto galeri: ' . mysqli_error($koneksi));
    }
} else {
    set_flash_message('warning', 'Data foto galeri tidak ditemukan!');
}

header("Location: index.php");
exit;
