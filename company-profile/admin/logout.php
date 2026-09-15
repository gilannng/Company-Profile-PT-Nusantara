<?php
require_once __DIR__ . '/../config/koneksi.php';

// Hapus variabel sesi login
unset($_SESSION['admin_logged_in']);
unset($_SESSION['admin_id']);
unset($_SESSION['admin_username']);
unset($_SESSION['admin_nama']);

// Set pesan sukses keluar
set_flash_message('success', 'Anda telah berhasil keluar dari sistem administrasi.');

header("Location: login.php");
exit;
