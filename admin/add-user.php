<?php
$title = "Ajouter un utilisateur";
$action = "save-user.php";
$cancelLink = "users.php";
$id = null;

$fields = [
    "numero_telephone" => [
        "label" => "Téléphone",
        "type" => "text",
        "minlength" => 9,
        "maxlength" => 9,
        "pattern" => "[0-9]{9}",
        "title" => "Le numéro doit contenir exactement 9 chiffres"
    ],
    "num_contrat" => [
        "label" => "N° de contrat",
        "type" => "text",
        "readonly" => true,
        "required" => false
    ],
    "role" => [
        "label" => "Rôle",
        "type" => "select",
        "options" => [
            "admin" => "Admin",
            "abonne" => "abonne"
        ]
    ],
    "password" => [
        "label" => "Mot de passe",
        "type" => "password"
    ]
];

$values = [];

// Prefill num_contrat when provided via GET (e.g. from contrats table)
if (isset($_GET['num_contrat'])) {
    $values['num_contrat'] = $_GET['num_contrat'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter utilisateur</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="..\/responsive.css">
</head>
<body>

<?php include 'sidebar.php'; ?>
<?php include 'form-template.php'; ?>

</body>
</html>
