<?php

namespace App\Domains\Product\Utils;

use NumberFormatter;

class ProductUtils {

    public static function getFormattedPrice(int $price): string
    {
        return tap(
            new NumberFormatter("en_US", \NumberFormatter::CURRENCY),
            function ($numberFormatter) {
                $numberFormatter->setAttribute(NumberFormatter::ROUNDING_MODE, NumberFormatter::ROUND_HALFEVEN);
                return $numberFormatter;
            }

        )->formatCurrency($price / 10000, "USD");
    }
}
