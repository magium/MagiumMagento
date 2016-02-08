<?php

namespace Magium\Magento\Themes\Customer;


use Magium\AbstractConfigurableElement;
use Magium\Themes\ThemeConfigurationInterface;

abstract class AbstractThemeConfiguration extends AbstractConfigurableElement implements ThemeConfigurationInterface
{

    public $accountNavigationXpath;
    public $accountSectionHeaderXpath;

    public $orderPageName;

    public $viewOrderLinkXpath;

    public $orderPageTitleContainsText;

    /**
     * @var string Xpath for the customer email form element
     */

    public $loginUsernameField;

    /**
     * @var string Xpath for the customer password form element
     */

    public $loginPasswordField;


    /**
     * @var string Xpath for the customer login "submit" button
     */

    public $loginSubmitButton;

    public $orderShippingAddressBaseXpath;

    public $orderBillingAddressBaseXpath;

    public $orderItemNameXpath;
    public $orderItemSkuXpath;
    public $orderItemPriceXpath;
    public $orderItemQtyXpath;
    public $orderItemQtyOrderedRegex;
    public $orderItemQtyShippedRegex;
    public $orderItemSubtotalXpath;
    public $orderSubtotalXpath;
    public $orderShippingAndHandlingXpath;
    public $orderTaxXpath;
    public $orderGrandTotalXpath;

    public $orderDateXpath;
    public $orderStatusXpath;
    public $orderStatusRegex;

    public $orderShippingMethod;
    public $orderPaymentMethod;

    public $guaranteedPageLoadedElementDisplayedXpath = '//*[contains(concat(" ",normalize-space(@class)," ")," footer ")]';

    public function getGuaranteedPageLoadedElementDisplayedXpath()
    {
        return $this->translatePlaceholders($this->guaranteedPageLoadedElementDisplayedXpath);
    }

    /**
     * @param mixed $guaranteedPageLoadedElementDisplayedXpath
     */
    public function setGuaranteedPageLoadedElementDisplayedXpath($guaranteedPageLoadedElementDisplayedXpath)
    {
        $this->guaranteedPageLoadedElementDisplayedXpath = $guaranteedPageLoadedElementDisplayedXpath;
    }

    /**
     * @return mixed
     */
    public function getOrderItemQtyOrderedRegex()
    {
        return $this->translatePlaceholders($this->orderItemQtyOrderedRegex);
    }

    /**
     * @return mixed
     */
    public function getOrderItemQtyShippedRegex()
    {
        return $this->translatePlaceholders($this->orderItemQtyShippedRegex);
    }



    /**
     * @return mixed
     */
    public function getOrderStatusRegex()
    {
        return $this->translatePlaceholders($this->orderStatusRegex);
    }

    /**
     * @return mixed
     */
    public function getOrderStatusXpath()
    {
        return $this->translatePlaceholders($this->orderStatusXpath);
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
        return $this->translatePlaceholders($this->orderPaymentMethod);
    }

    /**
     * @return mixed
     */
    public function getOrderShippingMethod()
    {
        return $this->translatePlaceholders($this->orderShippingMethod);
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
        return $this->translatePlaceholders($xpath);
    }

    /**
     * @return mixed
     */
    public function getOrderItemNameXpath($count)
    {
        $xpath = sprintf($this->orderItemNameXpath, $count);
        return $this->translatePlaceholders($xpath);
    }

    /**
     * @return mixed
     */
    public function getOrderItemPriceXpath($count)
    {
        $xpath = sprintf($this->orderItemPriceXpath, $count);
        return $this->translatePlaceholders($xpath);
    }

    /**
     * @return mixed
     */
    public function getOrderItemQtyXpath($count)
    {
        $xpath = sprintf($this->orderItemQtyXpath, $count);
        return $this->translatePlaceholders($xpath);
    }


    /**
     * @return mixed
     */
    public function getOrderItemSkuXpath($count)
    {
        $xpath = sprintf($this->orderItemSkuXpath, $count);
        return $this->translatePlaceholders($xpath);
    }

    /**
     * @return mixed
     */
    public function getOrderShippingAndHandlingXpath()
    {
        return $this->translatePlaceholders($this->orderShippingAndHandlingXpath);
    }

    /**
     * @return mixed
     */
    public function getOrderSubtotalXpath()
    {
        return $this->translatePlaceholders($this->orderSubtotalXpath);
    }

    /**
     * @return mixed
     */
    public function getOrderTaxXpath()
    {
        return $this->translatePlaceholders($this->orderTaxXpath);
    }

    /**
     * @return mixed
     */
    public function getOrderBillingAddressBaseXpath()
    {
        return $this->translatePlaceholders($this->orderBillingAddressBaseXpath);
    }

    /**
     * @return mixed
     */
    public function getOrderShippingAddressBaseXpath()
    {
        return $this->translatePlaceholders($this->orderShippingAddressBaseXpath);
    }

    /**
     * @return string
     */
    public function getOrderPageTitleContainsText()
    {
        return $this->translatePlaceholders($this->orderPageTitleContainsText);
    }

    /**
     * @return string
     */
    public function getAccountNavigationXpath($section)
    {
        $return = sprintf($this->accountNavigationXpath, $section);
        return $this->translatePlaceholders($return);
    }

    /**
     * @return string
     */
    public function getAccountSectionHeaderXpath($header)
    {
        $return = sprintf($this->accountSectionHeaderXpath, $header);
        return $this->translatePlaceholders($return);
    }

    /**
     * @return string
     */
    public function getOrderPageName()
    {
        return $this->translatePlaceholders($this->orderPageName);
    }

    /**
     * @return string
     */
    public function getViewOrderLinkXpath($order)
    {
        $return = sprintf($this->viewOrderLinkXpath, $order);
        return $this->translatePlaceholders($return);
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