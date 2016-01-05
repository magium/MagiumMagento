<?php

namespace Tests\Magium\Magento\Action;

use Facebook\WebDriver\WebDriverKeys;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Search\Search;
use Magium\Magento\Extractors\Catalog\Search\SearchSuggestions;

class SearchTest extends AbstractMagentoTestCase
{
    protected $fullSearch = 'shirt';
    protected $partialSearch = 'sh';

    public function testSearch()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getAction(Search::ACTION)->search($this->fullSearch);
        $extractor = $this->getExtractor(\Magium\Magento\Extractors\Catalog\Search\SearchResults::EXTRACTOR);
        /* @var $extractor \Magium\Magento\Extractors\Catalog\Category\Search */
        $extractor->extract();
        self::assertGreaterThan(0, count($extractor->getProducts()));
    }

    public function testSearchWithEnter()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getAction(Search::ACTION)->type($this->fullSearch . WebDriverKeys::ENTER);
        $extractor = $this->getExtractor(\Magium\Magento\Extractors\Catalog\Search\SearchResults::EXTRACTOR);
        /* @var $extractor \Magium\Magento\Extractors\Catalog\Category\Search */
        $extractor->extract();
        self::assertGreaterThan(0, count($extractor->getProducts()));
    }

    public function testSearchSuggestions()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getAction(Search::ACTION)->type($this->partialSearch);
        $extractor = $this->getExtractor(SearchSuggestions::EXTRACTOR);
        $extractor->extract();

        $suggestions = $extractor->getSuggestions();

        self::assertGreaterThan(0, count($suggestions));
        self::assertGreaterThan(0, $suggestions[0]->getCount());
        self::assertContains($this->partialSearch, $suggestions[0]->getText());

        $suggestions[0]->getElement()->click(); // If it does not work an exception will be thrown.
    }

}