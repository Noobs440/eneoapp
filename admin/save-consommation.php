<?php
include '../db.php';

$table = "consommation";

$data = $_POST;
$id = $data['id'] ?? null;
unset($data['id']);

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
