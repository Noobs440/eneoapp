<?php
session_start();
require 'db.php';

$stmtUser = $pdo->prepare("SELECT num_contrat FROM user WHERE id = ?");
$stmtUser->execute([$_SESSION['user_id']]);
$user = $stmtUser->fetch(PDO::FETCH_ASSOC);

$num_contrat = $user['num_contrat'];

$stmt = $pdo->prepare("
    SELECT date, num_recu, montant, mode, agence, mois, num_facture,montant_facture
    FROM paiement
    WHERE num_contrat = ?
    ORDER BY date DESC
");
$stmt->execute([$num_contrat]);
$paiements = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Historique des paiements</h2>

<table class="facture-table" cellpadding="10">
    <tr>
        <th>Date</th>
        <th>N° Reçu</th>
        <th>Montant Paye</th>
        <th>Mode</th>
        <th>Agence</th>
        <th>N° facture</th>
        <th>Mois</th>
        <th>Montant Facture</th>

    </tr>

    <?php foreach ($paiements as $p): ?>
    <tr>
        <td><?= htmlspecialchars($p['date']) ?></td>
        <td><?= htmlspecialchars($p['num_recu']) ?></td>
        <td><?= htmlspecialchars($p['montant']) ?> FCFA</td>
        <td><?= htmlspecialchars($p['mode']) ?></td>
        <td><?= htmlspecialchars($p['agence']) ?></td>
        <td><?= htmlspecialchars($p['num_facture']) ?></td>
        <td><?= htmlspecialchars($p['mois']) ?></td>
        <td><?= htmlspecialchars($p['montant_facture']) ?> FCFA</td>

    </tr>
    <?php endforeach; ?>
</table>
