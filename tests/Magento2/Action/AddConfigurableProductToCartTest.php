<?php

namespace Tests\Magium\Magento2\Action;



use Magium\Magento\Themes\Magento2\ThemeConfiguration;

class AddConfigurableProductToCartTest extends \Tests\Magium\Magento\Action\AddConfigurableProductToCartTest
{

    protected $redElementTestXpath = '//dl[@class="item-options"]/dd[contains(., "Red")]';
    protected $mediumElementTestXpath = '//dl[@class="item-options"]/dd[contains(., "M")]';
    protected $qtySelector = '.qty .input-text';

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }


}