<?php
include '../db.php';

$table = "contrat";
$id = $_GET['num_contrat'];

$sql = "DELETE FROM $table WHERE num_contrat = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

header("Location: contrats.php");
exit();
