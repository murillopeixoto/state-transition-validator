<?php

namespace App\State;

interface ExtractorInterface
{
    /**
     * @param string $state
     * @throws InvalidStateException
     * @return StateInterface
     */
    public function extract(string $state): StateInterface;
}
