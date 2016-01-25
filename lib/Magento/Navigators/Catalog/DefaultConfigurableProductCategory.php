<?php

namespace Magium\Magento\Navigators\Catalog;

class DefaultConfigurableProductCategory extends AbstractDefaultCategory
{
    const NAVIGATOR = 'Catalog\DefaultConfigurableProductCategory';

    public function navigateTo()
    {
        $this->navigator->navigateTo(
            $this->theme->getNavigationPathToConfigurableProductCategory()
        );
    }
}