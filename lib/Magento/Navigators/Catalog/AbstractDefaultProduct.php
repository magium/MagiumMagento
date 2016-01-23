<?php

namespace Magium\Magento\Navigators\Catalog;

use Magium\Magento\Navigators\BaseMenu;
use Magium\Magento\Themes\AbstractThemeConfiguration;

abstract class AbstractDefaultProduct
{

    protected $theme;
    protected $product;

    public function __construct(
        AbstractThemeConfiguration $theme,
        Product $product
    )
    {
        $this->theme = $theme;
        $this->product = $product;
    }

    abstract function navigateTo();

}