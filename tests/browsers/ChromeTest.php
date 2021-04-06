<?php
require_once 'tests/tests.php';

use Facebook\WebDriver\Remote\DesiredCapabilities;

class ChromeTest extends Tests
{
  public function build_capabilities(){
    $capabilities = DesiredCapabilities::chrome();
    return $capabilities;
  }
}
