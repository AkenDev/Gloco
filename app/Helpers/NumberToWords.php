<?php

namespace App\Helpers;

class NumberToWords
{
    public static function convertir($numero)
    {
        $formatter = new \NumberFormatter("es", \NumberFormatter::SPELLOUT);
        return ucfirst($formatter->format($numero));
    }
}