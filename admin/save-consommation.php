<?php
session_start();
include '../db.php';

$table = "consommation";

$data = $_POST;
$id = $data['id'] ?? null;
unset($data['id']);

// Validate that provided num_contrat exists in contrat table
$numContrat = $data['num_contrat'] ?? null;
if (empty($numContrat)) {
    $_SESSION['consommation_error'] = 'N° de contrat requis.';
    if ($id) {
        header('Location: edit-consommation.php?id=' . urlencode($id));
    } else {
        header('Location: add-consommation.php?num_contrat=' . urlencode($numContrat));
    }
    exit();
}

$stmtChk = $pdo->prepare('SELECT 1 FROM contrat WHERE num_contrat = ?');
$stmtChk->execute([$numContrat]);
if ($stmtChk->rowCount() === 0) {
    $_SESSION['consommation_error'] = "Le numéro de contrat n'existe pas.";
    if ($id) {
        header('Location: edit-consommation.php?id=' . urlencode($id));
    } else {
        header('Location: add-consommation.php?num_contrat=' . urlencode($numContrat));
    }
    exit();
}

if ($id) {
    $set = [];
    foreach ($data as $key => $value) {
        $set[] = "$key = :$key";
    }

    $sql = "UPDATE $table SET " . implode(", ", $set) . " WHERE id = :id";
    $data['id'] = $id;

    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);

} else {
    $columns = implode(", ", array_keys($data));
    $values = ":" . implode(", :", array_keys($data));

    $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
}
header("Location: consommations.php");
exit();
