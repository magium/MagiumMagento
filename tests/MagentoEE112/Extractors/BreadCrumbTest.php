<?php

namespace Tests\Magium\MagentoEE112\Extractors;


use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class BreadCrumbTest extends \Tests\Magium\Magento\Extractors\BreadCrumbTest
{
    protected $category = 'Apparel/Shirts';
    protected $baseFile = 'apparel.html';
    protected $crumbs = [
        'Home', 'Apparel'
    ];
    protected $crumbsText = 'Home / Apparel / Shirts';

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }
    public function testBreadCrumbLinks()
    {
        parent::testBreadCrumbLinks();
    }
}