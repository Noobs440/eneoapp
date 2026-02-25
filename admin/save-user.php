<?php
include '../db.php';

$table = "user";

$data = $_POST;
$id = $data['id'] ?? null;
unset($data['id']);
$password = $_POST['password'] ?? "";
if (strlen($password) < 6) {
    die("Le mot de passe doit contenir au moins 6 caractères.");
}
$data['password'] = password_hash($password, PASSWORD_DEFAULT);

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
header("Location: users.php");
exit();
