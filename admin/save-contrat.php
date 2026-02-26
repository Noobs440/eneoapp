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
// Determine if this is an update (original id passed as 'id') or an insert
$original = $data['id'] ?? null;

if ($original) {
    // Updating an existing contract. $data contains fields including possibly a new num_contrat.
    $newNum = $data['num_contrat'] ?? $original;

    // Build SET clause from posted fields (including num_contrat if present)
    $set = [];
    $params = [];
    foreach ($data as $key => $value) {
        if ($key === 'id') continue; // original id
        $set[] = "$key = :$key";
        $params[$key] = $value;
    }

    // Execute inside a transaction so updates to contrat and user stay consistent
    try {
        $pdo->beginTransaction();

        $sql = "UPDATE $table SET " . implode(", ", $set) . " WHERE num_contrat = :original";
        $params['original'] = $original;
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        // If contract number changed, propagate to user table
        if ($newNum !== $original) {
            $stmtUser = $pdo->prepare('UPDATE user SET num_contrat = :new WHERE num_contrat = :original');
            $stmtUser->execute(['new' => $newNum, 'original' => $original]);
        }

        $pdo->commit();
    } catch (Exception $e) {
        if ($pdo->inTransaction()) $pdo->rollBack();
        error_log('Error updating contract: ' . $e->getMessage());
    }

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
