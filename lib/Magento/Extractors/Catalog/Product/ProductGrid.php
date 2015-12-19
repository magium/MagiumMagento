<?php

namespace Magium\Magento\Extractors\Catalog\Product;


class ProductGrid extends AbstractProductCollection
{

    const EXTRACTOR = 'Catalog\Product\ProductGrid';

    public function getElementXpath($type, $count)
    {
        switch ($type) {
            case ProductSummary::DESCRIPTION:
                return $this->theme->getProductGridDescriptionXpath($count);
                break;
            case ProductSummary::TITLE:
                return $this->theme->getProductGridTitleXpath($count);
                break;
            case ProductSummary::COMPARE_LINK:
                return $this->theme->getProductGridCompareLinkXpath($count);
                break;
            case ProductSummary::IMAGE:
                return $this->theme->getProductGridImageXpath($count);
                break;
            case ProductSummary::LINK:
                return $this->theme->getProductGridLinkXpath($count);
                break;
            case ProductSummary::ORIGINAL_PRICE:
                return $this->theme->getProductGridOriginalPriceXpath($count);
                break;
            case ProductSummary::PRICE:
                return $this->theme->getProductGridPriceXpath($count);
                break;
            case ProductSummary::WISHLIST_LINK:
                return $this->theme->getProductGridWishlistLinkXpath($count);
                break;
            case ProductSummary::ADD_TO_CART_LINK:
                return $this->theme->getProductGridAddToCartLinkXpath($count);
                break;
        }
    }


}