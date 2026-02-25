<?php
$title = "Gestion des paiements";
$addLink = "add-paiement.php";
$editLink = "edit-paiement.php";
$deleteLink = "delete-paiement.php";
$primaryKey = "num_recu";

$columns = ["Date", "N° de contrat", "N° de recu", "Montant", "Mode de paiement", "Agence", "Mois", "N° de facture", "Montant de la facture"];

include '../db.php';

$sql = "SELECT * FROM paiement";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Paiements</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'sidebar.php'; ?>
<?php include 'table-template.php'; ?>

</body>
</html>
