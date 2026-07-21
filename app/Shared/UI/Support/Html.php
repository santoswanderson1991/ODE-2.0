<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Support;

final class Html
{
    /**
     * Escapa texto HTML.
     */
    public static function escape(
        string $value
    ): string {

        return htmlspecialchars(
            $value,
            ENT_QUOTES,
            'UTF-8'
        );

    }

    /**
     * Converte atributos em HTML.
     *
     * @param array<string,mixed> $attributes
     */
    public static function attributes(
        array $attributes
    ): string {

        $result = [];

        foreach ($attributes as $name => $value) {

            if ($value === false || $value === null) {
                continue;
            }

            if ($value === true) {
                $result[] = $name;
                continue;
            }

            $result[] = sprintf(
                '%s="%s"',
                self::escape((string) $name),
                self::escape((string) $value)
            );
        }

        return implode(' ', $result);

    }

    /**
     * Cria uma tag HTML.
     *
     * @param array<string,mixed> $attributes
     */
    public static function tag(
        string $tag,
        string $content = '',
        array $attributes = []
    ): string {

        $attr = self::attributes($attributes);

        if ($attr !== '') {
            $attr = ' ' . $attr;
        }

        return sprintf(
            '<%1$s%2$s>%3$s</%1$s>',
            $tag,
            $attr,
            $content
        );

    }

    /**
     * Cria uma tag self-closing.
     *
     * @param array<string,mixed> $attributes
     */
    public static function selfClosing(
        string $tag,
        array $attributes = []
    ): string {

        $attr = self::attributes($attributes);

        if ($attr !== '') {
            $attr = ' ' . $attr;
        }

        return sprintf(
            '<%s%s />',
            $tag,
            $attr
        );

    }
}