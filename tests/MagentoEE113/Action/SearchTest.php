<?php

namespace Tests\Magium\MagentoEE113\Action;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Search\Search;
use Magium\Magento\Extractors\Catalog\Search\SearchSuggestions;
use Magium\Magento\Themes\MagentoEE113\ThemeConfiguration;

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