<?php
require_once 'tests/tests.php';

use Facebook\WebDriver\Remote\DesiredCapabilities;

class FirefoxTest extends Tests
{
  public function build_capabilities(){
    $capabilities = DesiredCapabilities::firefox();
    return $capabilities;
  }
}
