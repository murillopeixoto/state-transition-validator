<?php

namespace App\State;

class Removed extends StateAbstract
{
    protected function setPossibleTransitions(): void
    {
        $this->possibleTransitions = [];
    }
}
