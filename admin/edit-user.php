<?php
include '../db.php';

if (!isset($_GET['id'])) {
    die("ID utilisateur manquant");
}

$id = $_GET['id'];

$sql = "SELECT * FROM user WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Utilisateur introuvable");
}

$title = "Modifier un utilisateur";
$action = "save-user.php";
$cancelLink = "users.php";

$fields = [
    "numero_telephone" => [
        "label" => "Téléphone",
        "type" => "text",
        "minlength" => 9,
        "maxlength" => 9,
        "pattern" => "[0-9]{9}",
        "title" => "Le numéro doit contenir exactement 9 chiffres"
    ],
    "password" => [
        "label" => "Mot de passe",
        "type" => "password"
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
    ]
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
