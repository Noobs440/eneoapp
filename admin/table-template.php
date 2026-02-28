<div class="content">
    <div class="table-container">
        
        <div class="table-header">
            <h2><?php echo $title; ?></h2>
            <a href="<?php echo $addLink; ?>" class="btn-add">+ Ajouter</a>
        </div>

        <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <?php foreach ($columns as $col): ?>
                        <th><?php echo $col; ?></th>
                    <?php endforeach; ?>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <?php foreach ($row as $key => $cell): ?>
                            <td><?php echo htmlspecialchars($cell); ?></td>
                        <?php endforeach; ?>

                        <td class="actions">
                             <a href="<?php echo $editLink; ?>?<?php echo $primaryKey; ?>=<?php echo $row[$primaryKey]; ?>" 
                            class="btn-edit">
                                Modifier
                            </a>

                            <a href="<?php echo $deleteLink; ?>?<?php echo $primaryKey; ?>=<?php echo $row[$primaryKey]; ?>" 
                            class="btn-delete"
                            onclick="return confirm('Supprimer cet élément definitivement ?')">
                                Supprimer
                            </a>

                            <?php
                            $canCreateFacture = false;
                            if (!empty($showCreateFacture) && isset($row['num_contrat']) && isset($row['mois'])) {
                                $key = $row['num_contrat'] . '|' . $row['mois'];
                                if (empty($factureLinked[$key])) {
                                    $canCreateFacture = true;
                                }
                            }
                            ?>
                            <?php if ($canCreateFacture): ?>
                            <a href="add-facture.php?
                                num_contrat=<?php echo urlencode($row['num_contrat']); ?>&
                                mois=<?php echo urlencode($row['mois']); ?>&
                                conso=<?php echo urlencode($row['conso']); ?>"
                                class="btn-add">
                                Créer facture
                            </a>
                            <?php endif; ?>

                            <?php if (!empty($showCreateUser) && empty($userLinked[$row[$primaryKey]])): ?>
                            <a href="add-user.php?num_contrat=<?php echo urlencode($row['num_contrat']); ?>"
                                class="btn-add">
                                Créer un utilisateur
                            </a>
                            <?php endif; ?>

                                                </td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($rows)): ?>
                    <tr>
                        <td colspan="<?php echo count($columns) + 1; ?>">
                            Aucun enregistrement trouvé
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>

    </div>
</div>
