<?php

namespace Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterTypes;

use Facebook\WebDriver\WebDriverElement;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterValue;

class SwatchFilterValue extends FilterValue
{
    protected $image;

    public function __construct(WebDriverElement $element, $text, $link, $count, $image)
    {
        parent::__construct($element, $text, $link, $count);
        $this->image = $image;
    }

    public function getImageLink()
    {
        return $this->image;
    }


}