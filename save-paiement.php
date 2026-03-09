<?php
session_start();
require 'db.php';
require 'config.php';

header('Content-Type: application/json; charset=utf-8');

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
error_log("DEBUG save-paiement payload: " . $raw);
if (!is_array($data)) {
    echo json_encode(['success' => false, 'message' => 'Données invalides']);
    exit;
}

$num_facture = $data['num_facture'] ?? null;
$num_contrat = isset($data['num_contrat']) ? (int)$data['num_contrat'] : null;
$montant = isset($data['montant']) ? (int)$data['montant'] : null;
$phone = $data['phone'] ?? null;
$mois = $data['mois'] ?? null;
$mode = $data['mode'] ?? 'Orange Money';

// basic validation
if ($num_facture === null || $num_contrat === null || $montant === null) {
    echo json_encode(['success' => false, 'message' => 'Paramètres invalides']);
    exit;
}

// helper for calling the external payment API
function callPaymentAPI($url, $payload) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . PAYMENT_API_KEY,
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    $result = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (curl_errno($ch)) {
        error_log('Curl error: ' . curl_error($ch));
    }
    curl_close($ch);
    return ['httpcode' => $httpcode, 'body' => $result];
}

try {
    if (USE_SANDBOX) {
        // build request according to sandbox API documentation
        $apiPayload = [
            'amount'     => $montant,
            'currency'   => 'XOF',
            'phone'      => $phone,
            'contract'   => $num_contrat,
            'invoice'    => $num_facture,
            'description'=> "Paiement facture $num_facture",
            // add any other required fields here
        ];

        $apiResp = callPaymentAPI(PAYMENT_API_URL, $apiPayload);
        $respArr = json_decode($apiResp['body'], true);

        // adjust the success condition to whatever your provider returns
        if ($apiResp['httpcode'] === 200 && isset($respArr['success']) && $respArr['success']) {
            // provider usually returns a transaction or receipt id
            $num_recu = $respArr['data']['receipt'] ?? ('SANDBOX' . time());

            // store payment in local database
            $stmt = $pdo->prepare(
                "INSERT INTO paiement (date, num_recu, montant, mode, agence, mois, num_facture, montant_facture, num_contrat)
                 VALUES (NOW(), :num_recu, :montant, :mode, :agence, :mois, :num_facture, :montant_facture, :num_contrat)"
            );
            $stmt->execute([
                ':num_recu' => $num_recu,
                ':montant' => $montant,
                ':mode' => $mode,
                ':agence' => $mode,
                ':mois' => $mois,
                ':num_facture' => $num_facture,
                ':montant_facture' => $montant,
                ':num_contrat' => $num_contrat
            ]);

            // mark facture paid if provided
            if ($num_facture !== '') {
                $u = $pdo->prepare("UPDATE factures SET statut = 'payé' WHERE num_facture = :num");
                $u->execute([':num' => $num_facture]);
            }

            echo json_encode(['success' => true, 'num_recu' => $num_recu]);
            exit;
        } else {
            $msg = $respArr['message'] ?? 'erreur sur l\'API de paiement';
            error_log("API response: " . $apiResp['body']);
            echo json_encode(['success' => false, 'message' => $msg]);
            exit;
        }
    } else {
        // fallback to the previous simulation logic when sandbox flag is false
        $num_recu = 'OM' . time() . rand(100, 999);

        $stmt = $pdo->prepare(
            "INSERT INTO paiement (date, num_recu, montant, mode, agence, mois, num_facture, montant_facture, num_contrat)
             VALUES (NOW(), :num_recu, :montant, :mode, :agence, :mois, :num_facture, :montant_facture, :num_contrat)"
        );
        $stmt->execute([
            ':num_recu' => $num_recu,
            ':montant' => $montant,
            ':mode' => $mode,
            ':agence' => $mode,
            ':mois' => $mois,
            ':num_facture' => $num_facture,
            ':montant_facture' => $montant,
            ':num_contrat' => $num_contrat
        ]);

        if ($num_facture !== '') {
            $u = $pdo->prepare("UPDATE factures SET statut = 'payé' WHERE num_facture = :num");
            $u->execute([':num' => $num_facture]);
        }

        echo json_encode(['success' => true, 'num_recu' => $num_recu]);
        exit;
    }
} catch (Exception $e) {
    error_log("EXCEPTION save-paiement: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    exit;
}
