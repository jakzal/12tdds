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

        $reminder = $number % 10;
        $base = intval($number - $reminder);

        if ($base < 20) {
            return $this->spellBasicNumber($reminder).'teen';
        }

        return $this->spellBasicNumber($base).' '.$this->spellBasicNumber($reminder);
    }

    private function spellHundredsAndOver($number)
    {
        $divisor = $this->findDivisor($number);
        $quotient = intval($number / $divisor);

        return $this->spell($quotient).' '.$this->spellBasicNumber($divisor).$this->spellReminder($number, $divisor);
    }

    private function spellReminder($number, $divisor)
    {
        $reminder = $number % $divisor;

        if ($reminder <= 0) {
            return '';
        } elseif ($reminder < 100) {
            return ' and '.$this->spell($reminder);
        } else {
            return ', '.$this->spell($reminder);
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
