<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Components\Button;

final class Button
{
    public static function primary(

        string $label,

        string $id = ''

    ): void {

        ?>

        <button

            type="button"

            id="<?= esc_attr($id); ?>"

            class="button button-primary"

        >

            <?= esc_html($label); ?>

        </button>

        <?php

    }

    public static function secondary(

        string $label,

        string $id = ''

    ): void {

        ?>

        <button

            type="button"

            id="<?= esc_attr($id); ?>"

            class="button"

        >

            <?= esc_html($label); ?>

        </button>

        <?php

    }

}