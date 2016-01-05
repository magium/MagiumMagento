<?php

namespace Magium\Magento\Extractors\Catalog\Search;

use Facebook\WebDriver\WebDriverElement;

class SearchSuggestion
{

    protected $text;
    protected $count;
    protected $element;

    /**
     * SearchSuggestion constructor.
     * @param $element
     * @param $count
     * @param $text
     */
    public function __construct(WebDriverElement $element, $count, $text)
    {
        $this->count = $count;
        $this->text = $text;
        $this->element = $element;
    }

    /**
     * @return WebDriverElement
     */

    public function getElement()
    {
        return $this->element;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }


}