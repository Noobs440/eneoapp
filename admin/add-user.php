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
        "type" => "text"
    ],
    "role" => [
        "label" => "Rôle",
        "type" => "select",
        "options" => [
            "admin" => "Admin",
            "client" => "Client"
        ]
    ],
    "password" => [
        "label" => "Mot de passe",
        "type" => "password"
    ]
];

$values = [];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ajouter utilisateur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'sidebar.php'; ?>
<?php include 'form-template.php'; ?>

</body>
</html>
