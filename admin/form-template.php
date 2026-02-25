<div class="content">
    <div class="form-container">
        <h2><?php echo $title; ?></h2>

        <form action="<?php echo $action; ?>" method="post">

            <?php if (!empty($id)): ?>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
            <?php endif; ?>

            <?php foreach ($fields as $name => $field): ?>
                <div class="form-group">
                    <label><?php echo $field['label']; ?></label>

                    <?php
                    $value = $values[$name] ?? '';
                    ?>

                    <?php if ($field['type'] == 'select'): ?>
                        <select name="<?php echo $name; ?>">
                            <?php foreach ($field['options'] as $optValue => $optLabel): ?>
                                <option value="<?php echo $optValue; ?>"
                                    <?php if ($value == $optValue) echo 'selected'; ?>>
                                    <?php echo $optLabel; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                <?php else: ?>
                    <input 
                        type="<?php echo $field['type']; ?>" 
                        name="<?php echo $name; ?>" 
                        value="<?php echo htmlspecialchars($value); ?>"
                        required
                        <?php
                        foreach ($field as $attr => $attrValue) {
                            if (!in_array($attr, ['label', 'type', 'options'])) {
                                echo $attr . '="' . $attrValue . '" ';
                            }
                        }
                        ?>
                    >
                <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <div class="form-actions">
                <button type="submit" class="btn-save">Enregistrer</button>
                <a href="<?php echo $cancelLink; ?>" class="btn-cancel">Annuler</a>
            </div>

        </form>
    </div>
</div>
