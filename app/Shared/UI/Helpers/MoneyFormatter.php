<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Helpers;

final class MoneyFormatter
{
    public static function format(
        float $value
    ): string {

        return 'R$ ' .

            number_format(

                $value,

                2,

                ',',

                '.'

            );

    }

}