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
        90 => 'ninety'
    );

    public function spell($number)
    {
        if ($this->isBasicNumber($number)) {
            return $this->spellBasicNumber($number);
        }

        if ($number < 100) {
            return $this->spellTens($number);
        } elseif ($number < 1000) {
            return $this->spellHundreds($number);
        } elseif ($number < 1000000) {
            return $this->spellThousands($number);
        } else {
            return $this->spellMilions($number);
        }
    }

    private function isBasicNumber($number)
    {
        return array_key_exists($number, $this->basicNumbers);
    }

    private function spellBasicNumber($number)
    {
        return $this->basicNumbers[$number];
    }

    private function spellTens($number)
    {
        $reminder = $number % 10;
        $base = intval($number - $reminder);

        if ($base < 20) {
            return $this->spellBasicNumber($reminder).'teen';
        }

        return $this->spellBasicNumber($base).' '.$this->spellBasicNumber($reminder);
    }

    private function spellHundreds($number)
    {
        $reminder = $number % 100;
        $quotient = intval($number / 100);

        if ($reminder == 0) {
            return $this->spellBasicNumber($quotient).' hundred';
        } else {
            return $this->spellBasicNumber($quotient).' hundred and '.$this->spell($reminder);
        }
    }

    private function spellThousands($number)
    {
        $reminder = $number % 1000;
        $quotient = intval($number / 1000);

        $result = $this->spell($quotient).' thousand';

        if ($reminder > 0) {
            if ($reminder < 100) {
                $result.= ' and '.$this->spell($reminder);
            } else {
                $result.= ', '.$this->spell($reminder);
            }
        }

        return $result;
    }

    private function spellMilions($number)
    {
        $reminder = $number % 1000000;
        $quotient = intval($number / 1000000);

        $result = $this->spell($quotient).' milion';

        if ($reminder > 0) {
            if ($reminder < 100) {
                $result.= ' and '.$this->spell($reminder);
            } else {
                $result.= ', '.$this->spell($reminder);
            }
        }

        return $result;
    }
}
