<?php
session_start();
require 'db.php';

$stmtUser = $pdo->prepare("SELECT num_contrat FROM user WHERE id = ?");
$stmtUser->execute([$_SESSION['user_id']]);
$user = $stmtUser->fetch(PDO::FETCH_ASSOC);

$num_contrat = $user['num_contrat'];
$stmt = $pdo->prepare("
    SELECT mois, conso_precedente, conso, difference,
        num_facture
    FROM releve
    WHERE num_contrat = ?
");
$stmt->execute([$num_contrat]);
$impayes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Relevés de consommation</h2>

<table class="facture-table" cellpadding="10">
    <tr>
        <th>Mois</th>
        <th>Conso. Précédente</th>
        <th>Conso. Actuelle</th>
        <th>Difference</th>
        <th>Facture associée</th>
    </tr>

    <?php if (count($impayes) > 0): ?>
        <?php foreach ($impayes as $f): ?>
        <tr>
            <td><?= htmlspecialchars($f['mois']) ?></td>
            <td><?= htmlspecialchars($f['conso_precedente']) ?> kWh</td>
            <td><?= htmlspecialchars($f['conso']) ?> kWh</td>
            <td><?= htmlspecialchars($f['difference']) ?> kWh</td>
            <td><?= htmlspecialchars($f['num_facture']) ?></td>
            <td><a href="#" class="payer">Payer</a></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7">Aucun relevé de consommation disponible</td>
        </tr>
    <?php endif; ?>
</table>
