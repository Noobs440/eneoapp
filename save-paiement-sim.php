<?php
session_start();
require 'db.php';

header('Content-Type: application/json; charset=utf-8');

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
error_log("DEBUG save-paiement-sim payload: " . $raw);
if (!is_array($data)) {
    echo json_encode(['success' => false, 'message' => 'Données invalides']);
    exit;
}

// sanitize/cast numeric fields
// keep facture as string (alphanumeric codes)
$num_facture = $data['num_facture'] ?? null;
$num_contrat = isset($data['num_contrat']) ? (int)$data['num_contrat'] : null;
$montant = isset($data['montant']) ? (int)$data['montant'] : null;
$phone = $data['phone'] ?? null;
$mois = $data['mois'] ?? null;
$mode = $data['mode'] ?? 'Orange Money';

error_log("DEBUG save-paiement-sim cleaned: num_facture=$num_facture, num_contrat=$num_contrat, montant=$montant, mode=$mode, mois=$mois, phone=$phone");

// require at least facture, contrat and montant to be non-null
if ($num_facture === null || $num_contrat === null || $montant === null) {
    echo json_encode(['success' => false, 'message' => 'Paramètres invalides']);
    exit;
}

try {
    // generate a simulated receipt number
    $num_recu = 'OM' . time() . rand(100,999);

    error_log("DEBUG save-paiement-sim: inserting num_facture=$num_facture, montant=$montant, mois=$mois");

    $sql = "INSERT INTO paiement (date, num_recu, montant, mode, agence, mois, num_facture, montant_facture, num_contrat)
            VALUES (NOW(), :num_recu, :montant, :mode, :agence, :mois, :num_facture, :montant_facture, :num_contrat)";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([
        ':num_recu' => $num_recu,
        ':montant' => $montant,
        ':mode' => $mode,
        ':agence' => $mode,
        ':mois' => $mois,
        ':num_facture' => $num_facture,
        ':montant_facture' => $montant,
        ':num_contrat' => $num_contrat
    ]);
    
    error_log("Insert result: " . ($result ? "true" : "false") . ", rows: " . $stmt->rowCount());
    
    if (!$result) {
        $err = $stmt->errorInfo();
        error_log("INSERT ERROR: " . print_r($err, true));
        // Try fallback insert that still sets num_facture if available
        error_log("Attempting fallback insert with minimal required cols...");
        $sql2 = "INSERT INTO paiement (date, num_recu, montant, mode, agence, num_contrat, num_facture) VALUES (NOW(), :num_recu, :montant, :mode, :agence, :num_contrat, :num_facture)";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute([
            ':num_recu' => $num_recu,
            ':montant' => $montant,
            ':mode' => $mode,
            ':agence' => $mode,
            ':num_contrat' => $num_contrat,
            ':num_facture' => $num_facture
        ]);
        error_log("Fallback insert done, rows: " . $stmt2->rowCount());
    }


    // mark facture as paid (if provided)
    if ($num_facture !== null && $num_facture !== '') {
        $u = $pdo->prepare("UPDATE factures SET statut = 'payé' WHERE num_facture = :num");
        $u->execute([':num' => $num_facture]);
        error_log("DEBUG save-paiement-sim updated factures, rows affected: " . $u->rowCount());
    } else {
        error_log("DEBUG save-paiement-sim: no num_facture provided, skipping statut update");
    }

    // verify inserted record
    $check = $pdo->prepare("SELECT * FROM paiement WHERE num_recu = ?");
    $check->execute([$num_recu]);
    $inserted = $check->fetch(PDO::FETCH_ASSOC);
    error_log("DEBUG save-paiement-sim inserted: " . print_r($inserted, true));
    
    echo json_encode(['success' => true, 'num_recu' => $num_recu]);
    exit;
} catch (Exception $e) {
    error_log("EXCEPTION save-paiement-sim: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    exit;
}
