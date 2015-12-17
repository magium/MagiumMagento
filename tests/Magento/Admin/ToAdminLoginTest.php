<?php

namespace Tests\Magento\Admin;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Admin\Login\Login;
use Magium\Magento\Extractors\Admin\Login\Messages;

class ToAdminLoginTest extends AbstractMagentoTestCase
{

    public function testLoginAdmin()
    {

        $this->getAction(Login::ACTION)->login();
        self::assertEquals('Dashboard / Magento Admin', $this->webdriver->getTitle());
    }


    public function testLoginAdminSucceedsWhenAlreadyLoggedIn()
    {

        $this->getAction(Login::ACTION)->login();
        self::assertEquals('Dashboard / Magento Admin', $this->webdriver->getTitle());

        $this->getAction(Login::ACTION)->login();
        self::assertEquals('Dashboard / Magento Admin', $this->webdriver->getTitle());
    }

    public function testAdminMessage()
    {
        self::markTestSkipped('This test can only be run if there is a popup message');
        $this->getAction(Login::ACTION)->login();
        $messages = $this->getExtractor(Messages::EXTRACTOR);
        self::assertTrue($messages->hasMessages());
    }
    
}