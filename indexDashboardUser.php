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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="indexDashboardUser.css">
    <link rel="stylesheet" href="factures.css">
    <link rel="stylesheet" href="responsive.css">
</head>

<script>
function loadContent(page) {
    fetch(page)
        .then(response => response.text())
        .then(data => {
            document.getElementById("content").innerHTML = data;
            document.getElementById("content").querySelectorAll("script").forEach(function(oldScript) {
                const newScript = document.createElement("script");
                newScript.textContent = oldScript.textContent;
                document.body.appendChild(newScript);
            });
        })
        .catch(error => {
            document.getElementById("content").innerHTML = "Erreur de chargement";
        });
}
</script>
<body>

<div class="description_user">
    <div>
        <span>Bienvenue</span>
        <strong><?= htmlspecialchars($user['nom_abonne']) ?></strong>
    </div>
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

<!-- MODAL dans indexDashboardUser.php -->
<div id="modal-facture" class="modal-overlay" style="display:none;">
    <div class="modal-content">
        <button class="modal-close" onclick="fermerModal()">✕</button>

        <div class="facture-header">
            <div class="facture-logo">
                <img src="eneo_logo.png" alt="ENEO" width="80">
                <h2>ENEO Cameroun</h2>
            </div>
            <div class="facture-ref">
                <h3 id="m-num-facture"></h3>
                <p>Date limite : <strong id="m-date-limite"></strong></p>
                <p>Statut : <strong id="m-statut"></strong></p>
            </div>
        </div>

        <hr>

        <div class="facture-abonne">
            <p><strong>Abonné :</strong> <span id="m-nom"></span></p>
            <p><strong>N° Contrat :</strong> <span id="m-contrat"></span></p>
            <p><strong>Quartier :</strong> <span id="m-quartier"></span></p>
            <p><strong>Période :</strong> <span id="m-mois"></span></p>
        </div>

        <hr>

        <table class="facture-detail-table">
            <tr>
                <th>Désignation</th>
                <th>Valeur</th>
            </tr>
            <tr>
                <td>Consommation</td>
                <td><span id="m-conso"></span> kWh</td>
            </tr>
            <tr>
                <td>Prix unitaire</td>
                <td>100 FCFA/kWh</td>
            </tr>
            <tr class="total-row">
                <td><strong>Montant TTC</strong></td>
                <td><strong><span id="m-montant"></span> FCFA</strong></td>
            </tr>
        </table>

        <div class="facture-footer">
            <p>Merci de régler votre facture avant la date limite.</p>
            <button onclick="window.print()" class="btn-print">🖨️ Imprimer</button>
        </div>
    </div>
</div>

<script>
function fermerModal() {
    document.getElementById('modal-facture').style.display = 'none';
}

document.getElementById('modal-facture').addEventListener('click', function(e) {
    if (e.target === this) fermerModal();
});
</script>

</body>

</body>
</html>
