<?php

namespace Magium\Magento\Themes\Customer;


use Magium\AbstractConfigurableElement;
use Magium\Themes\ThemeConfigurationInterface;

abstract class AbstractThemeConfiguration extends AbstractConfigurableElement implements ThemeConfigurationInterface
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

    protected $orderShippingAddressBaseXpath;

    protected $orderBillingAddressBaseXpath;

    protected $orderItemNameXpath;
    protected $orderItemSkuXpath;
    protected $orderItemPriceXpath;
    protected $orderItemQtyXpath;
    protected $orderItemQtyOrderedRegex;
    protected $orderItemQtyShippedRegex;
    protected $orderItemSubtotalXpath;
    protected $orderSubtotalXpath;
    protected $orderShippingAndHandlingXpath;
    protected $orderTaxXpath;
    protected $orderGrandTotalXpath;

    protected $orderDateXpath;
    protected $orderStatusXpath;
    protected $orderStatusRegex;

    protected $orderShippingMethod;
    protected $orderPaymentMethod;

    /**
     * @return mixed
     */
    public function getOrderItemQtyOrderedRegex()
    {
        return $this->translate($this->orderItemQtyOrderedRegex);
    }

    /**
     * @return mixed
     */
    public function getOrderItemQtyShippedRegex()
    {
        return $this->translate($this->orderItemQtyShippedRegex);
    }



    /**
     * @return mixed
     */
    public function getOrderStatusRegex()
    {
        return $this->translate($this->orderStatusRegex);
    }

    /**
     * @return mixed
     */
    public function getOrderStatusXpath()
    {
        return $this->translate($this->orderStatusXpath);
    }

    /**
     * @return mixed
     */
    public function getOrderDateXpath()
    {
        return $this->orderDateXpath;
    }

    /**
     * @return mixed
     */
    public function getOrderPaymentMethod()
    {
        return $this->translate($this->orderPaymentMethod);
    }

    /**
     * @return mixed
     */
    public function getOrderShippingMethod()
    {
        return $this->translate($this->orderShippingMethod);
    }



    /**
     * @return mixed
     */
    public function getOrderGrandTotalXpath()
    {
        return $this->orderGrandTotalXpath;
    }

    /**
     * @return mixed
     */
    public function getOrderItemSubtotalXpath($count)
    {
        $xpath = sprintf($this->orderItemSubtotalXpath, $count);
        return $this->translate($xpath);
    }




    /**
     * @return mixed
     */
    public function getOrderItemNameXpath($count)
    {
        $xpath = sprintf($this->orderItemNameXpath, $count);
        return $this->translate($xpath);
    }

    /**
     * @return mixed
     */
    public function getOrderItemPriceXpath($count)
    {
        $xpath = sprintf($this->orderItemPriceXpath, $count);
        return $this->translate($xpath);
    }

    /**
     * @return mixed
     */
    public function getOrderItemQtyXpath($count)
    {
        $xpath = sprintf($this->orderItemQtyXpath, $count);
        return $this->translate($xpath);
    }


    /**
     * @return mixed
     */
    public function getOrderItemSkuXpath($count)
    {
        $xpath = sprintf($this->orderItemSkuXpath, $count);
        return $this->translate($xpath);
    }

    /**
     * @return mixed
     */
    public function getOrderShippingAndHandlingXpath()
    {
        return $this->translate($this->orderShippingAndHandlingXpath);
    }

    /**
     * @return mixed
     */
    public function getOrderSubtotalXpath()
    {
        return $this->translate($this->orderSubtotalXpath);
    }

    /**
     * @return mixed
     */
    public function getOrderTaxXpath()
    {
        return $this->translate($this->orderTaxXpath);
    }

    /**
     * @return mixed
     */
    public function getOrderBillingAddressBaseXpath()
    {
        return $this->translate($this->orderBillingAddressBaseXpath);
    }

    /**
     * @return mixed
     */
    public function getOrderShippingAddressBaseXpath()
    {
        return $this->translate($this->orderShippingAddressBaseXpath);
    }



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