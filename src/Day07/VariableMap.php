<?php

namespace Day07;

class VariableMap
{
    private $variables = array();

    public function put($name, $value)
    {
        $this->variables[$name] = $value;
    }

    public function get($name)
    {
        return isset($this->variables[$name]) ? $this->variables[$name] : null;
    }
}
