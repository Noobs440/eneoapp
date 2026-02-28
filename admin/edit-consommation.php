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
$form_error = '';
if (!empty($_SESSION['consommation_error'])) {
    $form_error = $_SESSION['consommation_error'];
    unset($_SESSION['consommation_error']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier Consommation</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="..\/responsive.css">
</head>
<body>

<?php include 'sidebar.php'; ?>
<?php include 'form-template.php'; ?>

</body>
</html>
