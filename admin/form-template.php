<div class="content">
    <div class="form-container">
        <h2><?php echo $title; ?></h2>

        <?php if (!empty($form_error)): ?>
            <div class="error-message"><?php echo htmlspecialchars($form_error); ?></div>
        <?php endif; ?>

        <form action="<?php echo $action; ?>" method="post">

            <?php if (!empty($id) && !empty($primary_key)): ?>
                <input type="hidden" name="<?php echo htmlspecialchars($primary_key); ?>" value="<?php echo htmlspecialchars($id); ?>">
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
                        <?php echo (!isset($field['disabled']) || !$field['disabled']) && (!isset($field['required']) || $field['required'] !== false) ? 'required' : ''; ?>
                        <?php
                        foreach ($field as $attr => $attrValue) {
                            if (!in_array($attr, ['label', 'type', 'options', 'required'])) {
                                if ($attrValue === true) {
                                    echo $attr . ' ';
                                } elseif ($attrValue !== false) {
                                    echo $attr . '="' . $attrValue . '" ';
                                }
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
