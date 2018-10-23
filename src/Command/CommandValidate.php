<?php

namespace App\Command;

use App\State\ExtractorInterface;
use App\Validator\ValidatorInterface;
use Psr\Log\LoggerInterface;

class CommandValidate
{
    /**
     * @var ExtractorInterface
     */
    private $extractor;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var LoggerInterface
     */
    private $logger;

    const SUCCESS_MESSAGE = 'The Transition from `%s` to `%s` is valid';

    public function __construct(
        ExtractorInterface $extractor,
        ValidatorInterface $validator,
        LoggerInterface $logger
    ) {
        $this->extractor = $extractor;
        $this->validator = $validator;
        $this->logger = $logger;
    }

    /**
     * @param array $args
     */
    public function execute(array $args): void
    {
        try {
            $current = ArgumentGetter::getArg('current', $args);
            $next = ArgumentGetter::getArg('next', $args);

            $currentStateInstance = $this->extractor->extract($current);
            $nextStateInstance = $this->extractor->extract($next);

            $this->validator->validate($currentStateInstance, $nextStateInstance);
            $this->logger->info(sprintf(self::SUCCESS_MESSAGE, $current, $next));
        } catch (\Exception $e) {
            $this->logger->error(sprintf('%s: %s', get_class($e), $e->getMessage()));
        }
    }
}
