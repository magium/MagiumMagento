<?php

namespace Magium\Magento\Extractors\Catalog\Products;

use Facebook\WebDriver\WebDriverElement;

class ProductSummary
{
    const TITLE = 'title';
    const PRICE = 'price';
    const LINK = 'link';
    const IMAGE = 'image';
    const ORIGINAL_PRICE = 'original_price';
    const WISHLIST_LINK = 'wishlist_link';
    const COMPARE_LINK = 'compare_link';
    const DESCRIPTION = 'description';
    const ADD_TO_CART_LINK = 'add-to-cart';

    protected $attributes = [
        self::TITLE => null,
        self::PRICE => null,
        self::LINK => null,
        self::IMAGE => null,
        self::ORIGINAL_PRICE => null,
        self::WISHLIST_LINK => null,
        self::COMPARE_LINK => null,
        self::DESCRIPTION => null,
        self::ADD_TO_CART_LINK => null
    ];

    public function __construct(
        $title,
        $price,
        $link,
        $image,
        $originalPrice,
        WebDriverElement $wishlistLink = null,
        WebDriverElement $compareLink = null,
        $description = null,
        WebDriverElement $addToCartLink = null
    )
    {
        $this->attributes[self::TITLE] = $title;
        $this->attributes[self::PRICE] = $price;
        $this->attributes[self::LINK] = $link;
        $this->attributes[self::IMAGE] = $image;
        $this->attributes[self::ORIGINAL_PRICE] = $originalPrice;
        $this->attributes[self::WISHLIST_LINK] = $wishlistLink;
        $this->attributes[self::COMPARE_LINK] = $compareLink;
        $this->attributes[self::DESCRIPTION] = $description;
        $this->attributes[self::ADD_TO_CART_LINK] = $addToCartLink;
    }

    public function get($attribute)
    {
        if (isset($this->attributes[$attribute])) {
            return $this->attributes[$attribute];
        }
    }


    public function getDescription()
    {
        return $this->get(self::DESCRIPTION);
    }


    public function getAddToCartElement()
    {
        return $this->get(self::ADD_TO_CART_LINK);
    }

    public function getPrice()
    {
        return $this->get(self::PRICE);
    }

    public function getTitle()
    {
        return $this->get(self::TITLE);
    }

    public function getLink()
    {
        return $this->get(self::LINK);
    }

    public function getImage()
    {
        return $this->get(self::IMAGE);
    }

    public function getOriginalPrice()
    {
        return $this->get(self::ORIGINAL_PRICE);
    }

    public function getWishlistLinkElement()
    {
        return $this->get(self::WISHLIST_LINK);
    }

    public function getCompareLinkElement()
    {
        return $this->get(self::COMPARE_LINK);
    }

}