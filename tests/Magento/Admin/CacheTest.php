<?php

namespace Tests\Magium\Magento\Admin;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Admin\Cache\DisableCache;
use Magium\Magento\Actions\Admin\Cache\EnableCache;
use Magium\Magento\Actions\Admin\Cache\RefreshCache;
use Magium\Magento\Actions\Admin\Login\Login;
use Magium\WebDriver\WebDriver;

class CacheTest extends AbstractMagentoTestCase
{

    public function testSetDisabledThenEnabled()
    {
        $this->getAction(Login::ACTION)->login();
        $cacheAction = $this->getAction(DisableCache::ACTION);
        /* @var $cacheAction DisableCache */
        $cacheAction->addTarget(DisableCache::TARGET_LAYOUTS);
        $cacheAction->addTarget(DisableCache::TARGET_COLLECTIONS);
        $cacheAction->execute();

        $this->assertEnabled('config');
        $this->assertDisabled('layout');
        $this->assertDisabled('collections');

        $cacheAction = $this->getAction(EnableCache::ACTION);
        /* @var $cacheAction EnableCache */
        $cacheAction->addTarget(EnableCache::TARGET_LAYOUTS);
        $cacheAction->addTarget(EnableCache::TARGET_COLLECTIONS);
        $cacheAction->execute();

        $this->assertEnabled('config');
        $this->assertEnabled('layout');
        $this->assertEnabled('collections');

    }


    public function testRefreshDoesNotBarf()
    {
        $this->getAction(Login::ACTION)->login();
        $cacheAction = $this->getAction(RefreshCache::ACTION);
        /* @var $cacheAction RefreshCacheCache */
        $cacheAction->execute();
    }

    public function testDisableAllThenEnableAll()
    {
        $this->getAction(Login::ACTION)->login();
        $cacheAction = $this->getAction(DisableCache::ACTION);
        /* @var $cacheAction DisableCache */
        $cacheAction->execute();

        $this->assertDisabled('config');
        $this->assertDisabled('layout');
        $this->assertDisabled('collections');

        $cacheAction = $this->getAction(EnableCache::ACTION);
        /* @var $cacheAction EnableCache */
        $cacheAction->execute();

        $this->assertEnabled('config');
        $this->assertEnabled('layout');
        $this->assertEnabled('collections');
    }

    protected function assertDisabled($type)
    {
        $this->assertElementValue($type, 'Disabled');
    }

    protected function assertEnabled($type)
    {
        $this->assertElementValue($type, 'Enabled');
    }

    protected function assertElementValue($type, $value)
    {
        $xpath = sprintf('//input[@name="types" and @value="%s"]/../../td/descendant::span[.="%s"]', $type, $value);
        $this->assertElementExists($xpath, WebDriver::BY_XPATH);
    }

}