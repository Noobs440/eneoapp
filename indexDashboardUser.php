<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$sql = "
    SELECT 
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
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="indexDashboardUser.css">
    <link rel="stylesheet" href="factures.css">
</head>

<script>
function loadContent(page) {
    fetch(page)
        .then(response => response.text())
        .then(data => {
            document.getElementById("content").innerHTML = data;
        })
        .catch(error => {
            document.getElementById("content").innerHTML = 
                "Erreur de chargement";
        });
}
</script>
<body>

<div class="description_user">
    <div>Bienvenue
    <strong></strong> <?= htmlspecialchars($user['nom_abonne']) ?>
    <strong></div>

    <a href="logout.php" class="logout">Déconnexion</a>
</div>

<div class="cards-container">
    <div class="card"></div>
    <div class="card"></div>
    <div class="card"></div>
</div>

<div class="user-menu">
    <a href="#" onclick="loadContent('factures.php')">Factures</a>
    <a href="#" onclick="loadContent('paiements.php')">Paiements</a>
    <a href="#" onclick="loadContent('impayes.php')">Impayés</a>
    <a href="#" onclick="loadContent('releves.php')">Relèves</a>
</div>
    <div id="content"></div>

</body>
</html>
