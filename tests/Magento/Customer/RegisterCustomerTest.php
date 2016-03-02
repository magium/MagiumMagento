<?php

namespace Tests\Magium\Magento\Customer;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Customer\Logout;
use Magium\Magento\Actions\Customer\Register;
use Magium\Magento\Navigators\Customer\Account;

class RegisterCustomerTest extends AbstractMagentoTestCase
{

    public function testNavigateToLogin()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());

        $this->getIdentity()->generateUniqueEmailAddress();

        $this->getAction(Register::ACTION)->register();

        $this->getNavigator(Account::NAVIGATOR)->navigateTo('Newsletter Subscriptions');
        $element = $this->byId('subscription');
        self::assertNull($element->getAttribute('checked'));
        $this->getAction(Logout::ACTION)->logout();
    }

    public function testRegisterWithNewsletter()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());

        $this->getIdentity()->generateUniqueEmailAddress();

        $this->getAction(Register::ACTION)->register(true);
        $this->getNavigator(Account::NAVIGATOR)->navigateTo('Newsletter Subscriptions');
        $element = $this->byId('subscription');
        self::assertEquals('true', $element->getAttribute('checked'));
    }

}