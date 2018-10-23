<?php

namespace App\State;

abstract class StateAbstract implements StateInterface
{
    /**
     * @var array
     */
    protected $possibleTransitions;

    abstract protected function setPossibleTransitions(): void;

    public function __construct()
    {
        $this->setPossibleTransitions();
    }

    /**
     * @return array
     */
    public function getPossibleTransitions(): array
    {
        return $this->possibleTransitions;
    }
}
