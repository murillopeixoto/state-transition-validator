<?php

namespace App\State;

class Extractor implements ExtractorInterface
{
    const CLASS_NAME_TEMPLATE = '%s\%s';

    const ERROR_MESSAGE = 'The state `%s` does not exist';

    /**
     * @param string $state
     * @throws InvalidStateException
     * @return StateInterface
     */
    public function extract(string $state): StateInterface
    {
        $className = sprintf(
            self::CLASS_NAME_TEMPLATE,
            __NAMESPACE__,
            Translator::stateToClassName($state)
        );
        if (!class_exists($className)) {
            throw new InvalidStateException(sprintf(self::ERROR_MESSAGE, $state));
        }

        return new $className();
    }
}
