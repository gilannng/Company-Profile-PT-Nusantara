<?php
require_once __DIR__ . '/../../config/koneksi.php';
require_once __DIR__ . '/../auth_check.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = mysqli_query($koneksi, "SELECT * FROM artikel WHERE id = $id LIMIT 1");

if ($query && mysqli_num_rows($query) > 0) {
    $data = mysqli_fetch_assoc($query);

    if (mysqli_query($koneksi, "DELETE FROM artikel WHERE id = $id")) {
        set_flash_message('success', 'Artikel "' . htmlspecialchars($data['judul']) . '" berhasil dihapus.');
    } else {
        set_flash_message('danger', 'Gagal menghapus artikel: ' . mysqli_error($koneksi));
    }
} else {
    set_flash_message('warning', 'Data artikel tidak ditemukan!');
}

header("Location: index.php");
exit;
