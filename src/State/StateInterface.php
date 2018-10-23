<?php

namespace App\State;

interface StateInterface
{
    /**
     * @return array
     */
    public function getPossibleTransitions(): array;
}
