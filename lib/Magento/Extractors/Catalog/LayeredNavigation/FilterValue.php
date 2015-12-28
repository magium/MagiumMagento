<?php

namespace Magium\Magento\Extractors\Catalog\LayeredNavigation;

use Facebook\WebDriver\WebDriverElement;

class FilterValue
{
    protected $element;
    protected $text;
    protected $link;
    protected $count;

    public function __construct(WebDriverElement $element, $text, $link, $count)
    {
        $this->element = $element;
        $this->text = $text;
        $this->link = $link;
        $this->count = $count;
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

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }


}