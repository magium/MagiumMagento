<?php

namespace Magium\Magento\Navigators\Catalog;

use Magium\Magento\Navigators\BaseMenu;
use Magium\Magento\Themes\AbstractThemeConfiguration;

abstract class AbstractDefaultCategory
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

    abstract function navigateTo();

}