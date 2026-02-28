<?php
require 'db.php';

echo "<h3>Structure of consommation table:</h3>";
$struct = $pdo->query("DESCRIBE consommation")->fetchAll(PDO::FETCH_ASSOC);
print_r($struct);

echo "<h3>Sample data from consommation (first 5):</h3>";
$data = $pdo->query("SELECT * FROM consommation LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
print_r($data);
?>