<?php

namespace spec\Day02;

use PhpSpec\ObjectBehavior;

class NumberSpellerSpec extends ObjectBehavior
{
    function it_spells_units()
    {
        $numbers = array(
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine'
        );

        foreach($numbers as $number => $word) {
            $this->spell($number)->shouldReturn($word);
        }
    }

    function it_spells_teens_and_tens()
    {
        $numbers = array(
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            21 => 'twenty one',
            30 => 'thirty',
            31 => 'thirty one',
            40 => 'fourty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
            99 => 'ninety nine'
        );

        foreach($numbers as $number => $word) {
            $this->spell($number)->shouldReturn($word);
        }
    }

    function it_spells_hundreds()
    {
        $numbers = array(
            100 => 'one hundred',
            101 => 'one hundred and one',
            300 => 'three hundred',
            311 => 'three hundred and eleven',
            455 => 'four hundred and fifty five'
        );

        foreach($numbers as $number => $word) {
            $this->spell($number)->shouldReturn($word);
        }
    }

    function it_spells_thousands()
    {
        $numbers = array(
            1000 => 'one thousand',
            2001 => 'two thousand and one',
            3012 => 'three thousand and twelve',
            4321 => 'four thousand, three hundred and twenty one',
            12321 => 'twelve thousand, three hundred and twenty one',
            12001 => 'twelve thousand and one',
            12021 => 'twelve thousand and twenty one',
            512000 => 'five hundred and twelve thousand',
            512001 => 'five hundred and twelve thousand and one',
            512021 => 'five hundred and twelve thousand and twenty one',
            512321 => 'five hundred and twelve thousand, three hundred and twenty one'
        );

        foreach($numbers as $number => $word) {
            $this->spell($number)->shouldReturn($word);
        }
    }

    function it_spells_millions()
    {
        $numbers = array(
            1000000 => 'one million',
            1000001 => 'one million and one',
            1000021 => 'one million and twenty one',
            1000321 => 'one million, three hundred and twenty one',
            1004321 => 'one million, four thousand, three hundred and twenty one',
            1054321 => 'one million, fifty four thousand, three hundred and twenty one',
            1654321 => 'one million, six hundred and fifty four thousand, three hundred and twenty one',
            71654321 => 'seventy one million, six hundred and fifty four thousand, three hundred and twenty one',
            871654321 => 'eight hundred and seventy one million, six hundred and fifty four thousand, three hundred and twenty one',
            871654000 => 'eight hundred and seventy one million, six hundred and fifty four thousand',
            871650000 => 'eight hundred and seventy one million, six hundred and fifty thousand',
            871600000 => 'eight hundred and seventy one million, six hundred thousand',
        );

        foreach($numbers as $number => $word) {
            $this->spell($number)->shouldReturn($word);
        }
    }
}
