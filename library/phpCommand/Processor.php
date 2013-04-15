<?php
 /**
  * phpCommand
  *
  * @copyright 2013 Michael Kleinschnitz (mail@kleinschnitz.de)
  *
  */ 

namespace phpCommand;

use phpCommand\Command\Executable;

/**
 *
 * @package   phpCommand
 * @copyright Michael Kleinschnitz (mail@kleinschnitz.de)
 *
 */
class Processor implements Executable
{
    /**
     * @var string
     */
    const KEEP_TOKEN = 'keepToken';

    /**
     * @var mixed
     */
    private $token = null;

    /**
     * @var Command\Executable[]
     */
    private $commands = array();

    /**
     * @param mixed $token [optional]
     */
    public function __construct($token = self::KEEP_TOKEN)
    {
        $this->setTokenIfRightInstanceOrNewInstance($token);
    }

    /**
     * @param mixed $token
     */
    private function setTokenIfRightInstanceOrNewInstance($token)
    {
        if ($token !== self::KEEP_TOKEN) {
            $this->token = $token;
        }
    }

    /**
     * @param Executable $command
     *
     * @return $this
     */
    public function addCommand(Executable $command)
    {
        $this->commands[] = $command;
        return $this;
    }

    /**
     * @return Command\Executable[]
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * @param mixed|Token $token [optional]
     *
     * @return void
     */
    public function execute($token = self::KEEP_TOKEN)
    {
        $this->setTokenIfRightInstanceOrNewInstance($token);
        $this->executeCommands();
    }

    /**
     * @return void
     */
    private function executeCommands()
    {
        foreach ($this->commands as $command) {
            $command->execute($this->token);
        }
    }

    /**
     * @return \phpCommand\Token
     */
    public function getToken()
    {
        return $this->token;
    }
}
