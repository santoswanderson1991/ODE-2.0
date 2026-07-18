<?php

declare(strict_types=1);

namespace ODE\Shared\UI;

final class EmptyState
{
    /**
     * @param array<string,mixed> $action
     */
    public static function render(
        string $title,
        string $description,
        ?array $action = null,
        string $icon = 'dashicons-database-view'
    ): void {

        ?>

        <div class="ode-empty-state">

            <span
                class="dashicons <?= esc_attr($icon); ?>"
            ></span>

            <h2>

                <?= esc_html($title); ?>

            </h2>

            <p>

                <?= esc_html($description); ?>

            </p>

            <?php if ($action !== null) : ?>

                <?php

                Button::primary(
                    $action['label'],
                    [
                        'id'    => $action['id'] ?? '',
                        'icon'  => $action['icon'] ?? null,
                        'class' => $action['class'] ?? '',
                    ]
                );

                ?>

            <?php endif; ?>

        </div>

        <?php
    }
}