<?php
$title = "Ajouter un contrat";
$action = "save-contrat.php";
$cancelLink = "contrats.php";
$id = null;

$fields = [
    "num_contrat" => [
        "label" => "N° de contrat",
        "type" => "text",
        "readonly" => true,
        "required" => false,
        "placeholder"=>"ce numero est généré automatiquement"
    ],
    "nom_abonne" => [
        "label" => "Nom de l'abonné",
        "type" => "text"
    ],
    "quartier" => [
        "label" => "Quartier",
        "type" => "text"
    ],
];

$values = [];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ajouter un contrat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'sidebar.php'; ?>
<?php include 'form-template.php'; ?>

</body>
</html>
