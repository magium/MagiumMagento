<?php

namespace Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterTypes;

use Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterValue;

class SwatchFilterValue extends FilterValue
{
    protected $image;

    public function __construct($text, $link, $count, $image)
    {
        parent::__construct($text, $link, $count);
        $this->image = $image;
    }

    public function getImageLink()
    {
        return $this->image;
    }


}