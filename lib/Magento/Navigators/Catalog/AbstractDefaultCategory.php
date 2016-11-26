<?php

namespace Magium\Magento\Navigators\Catalog;

use Magium\Magento\Navigators\BaseMenu;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\Navigators\StaticNavigatorInterface;

abstract class AbstractDefaultCategory implements StaticNavigatorInterface
{

    protected $theme;
    protected $navigator;

    public function __construct(
        AbstractThemeConfiguration $theme,
        BaseMenu $navigator
    )
    {
        $this->theme = $theme;
        $this->navigator = $navigator;
    }

}