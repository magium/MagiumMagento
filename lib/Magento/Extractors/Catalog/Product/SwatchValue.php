<?php

namespace Magium\Magento\Extractors\Catalog\Product;

use Facebook\WebDriver\WebDriverElement;

class SwatchValue extends Value
{

    protected $url;
    protected $available;

    public function __construct(
        $text,
        WebDriverElement $clickElement,
        $available,
        $url = null
    )
    {
        parent::__construct($text, $clickElement);
        $this->available = $available;
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * @return null
     */
    public function getUrl()
    {
        return $this->url;
    }


}