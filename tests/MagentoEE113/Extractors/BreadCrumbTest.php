<?php

namespace Tests\Magium\MagentoEE113\Extractors;


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
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE113\ThemeConfiguration');
    }
    public function testBreadCrumbLinks()
    {
        parent::testBreadCrumbLinks();
    }
}