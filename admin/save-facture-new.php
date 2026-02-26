<?php
session_start();
require '../db.php';

try {
    $num_facture = trim($_POST['num_facture'] ?? '');
    $num_facture = ($num_facture === '' || $num_facture === '0') ? '' : $num_facture;
    $num_contrat = trim($_POST['num_contrat'] ?? '');
    $mois        = trim($_POST['mois'] ?? '');
    $consommation = floatval($_POST['consommation'] ?? 0);
    $statut      = trim($_POST['statut'] ?? 'impayé');
    $date_limite = trim($_POST['date_limite'] ?? '');

    if (!$num_contrat || !$mois) {
        throw new Exception('Données manquantes');
    }

    $montant = $consommation * 100;

    if ($num_facture) {
        // ===== UPDATE =====
        $sql = "UPDATE factures 
                SET num_contrat = ?, mois = ?, consommation = ?, montant = ?, statut = ?, date_limite = ?
                WHERE num_facture = ?";
        $pdo->prepare($sql)->execute([
            $num_contrat, $mois, $consommation, $montant, $statut, $date_limite, $num_facture
        ]);

    } else {
        // ===== INSERT avec transaction =====
        // NOTE: The trigger before_insert_facture will auto-generate num_facture
        // So we send NULL and let the trigger handle it
        $pdo->beginTransaction();

        try {
            error_log("DEBUG - Inserting new invoice, letting trigger generate ID");

            $sql = "INSERT INTO factures (num_facture, num_contrat, mois, consommation, montant, statut, date_limite)
                    VALUES (NULL, ?, ?, ?, ?, ?, ?)";
            $pdo->prepare($sql)->execute([
                $num_contrat, $mois, $consommation, $montant, $statut, $date_limite
            ]);

            $pdo->commit();

        } catch (Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }

    header('Location: factures.php');
    exit;

} catch (Exception $e) {
    error_log($e->getMessage());
    $_SESSION['facture_error'] = $e->getMessage();
    header('Location: add-facture.php');
    exit;
}
?>