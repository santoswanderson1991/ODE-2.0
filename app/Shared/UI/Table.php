<?php

declare(strict_types=1);

namespace ODE\Shared\UI;

final class Toolbar
{
    /**
     * @param array<int,array{
     *     label:string,
     *     id?:string,
     *     class?:string,
     *     icon?:string,
     *     type?:string
     * }> $actions
     */
    public static function render(
        array $actions = [],
        bool $search = true,
        string $searchPlaceholder = 'Pesquisar...'
    ): void {

        ?>

        <div class="ode-toolbar">

            <div class="ode-toolbar-left">

                <?php if ($search) : ?>

                    <input
                        type="search"
                        id="ode-search"
                        class="regular-text"
                        placeholder="<?= esc_attr($searchPlaceholder); ?>"
                    >

                <?php endif; ?>

            </div>

            <div class="ode-toolbar-right">

                <?php foreach ($actions as $action) : ?>

                    <button
                        type="<?= esc_attr($action['type'] ?? 'button'); ?>"
                        id="<?= esc_attr($action['id'] ?? ''); ?>"
                        class="<?= esc_attr($action['class'] ?? 'button'); ?>"
                    >

                        <?php if (! empty($action['icon'])) : ?>

                            <span class="dashicons <?= esc_attr($action['icon']); ?>"></span>

                        <?php endif; ?>

                        <?= esc_html($action['label']); ?>

                    </button>

                <?php endforeach; ?>

            </div>

        </div>

        <?php
    }
}