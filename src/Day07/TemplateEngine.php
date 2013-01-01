<?php

namespace Day07;

class TemplateEngine
{
    public function evaluate($template, VariableMap $variableMap)
    {
        return preg_replace_callback(
            '/\{\$(?P<variable>[^}]+)}/',
            function ($matches) use ($variableMap) {
                if (null === $value = $variableMap->get($matches['variable'])) {
                    throw new MissingValueException(sprintf('Missing variable: "%s"', $matches['variable']));
                }

                return $value;
            },
            $template
        );
    }
}
