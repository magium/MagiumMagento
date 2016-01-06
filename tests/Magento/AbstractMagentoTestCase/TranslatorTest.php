<?php

namespace Tests\Magium\AbstractMagentoTestCase;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Navigators\Customer\AccountHome;
use Magium\Magento\Navigators\Store\Switcher;

class TranslatorTest extends AbstractMagentoTestCase
{

    public function testTranslatorBaseConfiguration()
    {
        $translator = $this->getTranslator();
        self::assertInstanceOf('Magium\Util\Translator\Translator', $translator);
        self::assertEquals('Test Value', $translator->translatePlaceholders('Test Value'));
    }

    public function testDefaultLocaleSet()
    {
        $translator = $this->getTranslator();
        $translator->addTranslationCsvFile(__DIR__ . '/translation.csv', 'en_US');
        $translated = $translator->translatePlaceholders('{{original}}');
        self::assertEquals('translated', $translated);
    }

    public function testCustomLocaleSet()
    {
        $translator = $this->getTranslator();
        $translator->addTranslationCsvFile(__DIR__ . '/translation.csv', 'en_US');
        $translator->addTranslationCsvFile(__DIR__ . '/translation.de_DE.csv', 'de_DE');
        $translator->setLocale('de_DE');
        $translated = $translator->translatePlaceholders('{{translated}}');
        self::assertEquals('übersetzt', $translated);

        // Make sure this works with the default functionality too.  More of a hey-how-are-ya.
        $translated = $translator->translate('translated');
        self::assertEquals('übersetzt', $translated);
    }

    public function testOnWebpage()
    {
//        self::markTestSkipped('This test requires the German language pack.  This test will fail unless you have that optional feature installed');
        $translator = $this->getTranslator();
        $translator->addTranslationCsvFile(__DIR__ . '/translation.csv', 'en_US');
        $translator->addTranslationCsvFile(__DIR__ . '/translation.de_DE.csv', 'de_DE');

        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(AccountHome::NAVIGATOR)->navigateTo();

        $this->getNavigator(Switcher::NAVIGATOR)->switchTo('german');
        $translator->setLocale('de_DE');
        $this->getNavigator(AccountHome::NAVIGATOR)->navigateTo();
    }

}