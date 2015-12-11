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
    public function getAccountNavigationXpath($section)
    {
        $return = sprintf($this->accountNavigationXpath, $section);
        return $this->translate($return);
    }

    /**
     * @return string
     */
    public function getAccountSectionHeaderXpath($header)
    {
        $return = sprintf($this->accountSectionHeaderXpath, $header);
        return $this->translate($return);
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
    public function getViewOrderLinkXpath($order)
    {
        $return = sprintf($this->viewOrderLinkXpath, $order);
        return $this->translate($return);
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