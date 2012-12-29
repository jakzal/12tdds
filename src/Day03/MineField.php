<?php

namespace Day03;

class MineField
{
    private $mineLocations = array();

    public function __construct(array $mineLocations)
    {
        $this->mineLocations = $mineLocations;
    }

    public function getHintField()
    {
        $result = array();

        foreach (array_keys($this->mineLocations) as $row) {
            $result[$row] = $this->getHintsForRow($row);
        }

        return $result;
    }

    private function getHintsForRow($row)
    {
        $result = array();

        foreach (array_keys($this->mineLocations[$row]) as $column) {
            $result[$column] = $this->getHintForCell($row, $column);
        }

        return $result;
    }

    private function getHintForCell($row, $column)
    {
        $cell = $this->mineLocations[$row][$column];

        return '*' == $cell ? '*' : $this->countMinesAroundCell($row, $column);
    }

    private function countMinesAroundCell($row, $column)
    {
        $result = 0;

        foreach (range($row-1, $row+1) as $x) {
            foreach (range($column-1, $column+1) as $y) {
                $result+= (int) $this->hasMine($x, $y);
            }
        }

        return $result;
    }

    private function hasMine($row, $column)
    {
        return isset($this->mineLocations[$row][$column]) && '*' == $this->mineLocations[$row][$column];
    }
}
