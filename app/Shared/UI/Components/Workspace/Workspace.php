<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Components\Workspace;

final class Workspace
{
    public static function begin(
        string $title,
        string $description = ''
    ): void {

        ?>

        <div class="wrap">

            <div class="ode-workspace">

                <div class="ode-workspace-header">

                    <div>

                        <h1>

                            <?= esc_html($title); ?>

                        </h1>

                        <?php if ($description !== '') : ?>

                            <p>

                                <?= esc_html($description); ?>

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

        </div>

        <?php

    }
}