<?php
include '../db.php';

if (!isset($_GET['id'])) {
    die("ID de consommation manquant");
}

$id = $_GET['id'];

$sql = "SELECT * FROM consommation WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Consommation introuvable");
}

$title = "Modifier une consommation";
$action = "save-consommation.php";
$cancelLink = "consommations.php";

$fields = [
    "id" => [
        "label" => "ID",
        "type" => "text"
    ],
    "num_contrat" => [
        "label" => "N° de contrat",
        "type" => "text"
    ],
    "mois" => [
        "label" => "Mois",
        "type" => "date",
    ],
    "conso" => [
        "label" => "Consommation",
        "type" => "text"
    ],
];

$values = $user;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modifier consommation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'sidebar.php'; ?>
<?php include 'form-template.php'; ?>

</body>
</html>
