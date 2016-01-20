<?php

namespace Magium\Magento\Navigators\Catalog;

class DefaultSimpleProduct extends AbstractDefaultProduct
{

    const NAVIGATOR = 'Catalog\DefaultSimpleProduct';

    public function navigateTo()
    {
        $this->product->navigateTo(
            $this->theme->getDefaultSimpleProductName()
        );
    }

}