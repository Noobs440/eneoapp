<?php
require 'db.php';

// Check if releve table exists
$tables = $pdo->query("SHOW TABLES LIKE 'releve'")->fetchAll();
echo "<h3>Tables found:</h3>";
print_r($tables);

if (count($tables) > 0) {
    echo "<h3>Structure of releve table:</h3>";
    $struct = $pdo->query("DESCRIBE releve")->fetchAll(PDO::FETCH_ASSOC);
    print_r($struct);

    echo "<h3>Sample data (first 5 rows):</h3>";
    $data = $pdo->query("SELECT * FROM releve LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
    print_r($data);
} else {
    echo "Table releve does not exist!\n";
}
?>