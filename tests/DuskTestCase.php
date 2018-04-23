<?php

namespace Tests;

use Laravel\Dusk\TestCase as BaseTestCase;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;
    use FuncoesAssert;

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        static::startChromeDriver();
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        $options = (new ChromeOptions)->addArguments([
//                '--window-size=1440,900',
            '--disable-gpu',
            '--disable-infobars',
        ]);

        if (env('USE_SELENIUM_DOCKER', 'false') == 'true') {
            $webDriver = env('WEBDRIVER_DOCKER');
        } else {
            $webDriver = env('WEBDRIVER_LOCAL');
        }

        return RemoteWebDriver::create(
            $webDriver, DesiredCapabilities::chrome()->setCapability(
            ChromeOptions::CAPABILITY, $options
            )
        );

    }
}
