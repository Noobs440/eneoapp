<?php
$title = "Gestion des factures";
$addLink = "add-facture.php";
$editLink = "edit-facture.php";
$deleteLink = "delete-facture.php";
$primaryKey = "num_facture";

$columns = ["N° de facture", "N° de contrat", "Mois", "Consommation", "Montant", "Statut", "Date limite de paiement"];

include '../db.php';

$sql = "SELECT * FROM facture";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Factures</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'sidebar.php'; ?>
<?php include 'table-template.php'; ?>

</body>
</html>
