<?php
include '../db.php';

$table = "recu";

$data = $_POST;
$id = $data['num_recu'] ?? null;
unset($data['num_recu']);

if ($id) {
    $set = [];
    foreach ($data as $key => $value) {
        $set[] = "$key = :$key";
    }

    $sql = "UPDATE $table SET " . implode(", ", $set) . " WHERE num_recu = :id";
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
header("Location: paiements.php");
exit();
