<?php

namespace Day02;

class NumberSpeller
{
    private $basicNumbers = array(
        0 => 'zero',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        15 => 'fifteen',
        18 => 'eighteen',
        20 => 'twenty',
        30 => 'thirty',
        40 => 'fourty',
        50 => 'fifty',
        60 => 'sixty',
        70 => 'seventy',
        80 => 'eighty',
        90 => 'ninety',
        100 => 'hundred',
        1000 => 'thousand',
        1000000 => 'million'
    );

    public function spell($number)
    {
        if ($number < 100) {
            return $this->spellTensAndBelow($number);
        }

        return $this->spellHundredsAndOver($number);
    }

    private function spellBasicNumber($number)
    {
        return $this->basicNumbers[$number];
    }

    private function spellTensAndBelow($number)
    {
        if ($this->isBasicNumber($number)) {
            return $this->spellBasicNumber($number);
        }

        $remainder = $number % 10;
        $base = intval($number - $remainder);

        if ($base < 20) {
            return $this->spellBasicNumber($remainder).'teen';
        }

        return $this->spellBasicNumber($base).' '.$this->spellBasicNumber($remainder);
    }

    private function spellHundredsAndOver($number)
    {
        $divisor = $this->findDivisor($number);
        $quotient = intval($number / $divisor);

        return $this->spell($quotient).' '.$this->spellBasicNumber($divisor).$this->spellRemainder($number, $divisor);
    }

    private function spellRemainder($number, $divisor)
    {
        $remainder = $number % $divisor;

        if ($remainder <= 0) {
            return '';
        } elseif ($remainder < 100) {
            return ' and '.$this->spell($remainder);
        } else {
            return ', '.$this->spell($remainder);
        }
    }

    private function isBasicNumber($number)
    {
        return array_key_exists($number, $this->basicNumbers);
    }

    private function findDivisor($number)
    {
        if ($number < 10) {
            return 1;
        } elseif ($number < 100) {
            return 10;
        } elseif ($number < 1000) {
            return 100;
        } elseif ($number < 1000000) {
            return 1000;
        } else {
            return 1000000;
        }
    }
}
