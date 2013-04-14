<?php
 /**
  * phpCommand
  *
  * @copyright 2013 Michael Kleinschnitz (mail@kleinschnitz.de)
  *
  */ 

namespace phpCommand\Command;

use phpCommand\Token;

/**
 *
 * @package   phpCommand\Command
 * @copyright Michael Kleinschnitz (mail@kleinschnitz.de)
 *
 */
interface Executable
{
    /**
     * @param mixed|Token $token
     *
     * @return void
     */
    public function execute($token);
}
