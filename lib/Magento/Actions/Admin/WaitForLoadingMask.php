<?php

namespace Magium\Magento\Actions\Admin;

use Magium\Actions\StaticActionInterface;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class WaitForLoadingMask implements StaticActionInterface
{
    const ACTION = 'Admin\WaitForLoadingMask';

    protected $webDriver;

    public function __construct(
        WebDriver          $webDriver
    )
    {
        $this->webDriver    = $webDriver;
    }

    public function wait()
    {
        $this->webDriver->wait()->until(ExpectedCondition::not(ExpectedCondition::visibilityOf($this->webDriver->byId('loading-mask'))));
    }

    public function execute()
    {
        $this->wait();
    }

}