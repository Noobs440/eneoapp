<?php
$title = "Gestion des contrats";
$addLink = "add-contrat.php";
$editLink = "edit-contrat.php";
$deleteLink = "delete-contrat.php";
$primaryKey = "num_contrat";


$columns = ["N° de contrat", "Nom de l'abonné", "Quartier"];

include '../db.php';

$sql = "SELECT * FROM contrat";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contrats</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'sidebar.php'; ?>
<?php include 'table-template.php'; ?>

</body>
</html>
