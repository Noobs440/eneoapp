<?php

include '../db.php';
$table = "facture";
echo "Table utilisée : $table\n";
echo "Base connectée : " . $pdo->query("SELECT DATABASE()")->fetchColumn();
exit();

$data = $_POST;
$id = $data['num_facture'] ?? null;
unset($data['num_facture']);

if ($id) {

    $set = [];
    foreach ($data as $key => $value) {
        $set[] = "$key = :$key";
    }

    $sql = "UPDATE $table SET " . implode(", ", $set) . " WHERE num_facture = :num_facture";
    $data['num_facture'] = $id;

    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);

} else {
    $consommation = floatval($data['conso'] ?? 0);
    $data['montant'] = $consommation * 100;


    $sql = "SELECT num_facture FROM facture ORDER BY num_facture DESC LIMIT 1";
    $stmt = $pdo->query($sql);
    $last = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($last) {
        $num = intval(substr($last['num_facture'], 4)) + 1; 
    } else {
        $num = 1;
    }

    $numFacture = 'FAC-' . str_pad($num, 4, '0', STR_PAD_LEFT);
    $data['num_facture'] = $numFacture;

    $columns = implode(", ", array_keys($data));
    $values  = ":" . implode(", :", array_keys($data));

    $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
}

header("Location: factures.php");
exit();
