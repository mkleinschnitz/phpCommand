<?php
 /**
  * phpCommand
  *
  * @copyright 2013 Michael Kleinschnitz (mail@kleinschnitz.de)
  *
  */ 

namespace phpCommand;

/**
 *
 * @package   phpCommand
 * @copyright Michael Kleinschnitz (mail@kleinschnitz.de)
 *
 */
class Version
{
    /**
     * @var string
     */
    const VERSION = '0.1.0';

    /**
     * @return string
     */
    public static function getVersion()
    {
        return self::VERSION;
    }
}
