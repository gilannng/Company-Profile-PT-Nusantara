<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Tentukan URL redirect login berdasarkan kedalaman direktori pemanggil
    $current_dir = basename(getcwd());
    $redirect_url = ($current_dir === 'admin') ? 'login.php' : '../login.php';
    
    $_SESSION['flash_message'] = [
        'type' => 'warning',
        'text' => 'Silakan masuk (login) terlebih dahulu untuk mengakses panel administrator.'
    ];
    header("Location: " . $redirect_url);
    exit;
}
