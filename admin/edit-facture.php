<?php
include '../db.php';

if (!isset($_GET['num_facture'])) {
    die("N° de facture manquant");
}

$num_facture = $_GET['num_facture'];
$primary_key = 'num_facture';

$sql = "SELECT * FROM factures WHERE num_facture = :num_facture";
$stmt = $pdo->prepare($sql);
$stmt->execute(['num_facture' => $num_facture]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Facture introuvable");
}

$id = $user['num_facture'];

$title = "Modifier une facture";
$action = "save-facture.php";
$cancelLink = "factures.php";

$fields = [
    "num_facture" => [
        "label" => "N° de facture",
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
    "consommation" => [
        "label" => "Consommation",
        "type" => "text"
    ],
    "montant" => [
        "label" => "Montant",
        "type" => "text"
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

$values = $user;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modifier utilisateur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'sidebar.php'; ?>
<?php include 'form-template.php'; ?>

</body>
</html>
