<?php

namespace Tests\Magium\Magento\Admin;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Admin\Login\Login;
use Magium\Magento\Actions\Admin\Tables\ClearTableFilters;
use Magium\Magento\Actions\Admin\WaitForLoadingMask;
use Magium\Magento\Navigators\Admin\AdminMenu;

class TestClearTableFilters extends AbstractMagentoTestCase
{

    public function testFilterClearsSuccessfully()
    {

        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('Sales/Orders');
        $this->webdriver->byId('sales_order_grid_filter_billing_name')->sendKeys('Kevin Schroeder');
        $this->webdriver->byXpath('//span[.="Search"]')->click();
        $this->getAction(WaitForLoadingMask::ACTION)->wait();

        $element = $this->webdriver->byId('sales_order_grid_filter_billing_name');
        self::assertEquals('Kevin Schroeder', $element->getAttribute('value'));

        // Actual test`

        $this->getAction(ClearTableFilters::ACTION)->clear();


        $element = $this->webdriver->byId('sales_order_grid_filter_billing_name');
        self::assertEquals('', $element->getAttribute('value'));

    }

}
