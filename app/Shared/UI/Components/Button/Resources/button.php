<?php

use ODE\Shared\UI\Support\Html;

/** @var \ODE\Shared\UI\Components\Button\Button $button */

$attributes = $button->getAttributes();

$attributes['type'] = $button->getType();

if ($button->isDisabled()) {
    $attributes['disabled'] = true;
}

?>

<button <?= Html::attributes($attributes) ?>>

    <?php if ($button->getIcon()): ?>

        <span class="ode-button-icon">

            <?= Html::escape($button->getIcon()) ?>

        </span>

    <?php endif; ?>

    <span class="ode-button-label">

        <?= Html::escape($button->getLabel()) ?>

    </span>

    <?php if ($button->isLoading()): ?>

        <span class="ode-button-spinner"></span>

    <?php endif; ?>

</button>