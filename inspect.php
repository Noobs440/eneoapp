<?php
require 'db.php';

$stmt = $pdo->query("DESCRIBE paiement");
$cols = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo '<pre>'.print_r($cols, true).'</pre>';