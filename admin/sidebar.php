<?php
session_start();

// Prevent caching so that browser 'back' won't show protected pages after logout
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

// Require that the user is logged in and has admin role
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Try to get a friendly name for the admin from the database if available
$adminName = 'Administrateur';
$dbPath = __DIR__ . '/../db.php';
if (file_exists($dbPath)) {
    require_once $dbPath;
    try {
        $stmt = $pdo->prepare('SELECT numero_telephone FROM user WHERE id = ?');
        $stmt->execute([$_SESSION['user_id']]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row && !empty($row['numero_telephone'])) {
            $adminName = $row['numero_telephone'];
        }
    } catch (Exception $e) {
        // If DB read fails, keep default admin name
    }
}
?>

<div class="sidebar">
    <div class="sidebar-top">
        <div class="avatar">
            <img src="assets/admin.png" alt="Admin">
        </div>
    </div>
    <ul class="menu">
        <li><a href="dashboard.php">Tableau de bord</a></li>
        <li><a href="users.php">Gestion des utilisateurs</a></li>
        <li><a href="factures.php">Gestion des factures</a></li>
        <li><a href="paiements.php">Gestion des paiements</a></li>
        <li><a href="contrats.php">Gestion des contrats</a></li>
        <li><a href="consommations.php">Gestion des consommations</a></li>
    </ul>

    <div class="sidebar-bottom">
        <div class="admin-name">
            <?php echo htmlspecialchars($adminName); ?>
        </div>

        <button class="logout-btn" onclick="confirmLogout()">
            Déconnexion
        </button>
    </div>
</div>

<script>
function confirmLogout() {
    if (confirm("Voulez-vous vraiment vous déconnecter ?")) {
        window.location.href = "../logout.php";
    }
}
</script>
