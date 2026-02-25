<?php
session_start();
$adminName = $_SESSION['admin_name'] ?? 'Administrateur';
?>

<div class="sidebar">
    <div class="sidebar-top">
        <div class="avatar">
            <img src="assets/admin.png" alt="Admin">
        </div>
    </div>
    <ul class="menu">
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
