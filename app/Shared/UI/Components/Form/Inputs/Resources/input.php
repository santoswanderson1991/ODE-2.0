<?php

/** @var string|null $label */
/** @var string|null $help */
/** @var string|null $prefix */
/** @var string|null $suffix */
/** @var array $errors */
/** @var array $attributes */

?>

<div class="ode-field">

    <?php if (!empty($label)): ?>

        <label class="ode-label">

            <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>

        </label>

    <?php endif; ?>

    <div class="ode-input-group">

        <?php if ($prefix): ?>

            <span class="ode-input-prefix">

                <?= htmlspecialchars($prefix, ENT_QUOTES, 'UTF-8') ?>

            </span>

        <?php endif; ?>

        <input

            <?php foreach ($attributes as $attribute => $value): ?>

                <?php if ($value === true): ?>

                    <?= htmlspecialchars($attribute) ?>

                <?php elseif ($value !== false && $value !== null): ?>

                    <?= htmlspecialchars($attribute) ?>="<?= htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8') ?>"

                <?php endif; ?>

            <?php endforeach; ?>

        >

        <?php if ($suffix): ?>

            <span class="ode-input-suffix">

                <?= htmlspecialchars($suffix, ENT_QUOTES, 'UTF-8') ?>

            </span>

        <?php endif; ?>

    </div>

    <?php if ($help): ?>

        <small class="ode-help">

            <?= htmlspecialchars($help, ENT_QUOTES, 'UTF-8') ?>

        </small>

    <?php endif; ?>

    <?php if (!empty($errors)): ?>

        <?php foreach ($errors as $error): ?>

            <div class="ode-error">

                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

</div>