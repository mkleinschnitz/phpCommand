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
class Processor
{
    /**
     * @var Token
     */
    private $token;

    /**
     * @var Command\Executable[]
     */
    private $commands;

    /**
     * @param Token $token
     */
    public function __construct(Token $token = null)
    {
        if (null === $token) {
            $this->token = new Token();
        } else {
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
     *
     * @return Command\Executable[]
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     *
     */
    public function execute()
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
