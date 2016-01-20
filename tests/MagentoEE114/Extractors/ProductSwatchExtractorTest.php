<?php

namespace Tests\Magium\MagentoEE114\Extractors;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\Product\ConfigurableProductOptions;
use Magium\Magento\Navigators\Catalog\Product;

class ProductSwatchExtractorTest extends \Tests\Magium\Magento\Extractors\ProductSwatchExtractorTest
{

    public function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE114\ThemeConfiguration');
    }


}