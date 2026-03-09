<?php
session_start();
require 'db.php';

$stmtUser = $pdo->prepare("SELECT num_contrat FROM user WHERE id = ?");
$stmtUser->execute([$_SESSION['user_id']]);
$user = $stmtUser->fetch(PDO::FETCH_ASSOC);
$num_contrat = $user['num_contrat'];

// Infos abonné
$stmtContrat = $pdo->prepare("SELECT * FROM contrat WHERE num_contrat = ?");
$stmtContrat->execute([$num_contrat]);
$contrat = $stmtContrat->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("
    SELECT mois, montant, statut, date_limite, consommation, num_facture
    FROM factures
    WHERE num_contrat = ?
    ORDER BY mois DESC
");
$stmt->execute([$num_contrat]);
$factures = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Factures</h2>

<table class="facture-table" cellpadding="10">
    <tr>
        <th>Mois</th>
        <th>Montant TTC</th>
        <th>Statut</th>
        <th>Date Limite</th>
        <th>Conso.</th>
        <th>N° Facture</th>
        <th>Voir</th>
        <th>Paiement</th>
    </tr>

    <?php foreach ($factures as $f): ?>
    <tr>
        <td><?= htmlspecialchars($f['mois']) ?></td>
        <td><?= number_format($f['montant'], 0, ',', ' ') ?> FCFA</td>
        <td><?= htmlspecialchars($f['statut']) ?></td>
        <td><?= htmlspecialchars($f['date_limite']) ?></td>
        <td><?= htmlspecialchars($f['consommation']) ?> kWh</td>
        <td><?= htmlspecialchars($f['num_facture']) ?></td>
        <td>
            <a href="#" class="voir-facture"
               data-num="<?= htmlspecialchars($f['num_facture']) ?>"
               data-mois="<?= htmlspecialchars($f['mois']) ?>"
               data-montant="<?= $f['montant'] ?>"
               data-statut="<?= htmlspecialchars($f['statut']) ?>"
               data-limite="<?= htmlspecialchars($f['date_limite']) ?>"
               data-conso="<?= htmlspecialchars($f['consommation']) ?>"
               data-contrat="<?= htmlspecialchars($num_contrat) ?>"
               data-nom="<?= htmlspecialchars($contrat['nom_abonne']) ?>"
               data-quartier="<?= htmlspecialchars($contrat['quartier']) ?>">
               Voir
            </a>
        </td>
        <td>
            <?php
            $statut = mb_strtolower(trim($f['statut']));
            if (in_array($statut, ['payé','paye','paid'])):
                // find the latest paiement for this facture
                $stmtRec = $pdo->prepare("SELECT num_recu FROM paiement WHERE num_facture = ? ORDER BY date DESC LIMIT 1");
                $stmtRec->execute([$f['num_facture']]);
                $rec = $stmtRec->fetch(PDO::FETCH_ASSOC);
                if ($rec):
            ?>
                <a href="recu.php?num_recu=<?= urlencode($rec['num_recu']) ?>" target="_blank">Voir reçu</a>
            <?php else: ?>
                <span>Payé</span>
            <?php endif; else: ?>
                <a href="#" class="payer"
                   data-num="<?= htmlspecialchars($f['num_facture']) ?>"
                   data-mois="<?= htmlspecialchars($f['mois']) ?>"
                   data-montant="<?= $f['montant'] ?>"
                   data-montant-facture="<?= $f['montant'] ?>"
                   data-contrat="<?= htmlspecialchars($num_contrat) ?>"
                >Payer</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php
// payment endpoint set in PHP so it can change when you turn off the sandbox flag
$paymentEndpoint = 'save-paiement.php';
?>
<script>
// expose endpoint to JavaScript
var paymentEndpoint = <?= json_encode($paymentEndpoint) ?>;

document.querySelectorAll('.voir-facture').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('m-num-facture').textContent  = this.dataset.num;
        document.getElementById('m-mois').textContent         = this.dataset.mois;
        document.getElementById('m-montant').textContent      = parseInt(this.dataset.montant).toLocaleString('fr-FR');
        document.getElementById('m-statut').textContent       = this.dataset.statut;
        document.getElementById('m-date-limite').textContent  = this.dataset.limite;
        document.getElementById('m-conso').textContent        = this.dataset.conso;
        document.getElementById('m-contrat').textContent      = this.dataset.contrat;
        document.getElementById('m-nom').textContent          = this.dataset.nom;
        document.getElementById('m-quartier').textContent     = this.dataset.quartier;
        document.getElementById('modal-facture').style.display = 'flex';
    });
});
</script>

<!-- Modal paiement simulation Orange Money -->
<div id="modal-paiement" class="modal-overlay" style="display:none;">
    <div class="modal-content">
        <button class="modal-close" onclick="fermerModalPaiement()">✕</button>
        <h3>Simuler paiement</h3>
        <p>Facture N°: <strong id="p-num"></strong></p>
        <p>Mois: <strong id="p-mois"></strong></p>
        <p>Montant: <strong id="p-montant-display"></strong> FCFA</p>

        <div class="payment-methods">
            <input type="radio" name="p-mode" id="p-mode-om" value="Orange Money" checked>
            <label for="p-mode-om"><img src="om-placeholder.png" alt="Orange Money"></label>

            <input type="radio" name="p-mode" id="p-mode-mm" value="Mobile Money">
            <label for="p-mode-mm"><img src="mm-placeholder.png" alt="Mobile Money"></label>
        </div>

        <label>Numéro</label>
        <input type="text" id="p-phone" placeholder="6XXXXXXXX" style="width:100%;padding:8px;margin:6px 0;margin-bottom:12px;" />

        <button id="p-simulate" class="btn-print">Payer</button>
        <div id="p-status" style="margin-top:12px;color:green;display:none;"></div>
    </div>
</div>

<script>
function fermerModalPaiement() {
    document.getElementById('modal-paiement').style.display = 'none';
}

document.getElementById('modal-paiement').addEventListener('click', function(e) {
    if (e.target === this) fermerModalPaiement();
});

document.querySelectorAll('.payer').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        var num = this.dataset.num;
        var mois = this.dataset.mois;
        var montant = this.dataset.montant;
        var contrat = this.dataset.contrat;
+        console.log('paiement modal — num_facture', num, 'contrat', contrat, 'montant', montant);

        document.getElementById('p-num').textContent = num;
        document.getElementById('p-mois').textContent = mois;
        document.getElementById('p-montant-display').textContent = parseInt(montant).toLocaleString('fr-FR');
        document.getElementById('p-phone').value = '';
        document.getElementById('p-status').style.display = 'none';
        document.getElementById('modal-paiement').style.display = 'flex';

        document.getElementById('p-simulate').onclick = function() {
            var phone = document.getElementById('p-phone').value.trim();
            if (!phone.match(/^[0-9]{8,12}$/)) {
                alert('Entrez un numéro Orange Money valide.');
                return;
            }
            // show processing
            var btn = this;
            btn.disabled = true;
            btn.textContent = 'Traitement...';

            // simulate network/OTP delay
            setTimeout(function(){
                // call server to process paiement (sandbox or real depending on config)
                var mode = document.querySelector('input[name=p-mode]:checked').value;
                fetch(paymentEndpoint, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        num_facture: num,
                        num_contrat: contrat,
                        montant: montant,
                        phone: phone,
                        mois: mois,
                        mode: mode
                    })
                }).then(function(resp){ return resp.json(); })
                .then(function(data){
                    if (data.success) {
                        document.getElementById('p-status').style.display = 'block';
                        document.getElementById('p-status').textContent = 'Paiement simulé avec succès. Reçu: ' + data.num_recu;
                        // update statut cell in the table for this invoice
                        document.querySelectorAll('tr').forEach(function(row){
                            if (row.querySelector && row.querySelector('td:nth-child(6)') && row.querySelector('td:nth-child(6)').textContent.trim() === num) {
                                var statutCell = row.querySelector('td:nth-child(3)');
                                if (statutCell) statutCell.textContent = 'payé';
                            }
                        });
                        btn.textContent = 'Simuler paiement';
                        btn.disabled = false;
                        setTimeout(function(){ fermerModalPaiement(); }, 10000);
                    } else {
                        alert('Erreur: ' + (data.message || 'échec du paiement'));
                        btn.textContent = 'Simuler paiement';
                        btn.disabled = false;
                    }
                }).catch(function(err){
                    alert('Erreur réseau');
                    btn.textContent = 'Simuler paiement';
                    btn.disabled = false;
                });

            }, 1000);
        };
    });
});
</script>