<?php
include '../db.php';

if (!isset($_GET['num_recu'])) {
    die("N° de recu manquant");
}

$num_recu = $_GET['num_recu'];

$sql = "SELECT * FROM paiement WHERE num_recu = :num_recu";
$stmt = $pdo->prepare($sql);
$stmt->execute(['num_recu' => $num_recu]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Paiement introuvable");
}

$title = "Modifier un paiement";
$action = "save-paiement.php";
$cancelLink = "paiements.php";

$fields = [
    "date" => [
        "label" => "Date de paiement",
        "type" => "date"
    ],
    "num_contrat" => [
        "label" => "N° de contrat",
        "type" => "text"
    ],
    "num_recu" => [
        "label" => "N° de reçu",
        "type" => "text"
    ],
    "montant" => [
        "label" => "Montant payé",
        "type" => "text"
    ],
    "mode" => [
        "label" => "mode",
        "type" => "text"
    ],
    "montant" => [
        "label" => "Montant",
        "type" => "text"
    ],
    "agence" => [
        "label" => "Agence",
        "type" => "text"
    ],
    "mois" => [
        "label" => "Mois",
        "type" => "date",
    ],
    "num_facture" => [
        "label" => "N° de facture",
        "type" => "text"
    ],
    "montant_facture" => [
        "label" => "Montant de la facture",
        "type" => "text"
    ],
];

$values = $user;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier paiement</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="..\/responsive.css">
</head>
<body>

<?php include 'sidebar.php'; ?>
<?php include 'form-template.php'; ?>

</body>
</html>
