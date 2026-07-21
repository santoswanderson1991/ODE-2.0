<?php

declare(strict_types=1);

namespace ODE\Shared\UI;

final class Pagination
{
    public static function render(
        int $currentPage,
        int $totalPages,
        string $parameter = 'paged'
    ): void {

        if ($totalPages <= 1) {
            return;
        }

        ?>

        <div class="ode-pagination">

            <?php if ($currentPage > 1) : ?>

                <a
                    class="button"
                    href="?<?= esc_attr($parameter); ?>=<?= $currentPage - 1; ?>"
                >
                    &laquo; Anterior
                </a>

            <?php endif; ?>

            <?php for ($page = 1; $page <= $totalPages; $page++) : ?>

                <?php

                $class = $page === $currentPage
                    ? 'button button-primary'
                    : 'button';

                ?>

                <a
                    class="<?= esc_attr($class); ?>"
                    href="?<?= esc_attr($parameter); ?>=<?= $page; ?>"
                >
                    <?= esc_html((string) $page); ?>
                </a>

            <?php endfor; ?>

            <?php if ($currentPage < $totalPages) : ?>

                <a
                    class="button"
                    href="?<?= esc_attr($parameter); ?>=<?= $currentPage + 1; ?>"
                >
                    Próxima &raquo;
                </a>

            <?php endif; ?>

        </div>

        <?php
    }
}