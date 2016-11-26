<?php

namespace Magium\Magento\Navigators\Catalog;

use Magium\Magento\Navigators\BaseMenu;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\Navigators\StaticNavigatorInterface;

abstract class AbstractDefaultProduct implements StaticNavigatorInterface
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

}