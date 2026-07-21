<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Components\Toolbar;

final class Toolbar
{
    public static function begin(): void
    {

        ?>

        <div class="ode-toolbar">

        <?php

    }

    public static function end(): void
    {

        ?>

        </div>

        <?php

    }

    public static function button(

        string $label,

        string $id,

        string $class = 'button button-primary'

    ): void {

        ?>

        <button

            id="<?= esc_attr($id); ?>"

            class="<?= esc_attr($class); ?>"

            type="button"

        >

            <?= esc_html($label); ?>

        </button>

        <?php

    }

}