<?php

namespace Magium\Magento\Actions\Admin\Orders;

use Magium\AbstractTestCase;
use Magium\Actions\StaticActionInterface;
use Magium\Actions\SubAction\SubActionInterface;
use Magium\Actions\SubAction\SubActionSupported;
use Magium\Assertions\Xpath\Displayed;
use Magium\Magento\Actions\Admin\WaitForPageLoaded;
use Magium\Magento\Actions\Admin\Widget\ClickActionButton;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\WebDriver;

class Cancel implements StaticActionInterface
{

    const ACTION = 'Admin\Orders\Cancel';

    protected $webDriver;
    protected $themeConfiguration;
    protected $actionButton;
    protected $loaded;
    protected $testCase;
    protected $displayed;

    public function __construct(
        WebDriver $webDriver,
        ThemeConfiguration $themeConfiguration,
        ClickActionButton $actionButton,
        WaitForPageLoaded $loaded,
        AbstractTestCase $testCase,
        Displayed $displayed
    )
    {
        $this->webDriver = $webDriver;
        $this->themeConfiguration = $themeConfiguration;
        $this->actionButton = $actionButton;
        $this->loaded = $loaded;
        $this->testCase = $testCase;
        $this->displayed = $displayed;
    }

    /**
     * This test presumes that you are on the order screen
     */

    public function execute()
    {
        $body = $this->webDriver->byXpath('//body');
        $this->actionButton->click('Cancel');
        $this->webDriver->switchTo()->alert()->accept();
        $this->loaded->execute($body);

        $xpath = $this->themeConfiguration->getOrderCancelledMessageXpath();
        $this->displayed->assertSelector($xpath);
    }

}
