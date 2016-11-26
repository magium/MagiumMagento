<?php

namespace Magium\Magento\Actions\Admin\Orders\Ship;

use Facebook\WebDriver\WebDriverSelect;
use Magium\AbstractTestCase;
use Magium\Actions\StaticActionInterface;
use Magium\Actions\SubAction\SubActionInterface;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\WebDriver;

class AddTrackingNumber implements SubActionInterface, StaticActionInterface 
{

    const ACTION = 'Admin\Orders\Ship\AddTrackingNumber';

    const CARRIER_CUSTOM    = 'custom';
    const CARRIER_DHL       = 'dhl';
    const CARRIER_FEDEX     = 'fedex';
    const CARRIER_UPS       = 'ups';
    const CARRIER_USPS      = 'usps';
    const CARRIER_DHLINT    = 'dhlint';

    protected $carrier;
    protected $title;
    protected $number;

    protected $theme;
    protected $webDriver;
    protected $testCase;

    public function __construct(
        WebDriver $webDriver,
        ThemeConfiguration $themeConfiguration,
        AbstractTestCase $testCase
    )
    {
        $this->theme = $themeConfiguration;
        $this->webDriver = $webDriver;
        $this->testCase = $testCase;
    }

    /**
     * @param mixed $carrier
     */
    public function setCarrier($carrier)
    {
        $this->carrier = $carrier;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function execute()
    {
        $this->testCase->byText('{{Add Tracking Number}}')->click();
        $this->testCase->sleep('1s'); // Give the UI time to update
        $count = 0;
        do {
            $count++;
        } while ($this->webDriver->elementExists($this->theme->getShippingCarrierXpath($count), WebDriver::BY_XPATH));
        $count--; // $count was the last one that DOESN'T exist.  Go back one.

        if ($this->carrier) {
            $select = new WebDriverSelect($this->webDriver->byXpath($this->theme->getShippingCarrierXpath($count)));
            if (strpos($this->carrier, 'label=') === 0) {
                $carrier = substr($this->carrier, strlen('label='));
                $select->selectByVisibleText($carrier);
            } else {
                $select->selectByValue($this->carrier);
            }
        }

        if ($this->title) {
            $element = $this->webDriver->byXpath($this->theme->getShippingTitleXpath($count));
            $element->clear();
            $element->sendKeys($this->title);
        }

        if ($this->number) {
            $element = $this->webDriver->byXpath($this->theme->getShippingTrackingNumberXpath($count));
            $element->clear();
            $element->sendKeys($this->number);
        }
    }

}