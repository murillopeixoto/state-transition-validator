<?php

namespace App\Command;

use App\State\Extractor;
use App\State\ExtractorInterface;
use App\Validator\Validator;
use App\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class CommandValidateTest extends TestCase
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

    public function setUp()
    {
        $this->extractor = new Extractor();
        $this->validator = new Validator();
        $this->logger = $this->createMock(LoggerInterface::class);
    }

    public function testExecuteWith1StateLogErrorMessage()
    {
        $this->setLogExpectation(
            'error',
            'App\Command\InvalidInputException: Parameter `next` is not sent'
        );

        $command = new CommandValidate($this->extractor, $this->validator, $this->logger);
        $command->execute(['New']);
    }

    public function testExecuteWithInvalidStateLogErrorMessage()
    {
        $this->setLogExpectation(
            'error',
            'App\State\InvalidStateException: The state `Invalid` does not exist'
        );

        $command = new CommandValidate($this->extractor, $this->validator, $this->logger);
        $command->execute(['New', 'Invalid']);
    }

    public function testExecuteWithInvalidTransitionLogErrorMessage()
    {
        $this->setLogExpectation(
            'error',
            'App\Validator\InvalidTransitionException: `New` cannot transit to `Removed`'
        );

        $command = new CommandValidate($this->extractor, $this->validator, $this->logger);
        $command->execute(['New', 'Removed']);
    }

    public function testExecuteWithValidParametersLogSuccessMessage()
    {
        $this->setLogExpectation('info','The Transition from `New` to `Active` is valid');

        $command = new CommandValidate($this->extractor, $this->validator, $this->logger);
        $command->execute(['New', 'Active']);
    }

    private function setLogExpectation(string $method, string $message)
    {
        $this->logger
            ->expects($this->once())
            ->method($method)
            ->with($message);
    }
}
