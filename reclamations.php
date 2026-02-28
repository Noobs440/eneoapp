<?php
session_start();
require 'db.php';
?>
<?php include 'navbar.php'; ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Réclamations — ENEOAPP</title>
    <link rel="stylesheet" href="navbar.css">
    <style>
        body { background: linear-gradient(180deg,#f4f7fb,#eef4fb); font-family: Inter, Arial, sans-serif; margin:0; }
        .reclaim-wrap { min-height: 72vh; display:flex; align-items:center; justify-content:center; padding:60px 20px; }
        .reclaim-card { background: #fff; border-radius:16px; padding:48px; max-width:880px; width:100%; box-shadow: 0 18px 60px rgba(9,50,125,0.08); text-align:center; }
        .gear { width:160px; height:160px; margin:0 auto 18px; display:block; }
        .title { color:#083c8a; font-size:30px; font-weight:700; margin-bottom:8px; }
        .lead { color:#3b516f; font-size:16px; margin-bottom:18px; }
        .back { display:inline-block; padding:10px 18px; background:#083c8a; color:#fff; border-radius:10px; text-decoration:none; font-weight:600; box-shadow: 0 8px 30px rgba(8,60,138,0.12); }
        .gear svg { filter: drop-shadow(0 8px 20px rgba(8,60,138,0.12)); }
        /* spin animation */
        @keyframes spin { from { transform: rotate(0deg) } to { transform: rotate(360deg) } }
        .gear .g-main { animation: spin 8s linear infinite; transform-origin: 50% 50%; }
        /* small responsive tweaks */
        @media (max-width:600px){ .reclaim-card { padding:28px; } .title{font-size:22px;} }
    </style>
</head>
<body>

<div class="reclaim-wrap">
    <div class="reclaim-card">
        <div class="gear" aria-hidden="true">
            <!-- stylized gear SVG, replaceable with your image -->
            <svg viewBox="0 0 100 100" width="160" height="160" xmlns="http://www.w3.org/2000/svg" role="img">
                <defs>
                    <linearGradient id="g1" x1="0" x2="1">
                        <stop offset="0" stop-color="#1976d2"/>
                        <stop offset="1" stop-color="#0b52a1"/>
                    </linearGradient>
                </defs>
                <g class="g-main" transform="translate(50,50)">
                    <path d="M-9-38 L9-38 L14-24 L32-18 L32 0 L18 12 L22 34 L6 44 L-6 34 L-2 12 L-18 0 L-18 -18 Z" fill="url(#g1)" opacity="0.95" transform="scale(1.2)"/>
                    <circle cx="0" cy="0" r="18" fill="#fff" />
                    <circle cx="0" cy="0" r="12" fill="url(#g1)" />
                </g>
            </svg>
        </div>

        <div class="title">Page Réclamations — Bientôt disponible</div>
        <div class="lead">Nous préparons un espace sécurisé pour vos réclamations et demandes. Cette fonctionnalité sera disponible très prochainement.</div>
        <a class="back" href="indexDashboardUser.php">Retour à l'acceuil</a>
    </div>
</div>

</body>
</html>
