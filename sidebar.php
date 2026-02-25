<div class="sidebar">

    <div class="profile">
        <div class="avatar">
            <img src="images/user.png" alt="Profil">
        </div>
        <h3 class="username"><?= $_SESSION['username'] ?></h3>
    </div>

    <ul class="menu">
        <li>
            <a href="/eneoapp/userdashboard.php?page=dashboard"
               class="<?= ($_GET['page'] ?? 'dashboard') === 'dashboard' ? 'active' : '' ?>">
               Tableau de bord
            </a>
        </li>

        <li>
            <a href="/eneoapp/userdashboard.php?page=factures"
               class="<?= ($_GET['page'] ?? '') === 'factures' ? 'active' : '' ?>">
               Factures
            </a>
        </li>

        <li>
            <a href="/eneoapp/userdashboard.php?page=consommation">Consommation</a>
        </li>

        <li>
            <a href="/eneoapp/userdashboard.php?page=profil">Mon profil</a>
        </li>
    </ul>
</div>
