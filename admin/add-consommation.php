<?php
$title = "Ajouter une consommation";
$action = "save-consommation.php";
$cancelLink = "consommations.php";
$id = null;

$fields = [
    "id" => [
        "label" => "ID",
        "type" => "text",
        "readonly"=>true,
        "required"=>false
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

$values = [];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ajouter une consommation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'sidebar.php'; ?>
<?php include 'form-template.php'; ?>

</body>
</html>
