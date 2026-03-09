<?php
$host = "sql302.infinityfree.com";
$dbname = "if0_41345441_eneoappdb";
$user = "if0_41345441";
$pass = "ZDlX2giMTJ";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Erreur connexion : " . $e->getMessage());
}
