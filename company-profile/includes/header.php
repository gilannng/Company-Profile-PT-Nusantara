<?php
if (!isset($page_title)) {
    $page_title = "PT Digital Solusi Nusantara - Solusi Teknologi Digital Terpercaya";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="PT Digital Solusi Nusantara - Solusi Teknologi Digital Terpercaya untuk Kemajuan Bisnis Indonesia. Rekayasa web & mobile enterprise, infrastruktur cloud, dan keamanan data.">
    <meta name="keywords" content="Konsultan IT, Web Enterprise, Cloud Modern, Cybersecurity, Software House Indonesia, PT Digital Solusi Nusantara">
    <meta name="author" content="PT Digital Solusi Nusantara">
    
    <title><?= htmlspecialchars($page_title); ?></title>

    <!-- Google Fonts: Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Google Material Symbols Outlined -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

    <!-- Font Awesome 6 Icons via CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- AOS (Animate On Scroll) CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "outline": "#6d7b67",
                    "pale-mint": "#E8F5E9",
                    "on-tertiary-fixed-variant": "#653e00",
                    "text-body": "#475569",
                    "primary-fixed-dim": "#55e248",
                    "surface-bright": "#f8f9fa",
                    "on-surface": "#191c1d",
                    "secondary-container": "#d5e0f8",
                    "on-secondary-container": "#586377",
                    "surface-dim": "#d9dadb",
                    "on-background": "#191c1d",
                    "inverse-surface": "#2e3132",
                    "surface-variant": "#e1e3e4",
                    "background": "#f8f9fa",
                    "on-tertiary-fixed": "#2a1700",
                    "on-secondary-fixed": "#111c2d",
                    "text-secondary": "#64748B",
                    "on-surface-variant": "#3e4a39",
                    "tertiary-fixed": "#ffddb8",
                    "on-secondary": "#ffffff",
                    "tertiary": "#855300",
                    "on-primary-fixed": "#002200",
                    "tertiary-fixed-dim": "#ffb95f",
                    "on-primary-container": "#003501",
                    "primary-container": "#03ac0e",
                    "subtle-border": "#E2E8F0",
                    "inverse-primary": "#55e248",
                    "pure-white": "#FFFFFF",
                    "surface-container-high": "#e7e8e9",
                    "border-secondary": "#CBD5E1",
                    "footer-text": "#94A3B8",
                    "outline-variant": "#bccbb4",
                    "surface-container-low": "#f3f4f5",
                    "surface": "#f8f9fa",
                    "on-error-container": "#93000a",
                    "inverse-on-surface": "#f0f1f2",
                    "secondary-fixed": "#d8e3fb",
                    "error-container": "#ffdad6",
                    "on-tertiary-container": "#422700",
                    "on-error": "#ffffff",
                    "surface-tint": "#006e04",
                    "text-primary": "#212529",
                    "surface-container-highest": "#e1e3e4",
                    "secondary": "#545f73",
                    "primary": "#006e04",
                    "secondary-fixed-dim": "#bcc7de",
                    "error": "#ba1a1a",
                    "surface-container": "#edeeef",
                    "brand-green-hover": "#00880D",
                    "on-tertiary": "#ffffff",
                    "on-secondary-fixed-variant": "#3c475a",
                    "tertiary-container": "#ce8400",
                    "on-primary": "#ffffff",
                    "primary-fixed": "#76ff64",
                    "surface-container-lowest": "#ffffff",
                    "on-primary-fixed-variant": "#005302"
                },
                borderRadius: {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
                },
                spacing: {
                    "gutter-mobile": "1rem",
                    "space-sm": "0.5rem",
                    "margin": "1rem",
                    "space-xl": "2.5rem",
                    "space-xs": "0.25rem",
                    "space-md": "1rem",
                    "space-lg": "1.5rem",
                    "gutter": "1rem",
                    "margin-mobile": "1rem"
                },
                fontFamily: {
                    "headline-md": ["Plus Jakarta Sans"],
                    "label-sm": ["Inter"],
                    "body-sm": ["Inter"],
                    "label-md": ["Inter"],
                    "headline-lg": ["Plus Jakarta Sans"],
                    "title-md": ["Inter"],
                    "display-mobile": ["Plus Jakarta Sans"],
                    "headline-lg-mobile": ["Plus Jakarta Sans"],
                    "body-md": ["Inter"],
                    "display": ["Plus Jakarta Sans"],
                    "body-lg": ["Inter"],
                    "title-sm": ["Inter"],
                    "headline-sm": ["Plus Jakarta Sans"]
                },
                fontSize: {
                    "headline-md": ["clamp(1.25rem, 2.5vw + 0.5rem, 1.75rem)", { "lineHeight": "1.3", "fontWeight": "700" }],
                    "label-sm": ["12px", { "lineHeight": "16px", "fontWeight": "500" }],
                    "body-sm": ["14px", { "lineHeight": "22px", "fontWeight": "400" }],
                    "label-md": ["14px", { "lineHeight": "20px", "fontWeight": "600" }],
                    "headline-lg": ["clamp(1.5rem, 3vw + 0.75rem, 2.25rem)", { "lineHeight": "1.25", "fontWeight": "700" }],
                    "title-md": ["18px", { "lineHeight": "26px", "fontWeight": "600" }],
                    "display-mobile": ["clamp(1.5rem, 3vw + 0.5rem, 2rem)", { "lineHeight": "1.25", "fontWeight": "700" }],
                    "headline-lg-mobile": ["clamp(1.35rem, 2.5vw + 0.5rem, 1.75rem)", { "lineHeight": "1.3", "fontWeight": "700" }],
                    "body-md": ["16px", { "lineHeight": "26px", "fontWeight": "400" }],
                    "display": ["clamp(1.75rem, 4vw + 0.75rem, 3rem)", { "lineHeight": "1.2", "fontWeight": "700" }],
                    "body-lg": ["clamp(1rem, 1.5vw + 0.75rem, 1.125rem)", { "lineHeight": "1.6", "fontWeight": "400" }],
                    "title-sm": ["16px", { "lineHeight": "24px", "fontWeight": "600" }],
                    "headline-sm": ["clamp(1.1rem, 2vw + 0.5rem, 1.25rem)", { "lineHeight": "1.35", "fontWeight": "600" }]
                }
            }
        }
    };
    </script>

    <!-- Custom CSS Style -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="assets/img/logo.svg">
</head>
<body class="bg-background font-body-md text-body antialiased min-h-screen flex flex-col">
