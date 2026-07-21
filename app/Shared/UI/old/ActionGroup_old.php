<?php

declare(strict_types=1);

namespace ODE\Shared\UI;

final class ActionGroup
{
    /**
     * @param array<int,array<string,mixed>> $actions
     */
    public static function render(array $actions): void
    {
        ?>

        <div class="ode-action-group">

            <?php foreach ($actions as $action) : ?>

                <button
                    type="button"
                    class="<?= esc_attr($action['class'] ?? 'button button-small'); ?>"
                    <?php

                    if (! empty($action['attributes'])) {

                        foreach ($action['attributes'] as $key => $value) {

                            printf(
                                ' %s="%s"',
                                esc_attr($key),
                                esc_attr((string) $value)
                            );

                        }

                    }

                    ?>
                >

                    <?php if (! empty($action['icon'])) : ?>

                        <span class="dashicons <?= esc_attr($action['icon']); ?>"></span>

                    <?php endif; ?>

                    <?= esc_html($action['label']); ?>

                </button>

            <?php endforeach; ?>

        </div>

        <?php
    }

    public static function edit(int|string $id): array
    {
        return [

            'label' => 'Editar',

            'icon' => 'dashicons-edit',

            'class' => 'button button-small',

            'attributes' => [

                'data-action' => 'edit',

                'data-id' => $id,

            ],

        ];
    }

    public static function delete(int|string $id): array
    {
        return [

            'label' => 'Excluir',

            'icon' => 'dashicons-trash',

            'class' => 'button button-small button-link-delete',

            'attributes' => [

                'data-action' => 'delete',

                'data-id' => $id,

            ],

        ];
    }

    public static function duplicate(int|string $id): array
    {
        return [

            'label' => 'Duplicar',

            'icon' => 'dashicons-admin-page',

            'class' => 'button button-small',

            'attributes' => [

                'data-action' => 'duplicate',

                'data-id' => $id,

            ],

        ];
    }
}