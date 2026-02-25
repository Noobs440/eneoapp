<?php
include '../db.php';

if (!isset($_GET['num_contrat'])) {
    die("N° de contrat manquant");
}

$num_contrat = $_GET['num_contrat'];

$sql = "SELECT * FROM contrat WHERE num_contrat = :num_contrat";
$stmt = $pdo->prepare($sql);
$stmt->execute(['num_contrat' => $num_contrat]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Contrat introuvable");
}

$title = "Modifier un contrat";
$action = "save-contrat.php";
$cancelLink = "contrats.php";

$fields = [
    "num_contrat" => [
        "label" => "N° de contrat",
        "type" => "text",
        "readonly"=>true
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

$values = $user;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modifier contrat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'sidebar.php'; ?>
<?php include 'form-template.php'; ?>

</body>
</html>
