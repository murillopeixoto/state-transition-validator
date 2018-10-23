<?php

namespace App\State;

/**
 * This class is needed because `New` is a valid state and PHP does not accept a class with this name.
 * Then, ths class is responsible to translate from `New` to `NewState` and vice versa
 */
class Translator
{
    public static function stateToClassName(string $state): string
    {
        return $state === 'New' ? 'NewState' : $state;
    }

    public static function classNameToState(string $className): string
    {
        return $className === 'NewState' ? 'New' : $className;
    }
}
