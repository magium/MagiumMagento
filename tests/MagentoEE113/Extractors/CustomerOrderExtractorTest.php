<?php

namespace Tests\Magium\MagentoEE113\Extractors;

class CustomerOrderExtractorTest extends \Tests\Magium\Magento\Extractors\CustomerOrderExtractorTest
{

    protected $status = 'Pending';

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE113\ThemeConfiguration');
    }
}