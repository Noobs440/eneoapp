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

$sql1 = "
    SELECT c.nom_abonne, c.quartier, u.num_contrat
    FROM user u
    JOIN contrat c ON u.num_contrat = c.num_contrat
    WHERE u.id = ?
";
$stmt = $pdo->prepare($sql1);
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Factures impayées
$sql2 = "
    SELECT COUNT(*) as nb_impayes, COALESCE(SUM(montant), 0) as total_impayes
    FROM factures
    WHERE num_contrat = ? AND statut = 'impayé'
";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute([$user['num_contrat']]);
$impayes = $stmt2->fetch(PDO::FETCH_ASSOC);

$nb_impayes    = $impayes['nb_impayes'];
$total_impayes = $impayes['total_impayes'];
$balance       = -$total_impayes; // négatif si impayés, 0 sinon

// Dernière facture
$sql3 = "
    SELECT mois, montant, statut
    FROM factures
    WHERE num_contrat = ?
    ORDER BY mois DESC
    LIMIT 1
";
$stmt3 = $pdo->prepare($sql3);
$stmt3->execute([$user['num_contrat']]);
$derniere = $stmt3->fetch(PDO::FETCH_ASSOC);
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

    <!-- Card 1 : Balance -->
    <div class="card <?= $balance < 0 ? 'card-danger' : 'card-success' ?>">
        <div class="card-icon"></div>
        <div class="card-title">Balance du compte</div>
        <div class="card-value">
            <?= number_format($balance, 0, ',', ' ') ?> FCFA
        </div>
        <div class="card-sub">
            <?= $balance < 0 ? 'Montant dû' : 'Compte à jour' ?>
        </div>
    </div>

    <!-- Card 2 : Factures impayées -->
    <div class="card <?= $nb_impayes > 0 ? 'card-danger' : 'card-success' ?>">
        <div class="card-icon"></div>
        <div class="card-value"><?= $nb_impayes ?> Factures impayées</div>
        <div class="card-sub">
            Total dû : <strong><?= number_format($total_impayes, 0, ',', ' ') ?> FCFA</strong>
        </div>
    </div>

    <!-- Card 3 : Dernière facture -->
    <div class="card card-neutral">
        <div class="card-icon"></div>
        <div class="card-title">Dernière facture</div>
        <?php if ($derniere): ?>
            <div class="card-value"><?= number_format($derniere['montant'], 0, ',', ' ') ?> FCFA</div>
            <div class="card-sub">
                <?= date('F Y', strtotime($derniere['mois'])) ?> —
                <span class="statut-<?= $derniere['statut'] ?>">
                    <?= ucfirst($derniere['statut']) ?>
                </span>
            </div>
        <?php else: ?>
            <div class="card-sub">Aucune facture</div>
        <?php endif; ?>
    </div>

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
