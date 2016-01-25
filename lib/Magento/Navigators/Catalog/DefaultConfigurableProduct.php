<?php

namespace Magium\Magento\Navigators\Catalog;

class DefaultConfigurableProduct extends AbstractDefaultProduct
{
    const NAVIGATOR = 'Catalog\DefaultConfigurableProduct';

    public function navigateTo()
    {
        $this->product->navigateTo(
            $this->theme->getDefaultConfigurableProductName()
        );
    }

}