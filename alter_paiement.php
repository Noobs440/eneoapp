<?php
require 'db.php';
$pdo->exec("ALTER TABLE paiement MODIFY num_facture VARCHAR(50) NOT NULL");
echo "alter done\n";