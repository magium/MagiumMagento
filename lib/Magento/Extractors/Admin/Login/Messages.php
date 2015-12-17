<?php

namespace Magium\Magento\Extractors\Admin\Login;

use Facebook\WebDriver\Exception\WebDriverException;
use Magium\Extractors\AbstractExtractor;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\WebDriver;

class Messages extends AbstractExtractor
{
    const EXTRACTOR = 'Admin\Login\Messages';

    protected $messages = [];

    public function __construct(
        WebDriver           $webDriver,
        AbstractMagentoTestCase    $testCase,
        ThemeConfiguration $theme
    )
    {
        parent::__construct($webDriver, $testCase, $theme);
    }

    public function extract()
    {
        try {
            $element = $this->webDriver->byXpath($this->theme->getAdminPopupMessageContainerXpath());
            $this->testCase->assertInstanceOf('Facebook\Webdriver\WebDriverElement', $element);
            $this->addMessage($element->getText());

            $closeElement = $this->webDriver->byXpath($this->theme->getAdminPopupMessageCloseButtonXpath());
            $this->testCase->assertInstanceOf('Facebook\Webdriver\WebDriverElement', $closeElement);
            $closeElement->click();
        } catch (WebDriverException $e) {
            // Indicates that no popup messages were found when logging in.  Nothing needs to be done
        }
    }

    public function getMessages()
    {
        return $this->messages;
    }

    public function addMessage($message)
    {
        $this->messages[] = $message;
    }


    public function hasMessages()
    {
        return count($this->messages) > 0;
    }

}