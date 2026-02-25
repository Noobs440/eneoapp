<div class="main-content">

    <!-- HEADER COMMUN -->
    <div class="dashboard-header">
        <h2>Mon espace – <span>Mon profil</span></h2>

        <div class="header-profile">
            <img src="images/user.png" alt="Profil">
            <a href="user_dashboard.php?page=profil">Mon profil</a>
            <a href="logout.php" class="logout-btn">Déconnexion</a>
        </div>
    </div>

    <!-- TITRE -->
    <h1 class="page-title">Mon profil</h1>
    <p>Gérez vos informations personnelles et de contact.</p>

    <!-- FORMULAIRE -->
    <div class="card profile-card">

        <form action="update_profile.php" method="POST" enctype="multipart/form-data">

            <!-- Photo de profil -->
            <div class="form-group">
                <label>Photo de profil</label><br>
                <img src="images/user.png" alt="Photo de profil" class="profile-img"><br>
                <input type="file" name="profile_image">
            </div>

            <!-- Nom -->
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="name" value="<?= $_SESSION['username'] ?>" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= $_SESSION['email'] ?>" required>
            </div>

            <!-- Boutons -->
            <div class="form-actions">
                <button type="submit" class="btn save">Enregistrer</button>
                <a href="change_password.php" class="btn change-pass">Changer le mot de passe</a>
            </div>

        </form>

    </div>

</div>
<div class="main-content">

    <!-- HEADER COMMUN -->
    <div class="dashboard-header">
        <h2>Mon espace – <span>Mon profil</span></h2>

        <div class="header-profile">
            <img src="images/user.png" alt="Profil">
            <a href="user_dashboard.php?page=profil">Mon profil</a>
        </div>
    </div>

    <!-- TITRE -->
    <h1 class="page-title">Mon profil</h1>
    <p>Gérez vos informations personnelles et de contact.</p>

    <!-- FORMULAIRE -->
    <div class="card profile-card">

        <form action="update_profile.php" method="POST" enctype="multipart/form-data">

            <!-- Photo de profil -->
            <div class="form-group">
                <label>Photo de profil</label><br>
                <img src="images/user.png" alt="Photo de profil" class="profile-img"><br>
                <input type="file" name="profile_image">
            </div>

            <!-- Nom -->
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="name" value="<?= $_SESSION['username'] ?>" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= $_SESSION['email'] ?>" required>
            </div>

            <!-- Boutons -->
            <div class="form-actions">
                <button type="submit" class="btn save">Enregistrer</button>
                <a href="change_password.php" class="btn change-pass">Changer le mot de passe</a>
            </div>

        </form>

    </div>

</div>
