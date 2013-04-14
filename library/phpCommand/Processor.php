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
     * @var Token
     */
    private $token;

    /**
     * @var Command\Executable[]
     */
    private $commands = array();

    /**
     * @param Token $token [optional]
     */
    public function __construct(Token $token = null)
    {
        $this->setTokenIfRightInstanceOrNewInstance($token);
    }

    /**
     * @param Token $token [optional]
     */
    private function setTokenIfRightInstanceOrNewInstance(Token $token = null)
    {
        if ($token instanceof Token) {
            $this->token = $token;
        } else {
            $this->token = new Token();
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
    public function execute($token = null)
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
