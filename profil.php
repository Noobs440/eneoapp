<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$sql = "
    SELECT 
        u.numero_telephone,
        u.num_contrat,
        c.nom_abonne,
        c.quartier
    FROM user u
    JOIN contrat c ON u.num_contrat = c.num_contrat
    WHERE u.id = ?
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<?php include 'navbar.php'; ?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="profil.css">
    <link rel="stylesheet" href="responsive.css">
</head>
<body>

<div class="profil-container">
    <h2>Modifier mon profil</h2>

    <form action="update_profil.php" method="post">
        
        <label>Nom de l’abonné</label>
        <input type="text" value="<?= htmlspecialchars($user['nom_abonne']) ?>" disabled>

        <label>Quartier</label>
        <input type="text" value="<?= htmlspecialchars($user['quartier']) ?>" disabled>

        <label>Numéro de téléphone</label>
        <input type="text" name="numero_telephone"
               value="<?= htmlspecialchars($user['numero_telephone']) ?>" required>

        <button type="submit">Enregistrer les modifications</button>
    </form>
</div>

</body>
</html>
