<?php
include '../db.php';

$table = "facture";
$id = $_GET['num_facture'];

$sql = "DELETE FROM $table WHERE num_facture = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

header("Location: factures.php");
exit();
