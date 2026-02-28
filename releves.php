<?php
session_start();
require 'db.php';

$stmtUser = $pdo->prepare("SELECT num_contrat FROM user WHERE id = ?");
$stmtUser->execute([$_SESSION['user_id']]);
$user = $stmtUser->fetch(PDO::FETCH_ASSOC);

$num_contrat = $user['num_contrat'];

// Combine consommation, releve, and factures
$stmt = $pdo->prepare("
    SELECT 
        c.mois,
        c.conso as consommation_actuelle,
        r.conso_precedente,
        r.difference,
        r.num_facture,
        f.montant,
        f.statut,
        f.date_limite
    FROM consommation c
    LEFT JOIN releve r ON c.num_contrat = r.num_contrat AND MONTH(c.mois) = MONTH(r.mois) AND YEAR(c.mois) = YEAR(r.mois)
    LEFT JOIN factures f ON r.num_facture = f.num_facture
    WHERE c.num_contrat = ?
    ORDER BY c.mois DESC
");
$stmt->execute([$num_contrat]);
$releves = $stmt->fetchAll(PDO::FETCH_ASSOC);

error_log("DEBUG releves.php: num_contrat=" . $num_contrat);
error_log("DEBUG releves.php: rows returned=" . count($releves));
if (count($releves) > 0) {
    error_log("DEBUG releves.php: first row=" . print_r($releves[0], true));
}
?>

<h2>Relevés de consommation</h2>

<table class="facture-table" cellpadding="10">
    <tr>
        <th>Mois</th>
        <th>Conso. Précédente (kWh)</th>
        <th>Conso. Actuelle (kWh)</th>
        <th>Différence (kWh)</th>
        <th>N° Facture</th>
        <th>Montant FCFA</th>
        <th>Statut</th>
        <th>Date Limite</th>
    </tr>

    <?php if (count($releves) > 0): ?>
        <?php foreach ($releves as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r['mois']) ?></td>
            <td><?= htmlspecialchars($r['conso_precedente'] ?? '–') ?></td>
            <td><?= htmlspecialchars($r['consommation_actuelle'] ?? '–') ?></td>
            <td><?= htmlspecialchars($r['difference'] ?? '–') ?></td>
            <td><?= htmlspecialchars($r['num_facture'] ?? '–') ?></td>
            <td><?= htmlspecialchars($r['montant'] ?? '–') ?></td>
            <td style="color: <?= ($r['statut'] === 'impayé' || $r['statut'] === 'Impayé') ? 'red' : 'green' ?>; font-weight: bold;">
                <?= htmlspecialchars($r['statut'] ?? '–') ?>
            </td>
            <td><?= htmlspecialchars($r['date_limite'] ?? '–') ?></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="8">Aucun relevé de consommation disponible</td>
        </tr>
    <?php endif; ?>
</table>
