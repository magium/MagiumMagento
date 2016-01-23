<?php

namespace Tests\Magium\MagentoEE112\Action;

use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class SearchTest extends \Tests\Magium\Magento\Action\SearchTest
{
    protected $fullSearch = 'shirt';
    protected $partialSearch = 'sh';

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }
}