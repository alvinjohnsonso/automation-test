<?php

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

class Tests extends TestCase
{
    protected $webDriver;

    public function build_capabilities() {
        throw new ErrorException('build_capabilities is not implemented');
    }

    public function setup(): void
    {
        $hubHost = getenv('SELENIUM_HUB_HOST');
        $capabilities = $this->build_capabilities();
        // TODO: transfer to a config file
        $this->webDriver = RemoteWebDriver::create('http://localhost:4444/', $capabilities);
    }

    public function tearDown(): void
    {
        $this->webDriver->quit();
    }

    /**
     * @test
     */
    public function test_searchTextOnGoogle()
    {
        $this->webDriver->get("wordpress");
        $this->assertEquals('http://wordpress/', $this->webDriver->getCurrentURL());
    }
}
