<?php
require_once __DIR__ . '/../auth_check.php';

$is_sub = (basename(dirname($_SERVER['PHP_SELF'])) !== 'admin');
$admin_root = $is_sub ? '../' : './';
$site_root  = $is_sub ? '../../' : '../';

if (!isset($admin_title)) {
    $admin_title = "DSN Admin - Panel Administrator";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($admin_title); ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Google Material Symbols Outlined -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

    <!-- Bootstrap 5 CDN & Icons (for form controls and modals) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="<?= $site_root; ?>assets/css/style.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "surface": "#f8f9fa",
                    "surface-variant": "#e1e3e4",
                    "brand-green-hover": "#00880D",
                    "secondary": "#545f73",
                    "on-surface": "#191c1d",
                    "on-secondary": "#ffffff",
                    "on-error": "#ffffff",
                    "tertiary-fixed": "#ffddb8",
                    "outline-variant": "#bccbb4",
                    "background": "#f8f9fa",
                    "secondary-fixed": "#d8e3fb",
                    "on-secondary-fixed-variant": "#3c475a",
                    "pure-white": "#FFFFFF",
                    "surface-bright": "#f8f9fa",
                    "tertiary": "#855300",
                    "tertiary-container": "#ce8400",
                    "pale-mint": "#E8F5E9",
                    "text-secondary": "#64748B",
                    "surface-container-low": "#f3f4f5",
                    "on-tertiary-fixed-variant": "#653e00",
                    "secondary-container": "#d5e0f8",
                    "primary-fixed": "#76ff64",
                    "on-error-container": "#93000a",
                    "surface-container-lowest": "#ffffff",
                    "on-tertiary-container": "#422700",
                    "surface-dim": "#d9dadb",
                    "on-tertiary": "#ffffff",
                    "secondary-fixed-dim": "#bcc7de",
                    "on-primary": "#ffffff",
                    "on-primary-container": "#003501",
                    "primary-container": "#03ac0e",
                    "error": "#ba1a1a",
                    "inverse-primary": "#55e248",
                    "tertiary-fixed-dim": "#ffb95f",
                    "subtle-border": "#E2E8F0",
                    "inverse-surface": "#2e3132",
                    "surface-container-highest": "#e1e3e4",
                    "border-secondary": "#CBD5E1",
                    "on-background": "#191c1d",
                    "outline": "#6d7b67",
                    "inverse-on-surface": "#f0f1f2",
                    "error-container": "#ffdad6",
                    "on-primary-fixed": "#002200",
                    "surface-container-high": "#e7e8e9",
                    "surface-tint": "#006e04",
                    "text-primary": "#212529",
                    "text-body": "#475569",
                    "surface-container": "#edeeef",
                    "on-primary-fixed-variant": "#005302",
                    "on-tertiary-fixed": "#2a1700",
                    "primary-fixed-dim": "#55e248",
                    "on-surface-variant": "#3e4a39",
                    "on-secondary-container": "#586377",
                    "on-secondary-fixed": "#111c2d",
                    "footer-text": "#94A3B8",
                    "primary": "#006e04"
                },
                borderRadius: {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
                },
                fontFamily: {
                    "body-sm": ["Inter"],
                    "headline-md": ["Plus Jakarta Sans"],
                    "title-md": ["Inter"],
                    "headline-sm": ["Plus Jakarta Sans"],
                    "title-sm": ["Inter"],
                    "label-md": ["Inter"],
                    "headline-lg": ["Plus Jakarta Sans"],
                    "body-md": ["Inter"],
                    "label-sm": ["Inter"],
                    "display": ["Plus Jakarta Sans"],
                    "body-lg": ["Inter"]
                }
            }
        }
    };
    </script>
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?= $site_root; ?>assets/img/logo.svg">
</head>
<body class="bg-background font-body-md text-text-primary antialiased min-h-screen">
