<?php
include '../db.php';

function generateUniqueContractNumber($pdo) {

    do {
        $num = random_int(10000000, 99999999);

        $sql = "SELECT COUNT(*) FROM contrat WHERE num_contrat = :num";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['num' => $num]);

        $exists = $stmt->fetchColumn();

    } while ($exists > 0);

    return $num;
}

$table = "contrat";

$data = $_POST;
$id = $data['num_contrat'] ?? null;

if ($id) {

    unset($data['num_contrat']);

    $set = [];
    foreach ($data as $key => $value) {
        $set[] = "$key = :$key";
    }

    $sql = "UPDATE $table 
            SET " . implode(", ", $set) . " 
            WHERE num_contrat = :id";

    $data['id'] = $id;

    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);

} else {

    $data['num_contrat'] = generateUniqueContractNumber($pdo);

    $columns = implode(", ", array_keys($data));
    $values = ":" . implode(", :", array_keys($data));

    $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
}

header("Location: contrats.php");
exit();
