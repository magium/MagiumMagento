<?php

namespace Magium\Magento\Navigators\Catalog;

class DefaultSimpleProductCategory extends AbstractDefaultCategory
{
    const NAVIGATOR = 'Catalog\DefaultSimpleProductCategory';

    public function navigateTo()
    {
        $this->navigator->navigateTo(
            $this->theme->getNavigationPathToSimpleProductCategory()
        );
    }
}