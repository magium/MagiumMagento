<?php

namespace Magium\Magento\Extractors\Catalog\Product;

use Facebook\WebDriver\WebDriverElement;

class Value
{

    protected $text;
    protected $clickElement;

    public function __construct(
        $text,
        WebDriverElement $clickElement
    )
    {
        $this->text = $text;
        $this->clickElement = $clickElement;
    }

    /**
     * @return WebDriverElement
     */
    public function getClickElement()
    {
        return $this->clickElement;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

}