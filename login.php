<?php
session_start();
require 'db.php';

$message = "";
if (isset($_SESSION['login_error'])) {
    $message = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}
function login_debug($text) {
    $file = __DIR__ . '/login_debug.log';
    $when = date('Y-m-d H:i:s');
    $id = session_id();
    @file_put_contents($file, "[$when] [SID:$id] $text\n", FILE_APPEND);
}

login_debug("REQUEST_METHOD=" . ($_SERVER['REQUEST_METHOD'] ?? 'NULL') . ", has_login_error=" . (isset($message) ? 'yes' : 'no') . ", SID=" . session_id());

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
        // Store error in session and redirect to avoid POST re-submission issues
        $_SESSION['login_error'] = "Mot de passe ou numéro de téléphone incorrect.";
        $logfile = __DIR__ . '/login_trace.txt';
        file_put_contents($logfile, "[POST FAIL] SID=" . session_id() . " Error set at " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
        header("Location: login.php");
        exit;
    }
}
?>

<html>
    <head>
        <link rel="stylesheet" href="login.css">
        <link rel="stylesheet" href="navbar.css">
    </head>
    <body>
        <?php include 'navbar.php'; ?>
        <div class="login-container">
            <div class="connexion">Connexion</div>
            <form action="login.php" method="post">
                <p class="text-1">N° de telephone</p>
                <input type="number" name="numero_telephone" placeholder="N° de telephone" required>
                <p class="text-1">Mot de passe</p>
                <input type="password" name="password" placeholder="Mot de passe" required>

                <button type="submit">Se connecter</button><br><br>
                 <?php if (!empty($message)): ?>
                <div class="error-message"><?php echo htmlspecialchars($message); ?></div>
                <?php endif; ?><br>
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