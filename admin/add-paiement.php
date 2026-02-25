<?php
$title = "Ajouter un paiement";
$action = "save-paiement.php";
$cancelLink = "paiements.php";
$id = null;

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

$values = [];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ajouter une facture</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'sidebar.php'; ?>
<?php include 'form-template.php'; ?>

</body>
</html>
