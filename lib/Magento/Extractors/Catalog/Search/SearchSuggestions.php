<?php

namespace Magium\Magento\Extractors\Catalog\Search;

use Magium\AbstractTestCase;
use Magium\Extractors\AbstractExtractor;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class SearchSuggestions extends AbstractExtractor
{
    const EXTRACTOR = 'Catalog\Search\SearchSuggestions';

    protected $suggestions;

    /**
     * @var AbstractThemeConfiguration
     */
    protected $theme;  // Here for code completion assistance

    public function __construct(WebDriver $webDriver, AbstractTestCase $testCase, AbstractThemeConfiguration $theme)
    {
        parent::__construct($webDriver, $testCase, $theme);
    }

    /**
     * @return SearchSuggestions[]
     */

    public function getSuggestions()
    {
        return $this->suggestions;
    }

    public function extract()
    {
        $testXpath = $this->theme->getSearchSuggestionTextXpath(1);
        $this->webDriver->wait(5)->until(ExpectedCondition::elementExists($testXpath, WebDriver::BY_XPATH));
        $testElement = $this->webDriver->byXpath($testXpath);
        $this->webDriver->wait(5)->until(ExpectedCondition::visibilityOf($testElement));
        $count = 0;
        $this->suggestions = [];
        while ($this->webDriver->elementExists($this->theme->getSearchSuggestionTextXpath(++$count), WebDriver::BY_XPATH)) {
            $suggestionCount = trim($this->webDriver->byXpath($this->theme->getSearchSuggestionCountXpath($count))->getText());
            $suggestionText = trim($this->webDriver->byXpath($this->theme->getSearchSuggestionTextXpath($count))->getText());
            $suggestionText = trim($suggestionText, $suggestionCount);
            $this->suggestions[] = new SearchSuggestion(
                $this->webDriver->byXpath($this->theme->getSearchSuggestionTextXpath($count)),
                $suggestionCount,
                $suggestionText
            );
        }
    }


}