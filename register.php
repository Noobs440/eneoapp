<?php
require 'db.php';

$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $numero_telephone = $_POST['numero_telephone'] ?? '';
    $num_contrat = $_POST['num_contrat'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validation des champs
    if (empty($numero_telephone)) {
        $errors['numero_telephone'] = "Le numéro de téléphone est requis";
    }

    if (empty($num_contrat)) {
        $errors['num_contrat'] = "Le numéro de contrat est requis";
    }

    if (empty($password)) {
        $errors['password'] = "Le mot de passe est requis";
    }

    if (empty($confirm_password)) {
        $errors['confirm_password'] = "Veuillez confirmer votre mot de passe";
    }

    if (!empty($password) && !empty($confirm_password) && $password !== $confirm_password) {
        $errors['confirm_password'] = "Les mots de passe ne correspondent pas";
    }

    // Si pas d'erreurs de validation, continuer les vérifications
    if (empty($errors)) {
        $stmtContrat = $pdo->prepare(
            "SELECT 1 FROM contrat WHERE num_contrat = ?"
        );
        $stmtContrat->execute([$num_contrat]);

        if ($stmtContrat->rowCount() === 0) {
            $errors['num_contrat'] = "Ce numéro de contrat n'existe pas";
        } else {
            $stmtUser = $pdo->prepare(
                "SELECT 1 FROM user WHERE num_contrat = ?"
            );
            $stmtUser->execute([$num_contrat]);

            if ($stmtUser->rowCount() > 0) {
                $errors['num_contrat'] = "Ce contrat est déjà associé à un compte";
            }
        }

        // Si toujours pas d'erreurs, insérer le nouvel utilisateur
        if (empty($errors)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO user (numero_telephone, password, num_contrat)
                    VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);

            $stmt->execute([$numero_telephone, $hashedPassword, $num_contrat]);

            $success = true;
        }
    }
}
?>



<?php include 'navbar.php'; ?>
<html>
    <head>
        <link rel="stylesheet" href="register.css">
        <link rel="stylesheet" href="navbar.css">
    </head>
    <body>
        <div class="register-wrapper">
            <div class="register-container">
            <div class="inscription">Inscription</div>

            <?php if ($success) : ?>
                <div class="success-message">Inscription réussie ! Redirection...</div>
                <script>
                    setTimeout(() => {
                        window.location.href = 'login.php';
                    }, 2000);
                </script>
            <?php else : ?>
                <form action="" method="post">
                    <p class="text-1">N° de téléphone</p>
                    <input type="number" name="numero_telephone" placeholder="6________" value="<?= htmlspecialchars($_POST['numero_telephone'] ?? '') ?>">
                    <?php if (isset($errors['numero_telephone'])) : ?>
                        <span class="error-message"><?= $errors['numero_telephone'] ?></span>
                    <?php endif; ?>

                    <p class="text-1">N° de contrat</p>
                    <input type="text" name="num_contrat" placeholder="________" value="<?= htmlspecialchars($_POST['num_contrat'] ?? '') ?>">
                    <?php if (isset($errors['num_contrat'])) : ?>
                        <span class="error-message"><?= $errors['num_contrat'] ?></span>
                    <?php endif; ?>

                    <p class="text-1">Mot de passe</p>
                    <input type="password" name="password" required>
                    <?php if (isset($errors['password'])) : ?>
                        <span class="error-message"><?= $errors['password'] ?></span>
                    <?php endif; ?>

                    <p class="text-1">Confirmer Mot de passe</p>
                    <input type="password" name="confirm_password" required>
                    <?php if (isset($errors['confirm_password'])) : ?>
                        <span class="error-message"><?= $errors['confirm_password'] ?></span>
                    <?php endif; ?>

                    <button type="submit">S'inscrire</button>
                    <p class="text-1">Deja inscrit ? <a href="login.php">Connectez-vous</a></p>
                </form>
            <?php endif; ?>
            </div>
            <div class="register-video">
                <video width="400" height="500" controls>
                    <source src="eneo_spot.mp4" type="video/mp4">
                    Votre navigateur ne supporte pas la balise vidéo.
                </video>
            </div>
        </div>
    </body>
</html>