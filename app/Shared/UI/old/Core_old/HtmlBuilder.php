<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Core;

final class HtmlBuilder
{
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

        $attr = new Attributes();

        foreach ($attributes as $name => $value) {
            $attr->set($name, $value);
        }

        $attrs = trim($attr->render());

        if ($attrs !== '') {
            $attrs = ' ' . $attrs;
        }

        return sprintf(
            '<%1$s%2$s>%3$s</%1$s>',
            $tag,
            $attrs,
            $content
        );
    }

    /**
     * Cria uma tag auto-fechável.
     *
     * @param array<string,mixed> $attributes
     */
    public static function selfClosing(
        string $tag,
        array $attributes = []
    ): string {

        $attr = new Attributes();

        foreach ($attributes as $name => $value) {
            $attr->set($name, $value);
        }

        $attrs = trim($attr->render());

        if ($attrs !== '') {
            $attrs = ' ' . $attrs;
        }

        return sprintf(
            '<%s%s />',
            $tag,
            $attrs
        );
    }

    /**
     * Escapa texto.
     */
    public static function text(string $text): string
    {
        return htmlspecialchars(
            $text,
            ENT_QUOTES,
            'UTF-8'
        );
    }

    /**
     * Cria um DIV.
     *
     * @param array<string,mixed> $attributes
     */
    public static function div(
        string $content,
        array $attributes = []
    ): string {

        return self::tag(
            'div',
            $content,
            $attributes
        );
    }

    /**
     * Cria um SPAN.
     *
     * @param array<string,mixed> $attributes
     */
    public static function span(
        string $content,
        array $attributes = []
    ): string {

        return self::tag(
            'span',
            $content,
            $attributes
        );
    }

    /**
     * Cria um BUTTON.
     *
     * @param array<string,mixed> $attributes
     */
    public static function button(
        string $content,
        array $attributes = []
    ): string {

        return self::tag(
            'button',
            $content,
            $attributes
        );
    }

    /**
     * Cria um INPUT.
     *
     * @param array<string,mixed> $attributes
     */
    public static function input(
        array $attributes = []
    ): string {

        return self::selfClosing(
            'input',
            $attributes
        );
    }

    /**
     * Cria um LABEL.
     *
     * @param array<string,mixed> $attributes
     */
    public static function label(
        string $content,
        array $attributes = []
    ): string {

        return self::tag(
            'label',
            $content,
            $attributes
        );
    }
}