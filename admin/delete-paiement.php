<?php
include '../db.php';

$table = "paiement";
$id = $_GET['num_recu'];

$sql = "DELETE FROM $table WHERE num_recu = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

header("Location: paiements.php");
exit();
