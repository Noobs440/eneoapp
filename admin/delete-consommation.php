<?php
include '../db.php';

$table = "consommation";
$id = $_GET['id'];

$sql = "DELETE FROM $table WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

header("Location: consommations.php");
exit();
