<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Components\ActionGroup;

final class ActionGroup
{
    public static function render(
        int $id
    ): void {

        ?>

        <div class="ode-actions">

            <button
                class="button button-small"
                data-action="edit"
                data-id="<?= esc_attr($id); ?>"
            >

                Editar

            </button>

            <button
                class="button button-small"
                data-action="delete"
                data-id="<?= esc_attr($id); ?>"
            >

                Excluir

            </button>

        </div>

        <?php

    }
}