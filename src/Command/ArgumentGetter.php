<?php

namespace App\Command;

class ArgumentGetter
{
    /**
     * @var array
     */
    private static $args = [
        'current' => 0,
        'next' => 1,
    ];

    /**
     * @param string $arg
     * @param array $args
     * @return string
     * @throws InvalidInputException
     */
    public static function getArg(string $arg, array $args): string
    {
        if (!isset($args[self::$args[$arg]])) {
            throw new InvalidInputException(
                sprintf('Parameter `%s` is not sent', $arg)
            );
        }

        return $args[self::$args[$arg]];
    }
}
