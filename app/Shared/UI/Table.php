<?php

declare(strict_types=1);

namespace ODE\Shared\UI;

final class Table
{
    /**
     * @param array<string,mixed> $columns
     * @param array<int,array<string,mixed>> $rows
     */
    public static function render(
        array $columns,
        array $rows,
        ?callable $actions = null,
        string $emptyMessage = 'Nenhum registro encontrado.'
    ): void {

        ?>

        <table class="widefat striped fixed ode-table">

            <thead>

                <tr>

                    <?php foreach ($columns as $key => $column) : ?>

                        <?php

                        if (is_string($column)) {

                            $column = [
                                'label' => $column,
                            ];

                        }

                        ?>

                        <th

                            <?php if (isset($column['width'])) : ?>

                                style="width: <?= esc_attr((string) $column['width']); ?>"

                            <?php endif; ?>

                            class="<?= esc_attr($column['class'] ?? ''); ?>"

                        >

                            <?= esc_html($column['label']); ?>

                        </th>

                    <?php endforeach; ?>

                    <?php if ($actions !== null) : ?>

                        <th style="width:170px">

                            Ações

                        </th>

                    <?php endif; ?>

                </tr>

            </thead>

            <tbody>

            <?php if (empty($rows)) : ?>

                <tr>

                    <td colspan="<?= count($columns) + ($actions ? 1 : 0); ?>">

                        <?= esc_html($emptyMessage); ?>

                    </td>

                </tr>

            <?php else : ?>

                <?php foreach ($rows as $row) : ?>

                    <tr>

                        <?php foreach ($columns as $key => $column) : ?>

                            <?php

                            if (is_string($column)) {

                                $column = [
                                    'label' => $column,
                                ];

                            }

                            ?>

                            <td
                                class="<?= esc_attr($column['class'] ?? ''); ?>"
                            >

                                <?php

                                $value = $row[$key] ?? null;

                                if (
                                    isset($column['render']) &&
                                    is_callable($column['render'])
                                ) {

                                    $column['render'](
                                        $value,
                                        $row
                                    );

                                } else {

                                    echo esc_html(
                                        (string) $value
                                    );

                                }

                                ?>

                            </td>

                        <?php endforeach; ?>

                        <?php if ($actions !== null) : ?>

                            <td>

                                <?php

                                $actions($row);

                                ?>

                            </td>

                        <?php endif; ?>

                    </tr>

                <?php endforeach; ?>

            <?php endif; ?>

            </tbody>

        </table>

        <?php
    }
}
