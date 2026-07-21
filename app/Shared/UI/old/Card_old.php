<?php

declare(strict_types=1);

namespace ODE\Shared\UI;

final class Card
{
    public static function begin(
        ?string $title = null,
        ?string $description = null,
        array $attributes = []
    ): void {

        $class = $attributes['class'] ?? 'ode-card';

        ?>

        <div class="<?= esc_attr($class); ?>">

            <?php if ($title !== null) : ?>

                <div class="ode-card-header">

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

                </div>

            <?php endif; ?>

            <div class="ode-card-body">

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