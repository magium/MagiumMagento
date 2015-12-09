<?php

namespace Magium\Magento\Themes\Customer;


use Magium\AbstractConfigurableElement;

abstract class AbstractThemeConfiguration extends AbstractConfigurableElement
{

    protected $accountNavigationXpath;
    protected $accountSectionHeaderXpath;

    protected $orderPageName;

    protected $viewOrderLinkXpath;

    protected $orderPageTitleContainsText;

    /**
     * @var string Xpath for the customer email form element
     */

    protected $loginUsernameField;

    /**
     * @var string Xpath for the customer password form element
     */

    protected $loginPasswordField;


    /**
     * @var string Xpath for the customer login "submit" button
     */

    protected $loginSubmitButton;

    /**
     * @return string
     */
    public function getOrderPageTitleContainsText()
    {
        return $this->translate($this->orderPageTitleContainsText);
    }

    /**
     * @return string
     */
    public function getAccountNavigationXpath()
    {
        return $this->translate($this->accountNavigationXpath);
    }

    /**
     * @return string
     */
    public function getAccountSectionHeaderXpath()
    {
        return $this->translate($this->accountSectionHeaderXpath);
    }

    /**
     * @return string
     */
    public function getOrderPageName()
    {
        return $this->translate($this->orderPageName);
    }

    /**
     * @return string
     */
    public function getViewOrderLinkXpath()
    {
        return $this->translate($this->viewOrderLinkXpath);
    }


    public function getLoginUsernameField()
    {
        return $this->loginUsernameField;
    }

    public function getLoginPasswordField()
    {
        return $this->loginPasswordField;
    }

    public function getLoginSubmitButton()
    {
        return $this->loginSubmitButton;
    }

}