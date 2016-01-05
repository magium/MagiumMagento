<?php

namespace Tests\Magium\Magento18\Action;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Search\Search;
use Magium\Magento\Extractors\Catalog\Search\SearchSuggestions;

class SearchTest extends \Tests\Magium\Magento\Action\SearchTest
{
    protected $fullSearch = 'shirt';
    protected $partialSearch = 'sh';

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }
}