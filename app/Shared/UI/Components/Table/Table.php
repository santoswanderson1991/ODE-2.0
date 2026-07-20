<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Components\Table;

final class Table
{
    /**
     * @param array<int,string> $columns
     */
    public static function begin(array $columns): void
    {

        ?>

        <table
            id="ode-table"
            class="widefat striped ode-table"
        >

            <thead>

            <tr>
c
                <?php foreach ($columns as $column) : ?>

                    <th>

                        <?= esc_html($column); ?>

                    </th>

                <?php endforeach; ?>

            </tr>

            </thead>

            <tbody>

        <?php

    }

    public static function end(): void
    {

        ?>

            </tbody>

        </table>

        <?php

    }
}