<?php

namespace Magium\Magento\Extractors\Catalog;

use Magium\Extractors\AbstractExtractor;
use Magium\WebDriver\WebDriver;

class HasLayeredNavigation extends AbstractExtractor
{
    const EXTRACTOR = 'Catalog\HasLayeredNavigation';

    protected $hasLayeredNav;

    public function hasLayeredNavigation()
    {
        $this->extract();
        return $this->hasLayeredNav;
    }

    public function extract()
    {
        $xpath = $this->theme->getLayeredNavigationTestXpath();
        $this->hasLayeredNav = $this->webDriver->elementExists($xpath, WebDriver::BY_XPATH);
    }
}