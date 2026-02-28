<?php
require 'db.php';

// Insert sample data into releve table
$test_data = [
    ['mois' => 202602, 'conso_precedente' => 1000, 'conso' => 1250, 'difference' => 250, 'num_facture' => 'FAC-0001', 'num_contrat' => 74319213],
    ['mois' => 202601, 'conso_precedente' => 800, 'conso' => 1000, 'difference' => 200, 'num_facture' => 'FAC-0004', 'num_contrat' => 74319213],
    ['mois' => 202512, 'conso_precedente' => 950, 'conso' => 800, 'difference' => -150, 'num_facture' => 'FAC-0005', 'num_contrat' => 74319213],
];

$stmt = $pdo->prepare("INSERT INTO releve (mois, conso_precedente, conso, difference, num_facture, num_contrat) VALUES (:mois, :conso_precedente, :conso, :difference, :num_facture, :num_contrat)");

foreach ($test_data as $row) {
    try {
        $stmt->execute($row);
        echo "Inserted: " . $row['mois'] . "\n";
    } catch (Exception $e) {
        echo "Error inserting " . $row['mois'] . ": " . $e->getMessage() . "\n";
    }
}

echo "Done!\n";
?>