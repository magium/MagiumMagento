<?php

namespace Magium\Magento\Actions\Admin\Orders;

use Magium\AbstractTestCase;
use Magium\Actions\StaticActionInterface;
use Magium\Actions\SubAction\SubActionInterface;
use Magium\Actions\SubAction\SubActionSupported;
use Magium\Magento\Actions\Admin\WaitForPageLoaded;
use Magium\Magento\Actions\Admin\Widget\ClickActionButton;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\WebDriver;

class Invoice implements SubActionSupported, StaticActionInterface 
{

    const ACTION = 'Admin\Orders\Invoice';

    protected $webDriver;
    protected $themeConfiguration;
    protected $actionButton;
    protected $loaded;
    protected $testCase;

    protected $preExecuteActions = [];

    public function __construct(
        WebDriver $webDriver,
        ThemeConfiguration $themeConfiguration,
        ClickActionButton $actionButton,
        WaitForPageLoaded $loaded,
        AbstractTestCase $testCase
    )
    {
        $this->webDriver = $webDriver;
        $this->themeConfiguration = $themeConfiguration;
        $this->actionButton = $actionButton;
        $this->loaded = $loaded;
        $this->testCase = $testCase;
    }

    public function addSubAction(SubActionInterface $action)
    {
        $this->preExecuteActions[] = $action;
    }

    /**
     * This test presumes that you are on the order screen
     */

    public function execute()
    {
        $body = $this->webDriver->byXpath('//body');
        $this->actionButton->click('Invoice');
        $this->loaded->execute($body);

        foreach ($this->preExecuteActions as $action) {
            if ($action instanceof SubActionInterface) {
                $action->execute();
            }
        }

        $body = $this->webDriver->byXpath('//body');
        $this->testCase->byText('{{Submit Invoice}}')->click();
        $this->loaded->execute($body);
    }

}