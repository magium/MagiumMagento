<?php

namespace Magium\Magento\Actions\Admin\Cache;

use Facebook\WebDriver\WebDriverBy;
use Magium\Actions\StaticActionInterface;
use Magium\Magento\Actions\Admin\WaitForPageLoaded;
use Magium\Magento\Navigators\Admin\AdminMenu;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\WebDriver;

abstract class AbstractCacheAction implements StaticActionInterface
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
    protected $theme;
    protected $loaded;

    protected $option;

    public function __construct(
        WebDriver $webDriver,
        AdminMenu $adminMenu,
        ThemeConfiguration $theme,
        WaitForPageLoaded $loaded
    )
    {
        $this->webDriver    = $webDriver;
        $this->adminMenu    = $adminMenu;
        $this->theme        = $theme;
        $this->loaded       = $loaded;
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
        $this->adminMenu->navigateTo($this->theme->getCacheNavigationPath());
        if (!empty($this->targets)) {
            foreach ($this->targets as $target) {
                $element = $this->webDriver->byXpath($this->theme->getCacheTargetXpath($target));
                $element->click();
            }
        } else {
            $elements = $this->webDriver->findElements(WebDriverBy::xpath($this->theme->getCacheAllTargetsXpath()));
            foreach ($elements as $element) {
                $element->click();
            }
        }
        $this->webDriver->byXpath($this->theme->getCacheMassActionOptionXpath($this->option))->click();
        $body = $this->webDriver->byXpath('//body');
        $this->webDriver->byXpath($this->theme->getCacheSubmitXpath())->click();

        $this->loaded->execute($body);

    }


}