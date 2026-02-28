<?php
require 'db.php';
$stmt = $pdo->query('SELECT num_facture FROM factures LIMIT 10');
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($rows);
?>