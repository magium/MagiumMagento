<?php

namespace Tests\Magium\Magento18\Extractors;

class CustomerOrderExtractorTest extends \Tests\Magium\Magento\Extractors\CustomerOrderExtractorTest
{

    protected $status = 'Pending';

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }
}