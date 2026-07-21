<?php

use ODE\Shared\UI\Support\Html;

/** @var \ODE\Shared\UI\Components\Badge\Badge $badge */

?>

<span <?= Html::attributes($badge->getAttributes()) ?>>

    <?= Html::escape($badge->getLabel()) ?>

</span>