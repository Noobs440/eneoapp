<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $numero_telephone = $_POST['numero_telephone'];
    $num_contrat = $_POST['num_contrat'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "Les mots de passe ne correspondent pas";
        exit;
    }

    $stmtContrat = $pdo->prepare(
        "SELECT 1 FROM contrat WHERE num_contrat = ?"
    );
    $stmtContrat->execute([$num_contrat]);

    if ($stmtContrat->rowCount() === 0) {
        echo "Ce numéro de contrat n'existe pas";
        exit;
    }

    $stmtUser = $pdo->prepare(
        "SELECT 1 FROM user WHERE num_contrat = ?"
    );
    $stmtUser->execute([$num_contrat]);

    if ($stmtUser->rowCount() > 0) {
        echo "Ce contrat est déjà associé à un compte";
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (numero_telephone, password, num_contrat)
            VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$numero_telephone, $hashedPassword, $num_contrat]);

    echo "Inscription réussie";
}
?>



<?php include 'navbar.php'; ?>
<html>
    <head>
        <link rel="stylesheet" href="register.css">
    </head>
    <body>
        <div class="register-container">
            <div class="inscription">Inscription</div>

            <form action="" method="post">
                <p class="text-1">N° de téléphone</p>
                <input type="number" name="numero_telephone" placeholder="6________" required>

                <p class="text-1">N° de contrat</p>
                <input type="text" name="num_contrat" placeholder="________" required>

                <p class="text-1">Mot de passe</p>
                <input type="password" name="password" required>

                <p class="text-1">Confirmer Mot de passe</p>
                <input type="password" name="confirm_password" required>

                <button type="submit">S'inscrire</button>
                <p class="text-1">Deja inscrit ? <a href="login.php">Connectez-vous</a></p>
            </form>
        </div>
    </body>
</html>