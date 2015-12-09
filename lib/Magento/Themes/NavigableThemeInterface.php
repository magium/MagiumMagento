<?php

namespace Magium\Magento\Themes;


use Magium\Themes\ThemeConfigurationInterface;

interface NavigableThemeInterface extends ThemeConfigurationInterface {

    public function getNavigationBaseXPathSelector();

    public function getNavigationChildXPathSelector();

}