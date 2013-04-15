<?php
 /**
  * phpCommand
  *
  * @copyright 2013 Michael Kleinschnitz (mail@kleinschnitz.de)
  *
  */ 

namespace phpCommand;

use PHPUnit_Framework_TestCase;

/**
 *
 * @package   phpCommand
 * @copyright Michael Kleinschnitz (mail@kleinschnitz.de)
 *
 */
class VersionTest extends PHPUnit_Framework_TestCase
{
    public function testVersionIsString()
    {
        $this->assertInternalType('string', Version::getVersion());
    }
}
