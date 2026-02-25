<div class="main-content">

    <div class="dashboard-header">
        <h2>Mon espace – <span>Factures</span></h2>

        <div class="header-profile">
            <img src="images/user.png">
            <a href="#">Mon profil</a>
            <a href="logout.php" class="logout-btn">Déconnexion</a>
        </div>
    </div>

    <h1 class="page-title">Mes factures</h1>

    <div class="card">
        <table class="facture-table">
            <thead>
                <tr>
                    <th>N° Facture</th>
                    <th>Période</th>
                    <th>Montant</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <!-- Facture payée -->
                <tr>
                    <td>FAC-001</td>
                    <td>Janvier 2025</td>
                    <td>15 000 FCFA</td>
                    <td class="paid">Payée</td>
                    <td class="actions">
                        <button class="btn view">Voir</button>
                        <button class="btn download">Télécharger</button>
                    </td>
                </tr>

                <!-- Facture impayée -->
                <tr>
                    <td>FAC-002</td>
                    <td>Février 2025</td>
                    <td>12 500 FCFA</td>
                    <td class="unpaid">Impayée</td>
                    <td class="actions">
                        <button class="btn view">Voir</button>
                        <button class="btn pay">Payer</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
