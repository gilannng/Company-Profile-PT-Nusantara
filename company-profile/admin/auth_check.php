<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Tentukan URL redirect login berdasarkan kedalaman direktori pemanggil
    $is_sub = (basename(dirname($_SERVER['PHP_SELF'] ?? '')) !== 'admin');
    $redirect_url = $is_sub ? '../login.php' : 'login.php';
    
    $_SESSION['flash_message'] = [
        'type' => 'warning',
        'text' => 'Silakan masuk (login) terlebih dahulu untuk mengakses panel administrator.'
    ];
    header("Location: " . $redirect_url);
    exit;
}
