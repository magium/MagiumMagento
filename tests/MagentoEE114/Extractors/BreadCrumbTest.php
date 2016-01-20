<?php

namespace Tests\Magium\MagentoEE114\Extractors;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\Breadcrumb;
use Magium\Magento\Navigators\BaseMenu;

class BreadCrumbTest extends \Tests\Magium\Magento\Extractors\BreadCrumbTest
{

    public function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE114\ThemeConfiguration');
    }
}