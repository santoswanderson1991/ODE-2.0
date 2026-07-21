<?php

declare(strict_types=1);

namespace ODE\Shared\UI;

final class Form
{
    /**
     * @param array<string,string> $attributes
     */
    public static function begin(
        string $action = '',
        string $method = 'post',
        array $attributes = []
    ): void {

        $id = $attributes['id'] ?? '';

        $class = $attributes['class'] ?? 'ode-form';

        ?>

        <form
            action="<?= esc_url($action); ?>"
            method="<?= esc_attr($method); ?>"
            id="<?= esc_attr($id); ?>"
            class="<?= esc_attr($class); ?>"
            enctype="multipart/form-data"
        >

        <?php
    }

    public static function end(): void
    {
        ?>

        </form>

        <?php
    }
}