<?php
$title = "Ajouter une facture";
$action = "save-facture-new.php";
$cancelLink = "factures.php";
$numContrat   = $_GET['num_contrat'] ?? '';
$mois         = $_GET['mois'] ?? '';
$conso = $_GET['conso'] ?? '';
$primary_key = 'num_facture';
$id = null;

$fields = [
    "num_facture" => [
        "label" => "N° de facture",
        "type" => "text",
        "readonly" => true,
        "required" => false,
        "disabled" => true
    ],
    "num_contrat" => [
        "label" => "N° de contrat",
        "type" => "text"
    ],
    "mois" => [
        "label" => "Mois",
        "type" => "date"
    ],
    "consommation" => [
        "label" => "Consommation",
        "type" => "text"
    ],
    "montant" => [
        "label" => "Montant",
        "type" => "text",
        "readonly" => true,
        "required" => false
    ],
    "statut" => [
        "label" => "Statut",
        "type" => "select",
        "options" => [
            "impayé" => "Impayé",
            "payé" => "Payé"
        ]
    ],
    "date_limite" => [
        "label" => "Date limite de paiement",
        "type" => "date"
    ],
];

$values = [
    "num_contrat" => $numContrat,
    "mois" => $mois,
    "consommation" => $conso
];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ajouter une facture</title>
    <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="responsive.css">
</head>
<body>

<?php include 'sidebar.php'; ?>
<?php include 'form-template.php'; ?>

</body>
</html>
