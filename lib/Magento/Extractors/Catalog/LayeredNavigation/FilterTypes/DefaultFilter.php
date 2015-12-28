<?php

namespace Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterTypes;

use Facebook\WebDriver\WebDriverElement;


class DefaultFilter extends AbstractFilterType
{
    /**
     * @var WebDriverElement
     */

    protected $element;

    public function filterApplies()
    {
        return true;
    }



}