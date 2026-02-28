<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ancien = $_POST['ancien_password'];
    $nouveau = $_POST['nouveau_password'];
    $confirm = $_POST['confirm_password'];

    // Vérifier que les nouveaux mots de passe correspondent
    if ($nouveau !== $confirm) {
        $message = "Les nouveaux mots de passe ne correspondent pas.";
    } else {

        // Récupérer le mot de passe actuel
        $sql = "SELECT password FROM user WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier l'ancien mot de passe
        if (password_verify($ancien, $user['password'])) {

            // Hasher le nouveau mot de passe
            $newHash = password_hash($nouveau, PASSWORD_DEFAULT);

            // Mettre à jour
            $update = $pdo->prepare("UPDATE user SET password = ? WHERE id = ?");
            $update->execute([$newHash, $_SESSION['user_id']]);

            $message = "Mot de passe modifié avec succès.";
        } else {
            $message = "Ancien mot de passe incorrect.";
        }
    }
}
?>

<?php include 'navbar.php'; ?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="motdepasse.css">
    <link rel="stylesheet" href="responsive.css">
</head>
<body>

<div class="password-container">
    <h2>Modifier mon mot de passe</h2>

    <?php if ($message): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Ancien mot de passe</label>
        <input type="password" name="ancien_password" required>

        <label>Nouveau mot de passe</label>
        <input type="password" name="nouveau_password" required>

        <label>Confirmer le nouveau mot de passe</label>
        <input type="password" name="confirm_password" required>

        <button type="submit">Modifier le mot de passe</button>
    </form>
</div>

</body>
</html>
