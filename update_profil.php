<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero_telephone = $_POST['numero_telephone'];

    $sql = "UPDATE user SET numero_telephone = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$numero_telephone, $_SESSION['user_id']]);

    header("Location: profil.php");
    exit;
}
?>
