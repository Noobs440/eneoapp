<?php
session_start();
require 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $telephone = $_POST['numero_telephone'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM user WHERE numero_telephone = ?");
    $stmt->execute([$telephone]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: indexDashboardUser.php");
        }
        exit;

    } else {
        $message = "Numéro ou mot de passe incorrect.";
    }
}
?>

<?php include 'navbar.php'; ?>
<html>
    <head>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <div class="login-container">
            <div class="connexion">Connexion</div>

            <form action="" method="post">
                <p class="text-1">N° de telephone</p>
                <input type="number" name="numero_telephone" placeholder="N° de telephone" required>
                <p class="text-1">Mot de passe</p>
                <input type="password" name="password" placeholder="Mot de passe" required>

                <button type="submit">Se connecter</button>

                <p class="forgot">
                    <a href="#">Mot de passe oublié ?</a>
                </p>
                <p class="signup">
                    Pas encore de compte ? <a href="register.php">S'inscrire</a>
                </p>
            </form>
        </div>
    </body>
</html>