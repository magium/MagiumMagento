<?php

namespace Magium\Magento\Actions\Admin\Cache;

use Facebook\WebDriver\WebDriverBy;
use Magium\Actions\WaitForPageLoaded;
use Magium\Magento\Navigators\Admin\AdminMenu;
use Magium\WebDriver\WebDriver;

abstract class AbstractCacheAction
{

    const TARGET_CONFIGURATION  = 'config';
    const TARGET_LAYOUTS        = 'layout';
    const TARGET_BLOCKS         = 'block_html';
    const TARGET_TRANSLATIONS   = 'translate';
    const TARGET_COLLECTIONS    = 'collections';
    const TARGET_EAV            = 'eav';
    const TARGET_CONFIG_API     = 'config_api';
    const TARGET_CONFIG_API2    = 'config_api2';

    protected $targets = [];

    protected $adminMenu;
    protected $webDriver;
    protected $loaded;

    protected $option;

    public function __construct(
        WebDriver $webDriver,
        AdminMenu $adminMenu,
        WaitForPageLoaded $loaded
    )
    {
        $this->webDriver = $webDriver;
        $this->adminMenu = $adminMenu;
        $this->loaded = $loaded;
    }

    public function addTarget($target)
    {
        $this->removeTarget($target);
        $this->targets[] = $target;
    }

    public function removeTarget($target)
    {
        $key = array_search($target, $this->targets);
        if ($key !== false) {
            unset($this->targets[$key]);
        }
    }

    public function execute()
    {
        $this->adminMenu->navigateTo('System/Cache Management');
        if ($this->targets) {
            foreach ($this->targets as $target) {
                $element = $this->webDriver->byXpath(sprintf('//input[@name="types" and @value="%s"]', $target));
                $element->click();
            }
        } else {
            $elements = $this->webDriver->findElements(WebDriverBy::xpath('//input[@name="types"]'));
            foreach ($elements as $element) {
                $element->click();
            }
        }
        $this->webDriver->byXpath(sprintf('//select[@id="cache_grid_massaction-select"]/option[@value="%s"]', $this->option))->click();
        $body = $this->webDriver->byXpath('//body');
        $this->webDriver->byXpath('//button[@title="Submit"]')->click();

        $this->loaded->execute($body);

    }


}