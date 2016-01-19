<?php

namespace Tests\Magium\MagentoEE114\Action;

use Facebook\WebDriver\WebDriverKeys;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Search\Search;
use Magium\Magento\Extractors\Catalog\Search\SearchSuggestions;

class SearchTest extends \Tests\Magium\Magento\Action\SearchTest
{

    public function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE114\ThemeConfiguration');
    }

}