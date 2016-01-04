<?php

namespace Magium\Magento\Themes;


use Magium\Themes\BaseThemeInterface;

interface NavigableThemeInterface extends BaseThemeInterface {

    public function getNavigationBaseXPathSelector();

    public function getNavigationChildXPathSelector($level, $text);

}