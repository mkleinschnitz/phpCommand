<?php
 /**
  * phpCommand
  *
  * @copyright 2013 Michael Kleinschnitz (mail@kleinschnitz.de)
  *
  */

$autoLoadPath = __DIR__ . '/../vendor/autoload.php';

if (!file_exists($autoLoadPath)) {
    die('composer autoloader missing!');
}

require_once($autoLoadPath);
