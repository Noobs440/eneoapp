<?php
$title = "Gestion des consommations";
$addLink = "add-consommation.php";
$editLink = "edit-consommation.php";
$deleteLink = "delete-consommation.php";
$primaryKey = "id";
$showCreateFacture=true;


$columns = ["id", "N° de contrat", "Mois", "Consommation"];

include '../db.php';

$sql = "SELECT * FROM consommation";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Consommations</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'sidebar.php'; ?>
<?php include 'table-template.php'; ?>

</body>
</html>
