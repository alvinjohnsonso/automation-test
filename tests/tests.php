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
        $this->webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);
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
        $this->webDriver->get("https://www.google.com/ncr");
        $this->webDriver->manage()->window()->maximize();

        $this->webDriver->wait(10, 500)->until(function ($driver) {
            $elements = $this->webDriver->findElements(WebDriverBy::name("q"));
            return count($elements) > 0;
        });

        $element = $this->webDriver->findElement(WebDriverBy::name("q"));
        if ($element) {
            $element->sendKeys("LambdaTest");
            $element->submit();
        }

        $this->webDriver->wait(10, 500)->until(function ($driver) {
            $title = $this->webDriver->getTitle();
            return $title === 'LambdaTest - Google Search';
        });

        $this->assertEquals('LambdaTest - Google Search', $this->webDriver->getTitle());
    }

    public function test_LT_ToDoApp()
    {
        $itemName = 'Item in Selenium PHP Tutorial';
        $this->webDriver->get("https://lambdatest.github.io/sample-todo-app/");
        $this->webDriver->manage()->window()->maximize();
        sleep(5);
        $element1 = $this->webDriver->findElement(WebDriverBy::name("li1"));
        $element1->click();
        $element2 = $this->webDriver->findElement(WebDriverBy::name("li2"));
        $element2->click();
        $element3 = $this->webDriver->findElement(WebDriverBy::id("sampletodotext"));
        $element3->sendKeys($itemName);
        $element4 = $this->webDriver->findElement(WebDriverBy::id("addbutton"));
        $element4->click();
        $this->webDriver->wait(10, 500)->until(function($driver) {
            $elements = $this->webDriver->findElements(WebDriverBy::cssSelector("[class='list-unstyled'] li:nth-child(6) span"));
            return count($elements) > 0;
        });
        sleep(5);
        $this->assertEquals('Sample page - lambdatest.com', $this->webDriver->getTitle());
    }
}
