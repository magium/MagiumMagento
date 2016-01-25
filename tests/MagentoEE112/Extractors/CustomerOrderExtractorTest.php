<?php

namespace Tests\Magium\MagentoEE112\Extractors;

use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class CustomerOrderExtractorTest extends \Tests\Magium\Magento\Extractors\CustomerOrderExtractorTest
{

    protected $status = 'Pending';

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }
}