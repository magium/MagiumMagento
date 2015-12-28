<?php

namespace Magium\Magento\Extractors\Catalog\Products;


class ProductList extends AbstractProductCollection
{

    const EXTRACTOR = 'Catalog\Products\ProductList';

    public function getElementXpath($type, $count)
    {
        switch ($type) {
            case ProductSummary::DESCRIPTION:
                return $this->theme->getProductListDescriptionXpath($count);
                break;
            case ProductSummary::TITLE:
                return $this->theme->getProductListTitleXpath($count);
                break;
            case ProductSummary::COMPARE_LINK:
                return $this->theme->getProductListCompareLinkXpath($count);
                break;
            case ProductSummary::IMAGE:
                return $this->theme->getProductListImageXpath($count);
                break;
            case ProductSummary::LINK:
                return $this->theme->getProductListLinkXpath($count);
                break;
            case ProductSummary::ORIGINAL_PRICE:
                return $this->theme->getProductListOriginalPriceXpath($count);
                break;
            case ProductSummary::PRICE:
                return $this->theme->getProductListPriceXpath($count);
                break;
            case ProductSummary::WISHLIST_LINK:
                return $this->theme->getProductListWishlistLinkXpath($count);
                break;
            case ProductSummary::ADD_TO_CART_LINK:
                return $this->theme->getProductListAddToCartLinkXpath($count);
            break;
        }
    }


}