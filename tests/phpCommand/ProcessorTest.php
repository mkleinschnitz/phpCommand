<?php
 /**
  * phpCommand
  *
  * @copyright 2013 Michael Kleinschnitz (mail@kleinschnitz.de)
  *
  */ 

namespace phpCommand;

use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 *
 * @package   phpCommand
 * @copyright Michael Kleinschnitz (mail@kleinschnitz.de)
 *
 */
class ProcessorTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     * @return Command\Executable|PHPUnit_Framework_MockObject_MockObject
     */
    private function commandMockFactory()
    {
        /** @var $command \phpCommand\Command\Executable|PHPUnit_Framework_MockObject_MockObject */
        $command = $this->getMockForAbstractClass('\phpCommand\Command\Executable', array('execute'));
        return $command;
    }

    public function testCommandOrder()
    {
        $processor = new Processor();

        $commandA = $this->commandMockFactory();
        $commandB = $this->commandMockFactory();
        $commandC = $this->commandMockFactory();
        $commandD = $this->commandMockFactory();

        $processor->addCommand($commandA);
        $processor->addCommand($commandB);
        $processor->addCommand($commandC);
        $processor->addCommand($commandD);

        $commandsFromProcessor = $processor->getCommands();

        $this->assertCount(4, $commandsFromProcessor);
        $this->assertSame($commandA, $commandsFromProcessor[0]);
        $this->assertSame($commandB, $commandsFromProcessor[1]);
        $this->assertSame($commandC, $commandsFromProcessor[2]);
        $this->assertSame($commandD, $commandsFromProcessor[3]);
    }

    public function testProcessorExecutesAllCommands()
    {
        $commandA = $this->commandMockFactory();
        $commandA->expects($this->exactly(3))
            ->method('execute');

        $commandB = $this->commandMockFactory();
        $commandB->expects($this->exactly(1))
            ->method('execute');

        $processor = new Processor();

        $processor->addCommand($commandA);
        $processor->addCommand($commandA);
        $processor->addCommand($commandB);
        $processor->addCommand($commandA);

        $processor->execute();
    }

    public function testReturnToken()
    {
        $token = new Token();
        $processor = new Processor($token);

        $this->assertSame($token, $processor->getToken());
    }

    public function testExecuteEmptyProcessor()
    {
        $processor = new Processor();
        $processor->execute();

        $this->assertTrue(true);
    }

    public function testReturnTokenAfterExecute()
    {
        $tokenA = new Token();
        $processor = new Processor($tokenA);

        $tokenB = new Token();
        $processor->execute($tokenB);

        $this->assertSame($tokenB, $processor->getToken());
    }

    public function testTokenIsNullIfAsDefault()
    {
        $processor = new Processor();

        $this->assertNull($processor->getToken());
    }

    public function testTokenIsSetViaExecute()
    {
        $processor = new Processor();

        $token = 'myToken';
        $processor->execute($token);

        $this->assertEquals($token, $processor->getToken());
    }

    public function testRecursiveProcessorCall()
    {
        $commandA = $this->commandMockFactory();
        $commandA->expects($this->exactly(3))
            ->method('execute');

        $commandB = $this->commandMockFactory();
        $commandB->expects($this->exactly(1))
            ->method('execute');

        $processorA = new Processor();
        $processorA->addCommand($commandA);
        $processorA->addCommand($commandB);

        $processorB = new Processor();
        $processorB->addCommand($commandA);
        $processorB->addCommand($processorA);
        $processorB->addCommand($commandA);

        $processorB->execute();
    }
}
