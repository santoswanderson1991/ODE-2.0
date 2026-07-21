<?php

declare(strict_types=1);

namespace ODE\Shared\UI;

final class Drawer
{
    public static function begin(
        string $id,
        string $title,
        ?string $description = null
    ): void {

        ?>

        <div
            id="<?= esc_attr($id); ?>"
            class="ode-drawer"
            aria-hidden="true"
        >

            <div class="ode-drawer-overlay"></div>

            <aside class="ode-drawer-panel">

                <header class="ode-drawer-header">

                    <div>

                        <h2>

                            <?= esc_html($title); ?>

                        </h2>

                        <?php if ($description !== null) : ?>

                            <p>

                                <?= esc_html($description); ?>

                            </p>

                        <?php endif; ?>

                    </div>

                    <button
                        type="button"
                        class="ode-drawer-close"
                        data-drawer-close
                    >

                        <span class="dashicons dashicons-no-alt"></span>

                    </button>

                </header>

                <div class="ode-drawer-body">

        <?php
    }

    public static function end(): void
    {
        ?>

                </div>

                <footer class="ode-drawer-footer">

                </footer>

            </aside>

        </div>

        <?php
    }
}