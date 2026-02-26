<?php
session_start();
require 'db.php';

$stmtUser = $pdo->prepare("SELECT num_contrat FROM user WHERE id = ?");
$stmtUser->execute([$_SESSION['user_id']]);
$user = $stmtUser->fetch(PDO::FETCH_ASSOC);

$num_contrat = $user['num_contrat'];

$stmt = $pdo->prepare("
    SELECT mois, montant, statut, date_limite,
           consommation, num_facture
    FROM factures
    WHERE num_contrat = ?
");
$stmt->execute([$num_contrat]);
$facture = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Factures des 12 derniers mois</h2>

<table class="facture-table" cellpadding="10">
    <tr>
        <th>Mois</th>
        <th>Montant TTC</th>
        <th>Statut</th>
        <th>Date Limite</th>
        <th>Conso.</th>
        <th>N° Facture</th>
        <th>Voir</th>
        <th>Paiement</th>
    </tr>

    <?php foreach ($facture as $f): ?>
    <tr>
        <td><?= htmlspecialchars($f['mois']) ?></td>
        <td><?= htmlspecialchars($f['montant']) ?> FCFA</td>
        <td><?= htmlspecialchars($f['statut']) ?></td>
        <td><?= htmlspecialchars($f['date_limite']) ?></td>
        <td><?= htmlspecialchars($f['consommation']) ?> kWh</td>
        <td><?= htmlspecialchars($f['num_facture']) ?></td>
        <td><a href="#">Voir</a></td>
        <td><a href="#" class="payer">Payer</a></td>
    </tr>
    <?php endforeach; ?>
</table>
