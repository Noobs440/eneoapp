<?php
session_start();
require 'db.php';

$num_recu = $_GET['num_recu'] ?? null;
$num_facture = $_GET['num_facture'] ?? null;

// Step 1: Get payment record
$paiement = null;
if ($num_recu) {
    $stmt = $pdo->prepare("SELECT * FROM paiement WHERE num_recu = ? LIMIT 1");
    $stmt->execute([$num_recu]);
    $paiement = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif ($num_facture) {
    $stmt = $pdo->prepare("SELECT * FROM paiement WHERE num_facture = ? ORDER BY date DESC LIMIT 1");
    $stmt->execute([$num_facture]);
    $paiement = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$paiement) {
    die('Reçu introuvable');
}

error_log("DEBUG recu.php - Step 1 paiement keys: " . implode(", ", array_keys($paiement)));

// Step 2: Get invoice details if num_facture is in paiement
$facture = null;
if (!empty($paiement['num_facture'])) {
    $fstmt = $pdo->prepare("SELECT * FROM factures WHERE num_facture = ? LIMIT 1");
    $fstmt->execute([$paiement['num_facture']]);
    $facture = $fstmt->fetch(PDO::FETCH_ASSOC);
    error_log("DEBUG recu.php - Step 2 facture found: " . ($facture ? 'yes' : 'no'));
}

// Step 3: Get contract/subscriber details
$contrat = null;
$num_contrat = $paiement['num_contrat'] ?? ($facture['num_contrat'] ?? null);
if ($num_contrat) {
    $cstmt = $pdo->prepare("SELECT * FROM contrat WHERE num_contrat = ? LIMIT 1");
    $cstmt->execute([$num_contrat]);
    $contrat = $cstmt->fetch(PDO::FETCH_ASSOC);
    error_log("DEBUG recu.php - Step 3 contrat found: " . ($contrat ? 'yes' : 'no'));
}

// Step 4: Build display data from all sources
$display = [
    'num_recu'    => $paiement['num_recu'] ?? '?',
    'date'        => $paiement['date'] ?? '?',
    'nom_abonne'  => $contrat['nom_abonne'] ?? '?',
    'num_contrat' => $paiement['num_contrat'] ?? $facture['num_contrat'] ?? '?',
    'num_facture' => $paiement['num_facture'] ?? $facture['num_facture'] ?? '?',
    'mois'        => $facture['mois'] ?? $paiement['mois'] ?? '?',
    'montant'     => $paiement['montant'] ?? '?',
    'mode'        => $paiement['mode'] ?? '?',
];

error_log("DEBUG recu.php - Final display data: " . print_r($display, true));

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reçu - <?= htmlspecialchars($display['num_recu']) ?></title>
    <link rel="stylesheet" href="factures.css">
    <style>
        .receipt { max-width:700px; margin:30px auto; background:#fff; padding:20px; border-radius:8px; }
        .receipt h2 { margin-top:0; }
        .receipt .row { display:flex; justify-content:space-between; margin:8px 0; font-size: 15px; }
        .receipt .row strong { min-width: 150px; }
        @media print { .no-print { display:none; } body { margin: 0; } .receipt { margin: 0; } }
    </style>
</head>
<body>
<div class="receipt">
    <div class="no-print" style="text-align:right;"><button onclick="window.print()">🖨️ Imprimer</button></div>
    
    <h2>Reçu de paiement ENEO</h2>
    <hr>
    
    <div class="row"><strong>Reçu N°</strong><span><?= htmlspecialchars($display['num_recu']) ?></span></div>
    <div class="row"><strong>Date</strong><span><?= htmlspecialchars($display['date']) ?></span></div>
    
    <hr>
    
    <div class="row"><strong>Abonné</strong><span><?= htmlspecialchars($display['nom_abonne']) ?></span></div>
    <div class="row"><strong>N° Contrat</strong><span><?= htmlspecialchars($display['num_contrat']) ?></span></div>
    
    <hr>
    
    <div class="row"><strong>N° Facture</strong><span><?= htmlspecialchars($display['num_facture']) ?></span></div>
    <div class="row"><strong>Période</strong><span><?= htmlspecialchars($display['mois']) ?></span></div>
    <div class="row"><strong>Montant payé</strong><span><?= htmlspecialchars($display['montant']) ?> FCFA</span></div>
    <div class="row"><strong>Mode paiement</strong><span><?= htmlspecialchars($display['mode']) ?></span></div>
    
    <hr>
    <div style="margin-top:20px; text-align: center; font-size:13px; color:#555;">Merci pour votre paiement. Ce reçu serve de justificatif.</div>
</div>
</body>
</html>
