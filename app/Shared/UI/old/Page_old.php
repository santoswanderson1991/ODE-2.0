<?php

declare(strict_types=1);

namespace ODE\Shared\UI;

final class Page
{
    public static function begin(
        string $title,
        ?string $description = null
    ): void {

        ?>

        <div class="wrap ode-page">

            <div class="ode-page-header">

                <div>

                    <h1 class="wp-heading-inline">

                        <?= esc_html($title) ?>

                    </h1>

                    <?php if ($description !== null) : ?>

                        <p>

                            <?= esc_html($description) ?>

                        </p>

                    <?php endif; ?>

                </div>

        <?php
    }

    public static function end(): void
    {
        ?>

            </div>

        </div>

        <?php
    }
}