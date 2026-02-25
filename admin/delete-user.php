<?php
include '../db.php';

$table = "user";
$id = $_GET['id'];

$sql = "DELETE FROM $table WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

header("Location: users.php");
exit();
